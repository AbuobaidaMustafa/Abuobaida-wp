# Session 00: Audit and planning (v2) and pre-design

**Status:** Done  
**Phase:** 0  
**Size:** L  
**Branch:** `docs/modernization-plan`  
**Depends on:** —

## Objective

Measure the current theme, verify platform facts, produce the plan, decisions and session specs, and present design concepts for the owner to review.

## Required context

- The full repository, one time only

## Prerequisites

- None

## Scope

- Read-only audit, measured on a local WordPress 7.1.3
- PHPCS/WPCS and PHPCompatibility run
- Polylang spike
- Pre-design canvas with 3 directions
- All docs under `docs/implementation/` plus `docs/baseline/`

## Out of scope

- Any change to theme code

## Expected file changes

| File | Change |
|---|---|
| `docs/implementation/**` | add/rewrite |
| `docs/baseline/**` | add |

## Acceptance criteria

- [ ] Every audit claim is tagged measured, fact, owner screenshot or assumption
- [ ] The local-environment recipe works from scratch
- [ ] No theme file modified

## Tests and verification

- `setup.sh` run in a fresh directory; homepage and admin served
- Measurements stored in `docs/baseline/report.json`
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/00-audit-and-planning.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 00 (Audit and planning (v2) and pre-design) as specified on branch docs/modernization-plan.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
