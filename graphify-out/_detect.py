import json
from graphify.detect import detect
from pathlib import Path
from graphify.paths import out_path
from graphify.watch import _read_build_excludes, _read_build_gitignore

INPUT_PATH = Path('graphify-out/.graphify_root').read_text(encoding='utf-8-sig').strip()
result = detect(Path(INPUT_PATH), extra_excludes=_read_build_excludes(out_path()), gitignore=_read_build_gitignore(out_path()))
Path('graphify-out/.graphify_detect.json').write_text(json.dumps(result, ensure_ascii=False), encoding='utf-8')
print(f'Detected {result["total_files"]} files, ~{result.get("total_words", 0)} words')
for k, v in result['files'].items():
    if v:
        print(k, len(v))
sens = result.get('skipped_sensitive') or []
if sens:
    print('SKIPPED_SENSITIVE', len(sens), sens)
