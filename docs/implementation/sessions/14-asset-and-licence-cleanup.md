# Session 14 — Asset & licence clean-up

**Status**: Pending · **Phase**: 8 · **Branch**: `feature/14-asset-and-licence-cleanup`

## Objective
Ensure every file in the repo is owned by the owner or properly licensed for public redistribution.

## Required context
- PROJECT_CONTEXT.md
- AUDIT.md P-01

## Prerequisites
- Session 13

## Scope
- Remove BootstrapMade demo images and any remaining iPortfolio code/comments
- Replace `screenshot.png` (1200×900) with a real screenshot of the new theme
- `CREDITS.md` / readme.txt credits: `_s` (GPL), fonts (OFL), any icons (licence)
- Personal photos: only those the owner approves for public repo

## Out of scope
- Choosing the code licence (Q-01, owner)

## Expected file changes
| File | Change |
|---|---|
| `assets/img/*` | remove/replace |
| `screenshot.png` | replace |
| `readme.txt credits` | modify |

## Acceptance criteria
- [ ] `grep -ri bootstrapmade` returns nothing
- [ ] Every bundled asset has a recorded licence

## Tests & verification
- Manual file-by-file review list in HANDOFF
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/14-asset-and-licence-cleanup.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 14 (Asset & licence clean-up) as specified, on branch
feature/14-asset-and-licence-cleanup. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
