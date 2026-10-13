# Session 10 — Project archive & filtering

**Status**: Pending · **Phase**: 5 · **Branch**: `feature/10-project-archive`

## Objective
Provide a project listing filterable by type that works without JavaScript.

## Required context
- PROJECT_CONTEXT.md
- docs/DESIGN_SYSTEM.md
- Session 06 content model

## Prerequisites
- Sessions 06, 08

## Scope
- `archive-project.php` + `taxonomy-project_type.php` using the project-card component
- Filters as real links to taxonomy archives; optional small JS enhancement (no Isotope)
- Pagination; empty state; translated labels

## Out of scope
- Single project template (11)

## Expected file changes
| File | Change |
|---|---|
| `archive-project.php, taxonomy-project_type.php` | add |
| `template-parts/components/project-card.php` | add/modify |
| `assets/js/project-filter.js` | add (optional) |

## Acceptance criteria
- [ ] Filtering works with JS disabled
- [ ] Cards show title, summary, role, stack, image with meaningful alt
- [ ] No N+1 queries (check Query Monitor)

## Tests & verification
- Query Monitor
- Keyboard + screen reader spot check
- Screenshots 3 languages
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/10-project-archive.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 10 (Project archive & filtering) as specified, on branch
feature/10-project-archive. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
