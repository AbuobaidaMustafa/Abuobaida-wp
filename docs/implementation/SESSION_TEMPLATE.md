# Session NN — <Title>

**Status**: Pending | In progress | Done · **Phase**: N · **Branch**: `feature/NN-short-name`

## Objective
One or two sentences: what is true after this session that isn't true now.

## Required context
- `docs/implementation/PROJECT_CONTEXT.md`
- `docs/implementation/DECISIONS.md` → D-xx, D-yy
- Code: `path/to/file.php`, …

## Prerequisites
- Sessions: NN done
- Owner input: Q-xx answered (or proceed with stated default)

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
- [ ] Features from the inventory touched here still work (list F-ids).

## Tests & verification
- `composer lint` (PHPCS + parallel-lint) passes for changed files.
- Manual/automated checks: …
- Record what could **not** be verified and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md`, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, SESSION_INDEX.md, and
docs/implementation/sessions/NN-<name>.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session NN exactly as specified, on branch
feature/NN-<name>. Explain key decisions briefly. Do not push or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log.
```
