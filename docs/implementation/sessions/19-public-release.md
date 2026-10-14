# Session 19: Public repository release

**Status:** Pending  
**Phase:** 8  
**Size:** M  
**Branch:** `release/public`  
**Depends on:** 15, 16 (G4)

## Objective

Make the repository publicly presentable: documentation, licence, clean history decision, screenshots and an installable zip. Publish only with explicit approval.

## Required context

- PROJECT_CONTEXT.md
- DECISIONS.md D-26, Q-01
- AUDIT.md P-01, P-15

## Prerequisites

- S15, S16
- G4: licence chosen (Q-01), history decision (D-26)

## Scope

- README.md: what it is, screenshots (en, ar, zh), features, architecture summary, requirements, local development (tools/), translations, credits
- CHANGELOG.md (Keep a Changelog), `readme.txt` in sync, LICENSE per Q-01
- History and secret scan (`git log -p` grep for keys, emails and phone numbers; gitleaks if available); carry out the D-26 decision: a fresh public repository or a history rewrite, prepared but not executed without approval
- Suggested repository name, description and topics; release zip built with `.distignore`; release notes draft
- Exact push and release commands for the owner to run or approve

## Out of scope

- Pushing or publishing without approval

## Expected file changes

| File | Change |
|---|---|
| `README.md, CHANGELOG.md, LICENSE, readme.txt` | rewrite/add |
| `docs/RELEASE_CHECKLIST.md` | add |

## Acceptance criteria

- [ ] Secret and PII scan clean (report attached)
- [ ] The zip installs and activates on a fresh WordPress 7.1
- [ ] The owner's approval recorded before any push

## Tests and verification

- Fresh install from the zip
- Scan
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/19-public-release.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 19 (Public repository release) as specified on branch release/public.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
