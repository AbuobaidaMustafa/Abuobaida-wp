# Session 11 — Project case-study template

**Status**: Pending · **Phase**: 5 · **Branch**: `feature/11-project-case-study`

## Objective
Present each project as a concise case study: problem, role, approach, stack, outcome, media.

## Required context
- PROJECT_CONTEXT.md
- docs/design/DIRECTION.md
- Session 06 fields

## Prerequisites
- Session 10

## Scope
- `single-project.php` with summary header, meta (role/year/stack/links), body sections, gallery (core gallery/lightbox, no GLightbox), oEmbed video
- Next/previous project navigation
- Structured data (CreativeWork) if no SEO plugin covers it

## Out of scope
- Writing case-study copy (owner)

## Expected file changes
| File | Change |
|---|---|
| `single-project.php` | add |
| `template-parts/project/*` | add |

## Acceptance criteria
- [ ] Empty optional fields render nothing (no empty headings)
- [ ] External links have `rel` and clear labels
- [ ] Images use responsive `srcset`

## Tests & verification
- Render projects with full and minimal data
- Lighthouse
- Screenshots 3 languages
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/11-project-case-study.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 11 (Project case-study template) as specified, on branch
feature/11-project-case-study. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
