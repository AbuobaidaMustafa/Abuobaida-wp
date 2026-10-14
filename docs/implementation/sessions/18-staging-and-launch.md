# Session 18: Staging rehearsal, migration and launch

**Status:** Pending  
**Phase:** 8  
**Size:** M  
**Branch:** `release/2.0.0`  
**Depends on:** 15, 16, 17 (G2, G3)

## Objective

Move v2 to production safely: rehearse on staging, migrate content, switch, verify, with a tested rollback.

## Required context

- PROJECT_CONTEXT.md
- IMPLEMENTATION_PLAN.md §8
- MULTILINGUAL.md §2, §8
- TEST_STRATEGY.md §4

## Prerequisites

- S15, S16, S17
- G2 and G3 passed
- The owner has backups and the deployment access

## Scope

- Runbook `docs/LAUNCH_RUNBOOK.md`: exact steps, commands, checks and the rollback
- Rehearsal on staging (or a fallback plan) with production content
- Launch support: the owner runs the steps; Claude prepares the commands and checks the results from the screenshots and logs the owner shares
- Fill in the case study's "after" numbers

## Out of scope

- Hosting migration

## Expected file changes

| File | Change |
|---|---|
| `docs/LAUNCH_RUNBOOK.md` | add |
| `style.css (version 2.0.0), CHANGELOG.md` | modify |

## Acceptance criteria

- [ ] The S15 checklist passes on production in 3 languages
- [ ] Forms deliver mail
- [ ] Rollback rehearsed once on staging

## Tests and verification

- Production smoke test per the runbook
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Notes

Merging `v2` into `master` and tagging happen only with the owner's go-ahead.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/18-staging-and-launch.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 18 (Staging rehearsal, migration and launch) as specified on branch release/2.0.0.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
