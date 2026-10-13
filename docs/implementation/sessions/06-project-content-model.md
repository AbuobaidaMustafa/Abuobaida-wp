# Session 06 — Project content model

**Status**: Pending · **Phase**: 2 · **Branch**: `feature/06-project-content-model`

## Objective
Give projects a real, translatable content model and enter the owner's real projects.

## Required context
- PROJECT_CONTEXT.md
- DECISIONS.md D-05, D-08
- docs/content/projects.md
- acf-json/

## Prerequisites
- Sessions 01, 03
- D-05 decided

## Scope
- Register `project` CPT (archive `/projects/`, `show_in_rest`) and `project_type` taxonomy — in companion plugin or theme per D-05
- ACF group `project_details`: summary, role, year, stack (repeater or taxonomy), problem, approach, outcome, live URL, repo URL, gallery, video/embed URL, featured flag, order
- Image sizes for cards and case-study hero
- Polylang: mark CPT/taxonomy translatable (if Polylang active)
- Enter owner-supplied projects (English first)

## Out of scope
- Front-end templates (09–11)

## Expected file changes
| File | Change |
|---|---|
| `abuobaida-core/ or inc/post-types.php` | add |
| `acf-json/group_project_details.json` | add |
| `inc/setup.php (image sizes)` | modify |

## Acceptance criteria
- [ ] Projects editable in admin with all fields
- [ ] Field values retrievable via helper; nothing fatal without ACF
- [ ] Permalinks flushed on activation only (not every load)

## Tests & verification
- Create/edit/translate a project on local WP
- `composer lint`
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/06-project-content-model.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 06 (Project content model) as specified, on branch
feature/06-project-content-model. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
