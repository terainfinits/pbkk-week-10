import json, glob
from pathlib import Path
from graphify.build import build_from_json
from graphify.cluster import cluster, score_all
from graphify.analyze import god_nodes, surprising_connections, suggest_questions
from graphify.report import generate
from graphify.export import to_json
from graphify.diagnostics import diagnose_extraction, format_diagnostic_report

INPUT_PATH = Path('graphify-out/.graphify_root').read_text(encoding="utf-8-sig").strip()

# B3.5 Coverage Check
covered = {}
for c in sorted(glob.glob('graphify-out/.graphify_chunk_*.json')):
    d = json.loads(Path(c).read_text(encoding="utf-8"))
    for src, n in (d.get('coverage') or {}).items():
        covered[src] = max(covered.get(src, 0), int(n))

partial = []
for src, n in sorted(covered.items()):
    p = Path(src)
    if not p.is_absolute():
        p = Path(INPUT_PATH) / src
    if not p.is_file():
        continue
    total = sum(1 for _ in p.open(encoding='utf-8', errors='replace'))
    if total and n < total:
        partial.append((src, n, total))

Path('graphify-out/.graphify_partial.txt').write_text('\n'.join(s for s, _, _ in partial), encoding="utf-8")
if partial:
    print(f'WARNING: {len(partial)} file(s) were only partly read.')
else:
    print('Coverage OK')

# Merge chunks to .graphify_semantic_new.json & .graphify_semantic.json
chunks = sorted(glob.glob('graphify-out/.graphify_chunk_*.json'))
all_nodes, all_edges, all_hyperedges = [], [], []
total_in, total_out = 0, 0
for c in chunks:
    d = json.loads(Path(c).read_text(encoding="utf-8"))
    all_nodes += d.get('nodes', [])
    all_edges += d.get('edges', [])
    all_hyperedges += d.get('hyperedges', [])
    total_in += d.get('input_tokens', 0)
    total_out += d.get('output_tokens', 0)

merged_sem = {
    'nodes': all_nodes,
    'edges': all_edges,
    'hyperedges': all_hyperedges,
    'input_tokens': total_in,
    'output_tokens': total_out
}
Path('graphify-out/.graphify_semantic.json').write_text(json.dumps(merged_sem, indent=2, ensure_ascii=False), encoding="utf-8")

# Part C: Merge AST + Semantic
ast = json.loads(Path('graphify-out/.graphify_ast.json').read_text(encoding="utf-8"))
sem = json.loads(Path('graphify-out/.graphify_semantic.json').read_text(encoding="utf-8"))

for n in sem['nodes']:
    n.setdefault('_origin', 'semantic')
for e in sem['edges']:
    e.setdefault('_origin', 'semantic')

seen = {n['id'] for n in ast['nodes']}
merged_nodes = list(ast['nodes'])
for n in sem['nodes']:
    if n['id'] not in seen:
        merged_nodes.append(n)
        seen.add(n['id'])

merged_edges = ast['edges'] + sem['edges']
merged_hyperedges = sem.get('hyperedges', [])
merged = {
    'nodes': merged_nodes,
    'edges': merged_edges,
    'hyperedges': merged_hyperedges,
    'input_tokens': sem.get('input_tokens', 0),
    'output_tokens': sem.get('output_tokens', 0),
}
Path('graphify-out/.graphify_extract.json').write_text(json.dumps(merged, indent=2, ensure_ascii=False), encoding="utf-8")
print(f'Merged: {len(merged_nodes)} nodes, {len(merged_edges)} edges ({len(ast["nodes"])} AST + {len(sem["nodes"])} semantic)')

# Step 4: Build graph, cluster, analyze
G = build_from_json(merged, root=INPUT_PATH, directed=False)
if G.number_of_nodes() == 0:
    print('ERROR: Graph is empty')
    exit(1)

communities = cluster(G)
cohesion = score_all(G, communities)
tokens = {'input': merged.get('input_tokens', 0), 'output': merged.get('output_tokens', 0)}
gods = god_nodes(G)
surprises = surprising_connections(G, communities)
labels = {cid: f'Community {cid}' for cid in communities}
questions = suggest_questions(G, communities, labels)

wrote = to_json(G, communities, 'graphify-out/graph.json', force=False)
if not wrote:
    print('ERROR: refused to shrink graph.json')
    exit(1)

detection = json.loads(Path('graphify-out/.graphify_detect.json').read_text(encoding="utf-8"))
report = generate(G, communities, cohesion, labels, gods, surprises, detection, tokens, INPUT_PATH, suggested_questions=questions)
Path('graphify-out/GRAPH_REPORT.md').write_text(report, encoding="utf-8")
analysis = {
    'communities': {str(k): v for k, v in communities.items()},
    'cohesion': {str(k): v for k, v in cohesion.items()},
    'gods': gods,
    'surprises': surprises,
    'questions': questions,
}
Path('graphify-out/.graphify_analysis.json').write_text(json.dumps(analysis, indent=2, ensure_ascii=False), encoding="utf-8")
print(f'Graph: {G.number_of_nodes()} nodes, {G.number_of_edges()} edges, {len(communities)} communities')

# Step 4.5: Health Check
summary = diagnose_extraction(merged, directed=False, root=INPUT_PATH)
print(format_diagnostic_report(summary))
