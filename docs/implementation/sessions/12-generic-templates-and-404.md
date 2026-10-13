# Session 12 — Generic templates & 404

**Status**: Pending · **Phase**: 6 · **Branch**: `feature/12-generic-templates-and-404`

## Objective
Bring page, post, archive, search, comments and 404 onto the new design system.

## Required context
- PROJECT_CONTEXT.md
- docs/DESIGN_SYSTEM.md
- DECISIONS.md D-07

## Prerequisites
- Session 07

## Scope
- `page.php`, `single.php`, `index.php`, `archive.php`, `search.php`, `comments.php`, `template-parts/content*.php` restyled
- Block content styling (core blocks used in pages: image, gallery, quote, code, table, buttons, embed)
- 404: keep the terminal concept with local CSS only (no remote GIF, no `@import` font), translatable strings, search form + home link

## Out of scope
- New blog features

## Expected file changes
| File | Change |
|---|---|
| `page.php` | add |
| `generic templates` | modify |
| `404.php, assets/css/404.css` | modify |

## Acceptance criteria
- [ ] Every template renders valid HTML in 3 languages
- [ ] 404 makes no external requests

## Tests & verification
- Theme Unit Test data import + visual pass
- Network panel on 404
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/12-generic-templates-and-404.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 12 (Generic templates & 404) as specified, on branch
feature/12-generic-templates-and-404. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
