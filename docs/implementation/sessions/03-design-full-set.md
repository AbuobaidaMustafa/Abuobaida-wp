# Session 03: Full design set and approval (gate G1)

**Status:** Pending  
**Phase:** 1  
**Size:** L  
**Branch:** `(no code; canvas only)`  
**Depends on:** 02 (01 helps)

## Objective

Design every template and state of the chosen direction in all three languages, so implementation has no visual unknowns. Close gate G1.

## Required context

- PROJECT_CONTEXT.md
- DESIGN_BRIEF.md §5
- CONTENT_STRATEGY.md §3–6
- ARCHITECTURE.md §4–5
- MULTILINGUAL.md §5–6

## Prerequisites

- S02 done
- S01 content, if available (otherwise placeholders)

## Scope

- Artboards (desktop and phone): project archive with filter states, About page, article/post, search results and the empty state, 404, contact form states (default, focus, error, sent), navigation open and closed, language switcher states
- Arabic (RTL) and Chinese variants of the homepage, case study and archive, at least at phone width
- Final token sheet: colours with contrast, fluid type scale per script, spacing, radii, focus ring, motion rules
- Write `docs/DESIGN_SYSTEM.md` from the token sheet, mapped to `theme.json` preset names
- Run the DESIGN_BRIEF §5 approval checklist with the owner

## Out of scope

- Theme code
- Illustrations or photography production

## Expected file changes

| File | Change |
|---|---|
| `Design canvas` | add artboards |
| `docs/DESIGN_SYSTEM.md` | add |
| `docs/implementation/DECISIONS.md` | update (G1 recorded) |

## Acceptance criteria

- [ ] Every template in ARCHITECTURE §4 has an approved artboard
- [ ] The token sheet maps one-to-one to `theme.json` presets
- [ ] **G1 recorded as passed in DECISIONS with the date**

## Tests and verification

- Contrast table complete
- Every interactive state drawn
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/03-design-full-set.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 03 (Full design set and approval (gate G1)) as specified.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
