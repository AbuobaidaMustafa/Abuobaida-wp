# Session 15: Accessibility and cross-language QA, regression against the inventory

**Status:** Pending  
**Phase:** 7  
**Size:** M  
**Branch:** `feature/15-qa`  
**Depends on:** 14, 17

## Objective

Verify the whole theme against WCAG 2.2 AA and the feature inventory in all three languages, and fix what's found.

## Required context

- PROJECT_CONTEXT.md
- TEST_STRATEGY.md §4–5
- IMPLEMENTATION_PLAN.md §3

## Prerequisites

- S14
- S17 drafts present (or placeholders flagged)

## Scope

- axe on every template in en, ar and zh; keyboard pass; 200% and 400% zoom; text-spacing override; reduced motion; high-contrast or forced colours
- The owner's screen-reader pass (VoiceOver or NVDA) on home, a case study and the menu, in en and ar, using the script in `docs/QA_REPORT.md`
- Feature inventory F-01–F-15 checklist with evidence (screenshot or test)
- Responsive pass at 320–1920 px
- Fix the issues found (small fixes here; anything large becomes a new session spec)

## Out of scope

- New features

## Expected file changes

| File | Change |
|---|---|
| `docs/QA_REPORT.md` | add |
| `Fixes as found` | modify |

## Acceptance criteria

- [ ] 0 serious or critical axe violations
- [ ] Every inventory item ticked or retired by a decision
- [ ] The QA report lists everything not tested and why

## Tests and verification

- As in scope
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/15-accessibility-and-regression-qa.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 15 (Accessibility and cross-language QA, regression against the inventory) as specified on branch feature/15-qa.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
