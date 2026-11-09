# Graph Report - pbkk-tugas-week10  (2026-11-09)

## Corpus Check
- Corpus is ~12,240 words - fits in a single context window. You may not need a graph.

## Summary
- 198 nodes · 202 edges · 37 communities (8 shown, 29 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 2 edges (avg confidence: 0.9)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- Community 0
- Community 1
- Community 2
- Community 3
- Community 4
- Community 5
- Community 6
- Community 7
- Community 8
- Community 9
- Community 10
- Community 11
- Community 14
- Community 15
- Community 17
- Community 18
- Community 19
- Community 20
- Community 21
- Community 22
- Community 29
- Community 30

## God Nodes (most connected - your core abstractions)
1. `scripts` - 9 edges
2. `ProfileController` - 8 edges
3. `User` - 8 edges
4. `require-dev` - 8 edges
5. `AppServiceProvider` - 5 edges
6. `config` - 5 edges
7. `UserFactory` - 5 edges
8. `require` - 4 edges
9. `psr-4` - 4 edges
10. `DatabaseSeeder` - 4 edges

## Surprising Connections (you probably didn't know these)
- `Laravel Boost Setup` --semantically_similar_to--> `Laravel Boost Setup Guidelines`  [INFERRED] [semantically similar]
  AGENTS.md → CLAUDE.md
- `ProfileController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/ProfileController.php → app/Http/Controllers/Controller.php
- `Local Development Setup` --conceptually_related_to--> `Laravel Boost Setup`  [INFERRED]
  README.md → AGENTS.md
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (37 total, 29 thin omitted)

### Community 0 - "Community 0"
Cohesion: 0.08
Nodes (23): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+15 more)

### Community 1 - "Community 1"
Cohesion: 0.13
Nodes (20): devDependencies, concurrently@^10.0.3, laravel-vite-plugin@^3.1, tailwindcss@^4.0.0, @tailwindcss/vite@^4.0.0, vite@^8.0.0, optionalDependencies, @laravel/multiplex@^0.4.1 (+12 more)

### Community 2 - "Community 2"
Cohesion: 0.16
Nodes (8): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}()

### Community 6 - "Community 6"
Cohesion: 0.29
Nodes (3): {closure#1}(), {closure#2}(), {closure#3}()

### Community 7 - "Community 7"
Cohesion: 0.22
Nodes (9): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+1 more)

### Community 8 - "Community 8"
Cohesion: 0.25
Nodes (8): require-dev, fakerphp/faker, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision, phpunit/phpunit

### Community 9 - "Community 9"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 15 - "Community 15"
Cohesion: 0.67
Nodes (3): Laravel Boost Setup, Laravel Boost Setup Guidelines, Local Development Setup

## Knowledge Gaps
- **12 isolated node(s):** `layouts.app`, `partials.code-chat-mockup`, `layouts.app`, `layouts.app`, `partials.navbar` (+7 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 108 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **29 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `Community 7` to `Community 0`?**
  _High betweenness centrality (0.018) - this node is a cross-community bridge._
- **What connects `layouts.app`, `partials.code-chat-mockup`, `layouts.app` to the rest of the system?**
  _12 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Community 0` be split into smaller, more focused modules?**
  _Cohesion score 0.08333333333333333 - nodes in this community are weakly interconnected._
- **Why does `require-dev` connect `Community 8` to `Community 0`?**
  _High betweenness centrality (0.016) - this node is a cross-community bridge._
- **Should `Community 1` be split into smaller, more focused modules?**
  _Cohesion score 0.12554112554112554 - nodes in this community are weakly interconnected._
- **Why does `config` connect `Community 9` to `Community 0`?**
  _High betweenness centrality (0.013) - this node is a cross-community bridge._