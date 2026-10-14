# Session NN: <Title>

**Status:** Pending | In progress | Done
**Phase:** N
**Size:** S | M | L
**Branch:** `feature/NN-short-name` (from `v2`, or from `master` for pre-v2 sessions)

## Objective

One or two sentences: what is true after this session that isn't true now.

## Required context

- `docs/implementation/PROJECT_CONTEXT.md`
- `DECISIONS.md` → D-xx, D-yy
- `ARCHITECTURE.md` § …, `MULTILINGUAL.md` § …
- Code: `path/to/file.php`, …

## Prerequisites

- Sessions: NN done
- Gate: G1 passed (UI sessions)
- Owner input: Q-xx answered, or proceed with the stated default and record it

## Scope

- …

## Out of scope

- …

## Expected file changes

| File | Change |
|---|---|
| `…` | add / modify / remove |

## Acceptance criteria

- [ ] …
- [ ] Inventory features touched here still work: F-xx, F-yy.

## Tests and verification

- The definition of done in `TEST_STRATEGY.md` §4, items 1–9, as they apply.
- Session-specific checks: …
- Record what could **not** be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md`, PLAN §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/NN-<name>.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Implement Session NN as specified on branch feature/NN-<name>.
Inspect existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
