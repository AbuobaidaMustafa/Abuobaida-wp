# Session 04 — Design direction exploration

**Status**: Pending · **Phase**: 1 · **Branch**: `feature/04-design-direction`

## Objective
Choose the visual direction with the owner by comparing 2–3 rendered homepage concepts in English and Arabic.

## Required context
- PROJECT_CONTEXT.md
- IMPLEMENTATION_PLAN.md §4
- docs/baseline/
- docs/content/projects.md
- DECISIONS.md D-10, D-11

## Prerequisites
- Session 01 (real content to design with)

## Scope
- Mock up homepage (desktop + mobile) for: A 'Engineering notebook' (recommended), B 'Dark terminal', C 'Classic CV' — using Claude's Design artifacts where available
- Show the recommended direction also in Arabic (RTL) and with Chinese text to test typography
- Mock the project card and case-study header for the chosen direction
- Compare: hierarchy, project presentation, readability, RTL/CJK behaviour, implementation cost
- Record choice in DECISIONS.md

## Out of scope
- Theme code
- Every minor component

## Expected file changes
| File | Change |
|---|---|
| `docs/design/DIRECTION.md` | add |
| `docs/design/mockups/ (exports/links)` | add |
| `DECISIONS.md` | update |

## Acceptance criteria
- [ ] Owner has picked a direction (new D-entry)
- [ ] Mockups use real content only, no lorem ipsum claims
- [ ] RTL and CJK rendering reviewed

## Tests & verification
- Owner review
- Contrast check of proposed palette (WCAG AA)
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/04-design-direction.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 04 (Design direction exploration) as specified, on branch
feature/04-design-direction. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
