# Session 16: Security and compatibility review

**Status:** Pending  
**Phase:** 7  
**Size:** S  
**Branch:** `feature/16-security`  
**Depends on:** 14

## Objective

Confirm the theme and plugin are safe and compatible across the supported PHP, WordPress and plugin matrix.

## Required context

- PROJECT_CONTEXT.md
- ARCHITECTURE.md §2, §8
- TEST_STRATEGY.md §5

## Prerequisites

- S14

## Scope

- Escaping and sanitising review (grep for `echo`, `printf`, `_e(`; PHPCS security sniffs at 0 errors)
- PHPCompatibility 8.1–8.5; runtime smoke test on WordPress 6.6 and 7.1 (the local env with `WP_TAG`)
- Plugin-off matrix (ACF, Polylang, CF7, abuobaida-core) on every template
- Secret and PII scan of the working tree

## Out of scope

- Server hardening

## Expected file changes

| File | Change |
|---|---|
| `docs/SECURITY_REVIEW.md` | add |
| `Fixes as found` | modify |

## Acceptance criteria

- [ ] 0 PHPCS security errors
- [ ] No fatal error or warning in the matrix
- [ ] Scan clean

## Tests and verification

- As in scope
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/16-security-and-compatibility.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 16 (Security and compatibility review) as specified on branch feature/16-security.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
