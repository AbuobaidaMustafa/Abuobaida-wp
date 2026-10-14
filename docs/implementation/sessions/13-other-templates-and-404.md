# Session 13: Other templates: page/About, posts, archive, search, comments, 404

**Status:** Pending  
**Phase:** 6  
**Size:** M  
**Branch:** `feature/13-other-templates`  
**Depends on:** 08

## Objective

Bring every remaining template onto the design system, including block-content styling for the About page and the terminal-style 404, rebuilt without external requests.

## Required context

- PROJECT_CONTEXT.md
- Design canvas About, article, search and 404 artboards
- ARCHITECTURE.md §4
- CONTENT_STRATEGY.md §6
- DECISIONS.md D-07, Q-05

## Prerequisites

- S08

## Scope

- `page.php` and the About page block styles (headings, lists, timeline as a core List block style, images, quotes, code, tables, buttons, embeds) via `theme.json` and CSS
- `single.php`, `index.php`, `archive.php`, `search.php` (with an empty state), `comments.php` (styled, accessible)
- 404: terminal concept, local CSS only, translatable copy, a search form and a home link
- Theme unit test data pass (local)

## Out of scope

- New blog features (D-07)

## Expected file changes

| File | Change |
|---|---|
| `page.php` | add |
| `single.php, index.php, archive.php, search.php, comments.php, 404.php` | rewrite |
| `assets/css/templates/{article,404}.css` | add/rewrite |

## Acceptance criteria

- [ ] Every template is a valid document in 3 languages
- [ ] The 404 makes no third-party requests and fits 320 px without overflow
- [ ] Theme unit test content has no layout breaks (list the exceptions)
- [ ] F-12, F-13 delivered

## Tests and verification

- Definition of done: `TEST_STRATEGY.md` §4
- The theme unit test data visual pass
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/13-other-templates-and-404.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 13 (Other templates: page/About, posts, archive, search, comments, 404) as specified on branch feature/13-other-templates.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
