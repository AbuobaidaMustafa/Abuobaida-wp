# Session 16 — Accessibility & regression QA

**Status**: Pending · **Phase**: 7 · **Branch**: `feature/16-accessibility-and-regression-qa`

## Objective
Verify the whole theme against WCAG 2.2 AA and the original feature inventory before release.

## Required context
- PROJECT_CONTEXT.md
- IMPLEMENTATION_PLAN.md §2
- docs/baseline/

## Prerequisites
- Sessions 13, 15

## Scope
- axe + manual keyboard + screen reader (NVDA or VoiceOver) pass on each template in en and ar
- Zoom 200%/400%, reduced motion, high-contrast mode
- Feature inventory F-01..F-15 checklist with evidence
- Responsive pass 320–1920 px
- Security review: escaping/sanitizing grep, no debug output, no secrets

## Out of scope
- New features

## Expected file changes
| File | Change |
|---|---|
| `docs/QA_REPORT.md` | add |
| `fixes as found` | modify |

## Acceptance criteria
- [ ] No serious/critical axe issues
- [ ] Every inventory item ticked or retired by decision
- [ ] QA report lists what was not tested

## Tests & verification
- As in scope
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/16-accessibility-and-regression-qa.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 16 (Accessibility & regression QA) as specified, on branch
feature/16-accessibility-and-regression-qa. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
