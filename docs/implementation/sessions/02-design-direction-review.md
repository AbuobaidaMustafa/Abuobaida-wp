# Session 02: Design direction review and selection

**Status:** Pending  
**Phase:** 1  
**Size:** M  
**Branch:** `(no code; canvas only)`  
**Depends on:** 00

## Objective

Turn the owner's feedback on the pre-design canvas into one chosen, named direction (D-25 confirmed). Canvas: <https://claude.ai/artifact/DF4jsBp8VwhkEZWAERxXzK>

## Required context

- PROJECT_CONTEXT.md
- DESIGN_BRIEF.md
- MULTILINGUAL.md §6
- DECISIONS.md D-10, D-11, D-15, D-18, D-25, Q-10

## Prerequisites

- The owner has looked at the canvas and given feedback (comments on artboards or notes in chat)

## Scope

- Read the canvas comments and the owner's notes
- Revise the chosen direction's artboards, or build a named mix (for example "A layout with C colours"); keep option names stable
- Settle the open visual questions: photo or none, the Chinese name, the availability line, the 404 treatment
- Record the decision: D-25 confirmed (or superseded), D-10 font family final

## Out of scope

- Full page set (S03)
- Theme code

## Expected file changes

| File | Change |
|---|---|
| `Design canvas artboards` | modify/add |
| `docs/implementation/DECISIONS.md` | update |
| `docs/implementation/DESIGN_BRIEF.md` | update §2–3 |

## Acceptance criteria

- [ ] The owner names the chosen direction in writing
- [ ] The revised artboards reflect every feedback item, or the reply explains why not

## Tests and verification

- Contrast of every new colour pair computed and recorded (≥ 4.5:1 for text)
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Notes

The canvas instructions forbid screenshotting artboards unless the owner asks. Review is by the owner.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/02-design-direction-review.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 02 (Design direction review and selection) as specified.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
