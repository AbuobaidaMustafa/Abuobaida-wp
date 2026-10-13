# Session 00 — Audit & planning

**Status**: Done · **Phase**: 0 · **Branch**: `feature/00-audit-and-planning`

## Objective
Audit the existing theme and produce the roadmap and session documentation.

## Required context
- Full repository (one-time)

## Prerequisites
- None

## Scope
- Read-only audit of all code and history
- Write `docs/implementation/*`

## Out of scope
- Any change to theme code

## Expected file changes
| File | Change |
|---|---|
| `docs/implementation/**` | add |

## Acceptance criteria
- [ ] Audit, plan, decisions, handoff, index and session files exist
- [ ] No theme file modified

## Tests & verification
- `php -l` on all PHP files (done: all clean on PHP 8.3)
- Live site not fetched (robots.txt); owner screenshots used
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/00-audit-and-planning.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 00 (Audit & planning) as specified, on branch
feature/00-audit-and-planning. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
