# Session 17 — Public release preparation

**Status**: Pending · **Phase**: 8 · **Branch**: `feature/17-public-release`

## Objective
Make the repository publicly presentable and ready for a tagged release — without publishing anything until the owner approves.

## Required context
- PROJECT_CONTEXT.md
- DECISIONS.md Q-01

## Prerequisites
- Sessions 14, 16
- Q-01 licence chosen

## Scope
- README.md: overview, screenshots, features, architecture, requirements, local dev, translations, credits
- CHANGELOG.md (Keep a Changelog), version bump, `readme.txt` sync
- LICENSE per Q-01
- Secret/PII scan of full history (`gitleaks` or `git log -p` grep); decide whether history needs rewriting
- Suggested repo name/description/topics; release checklist; `npm/composer bundle` zip excluding dev files
- Prepare (not execute) push, PR and release steps for owner approval

## Out of scope
- Pushing, publishing, changing visibility (owner does or explicitly authorises)

## Expected file changes
| File | Change |
|---|---|
| `README.md, CHANGELOG.md, LICENSE, readme.txt` | modify/add |
| `docs/RELEASE_CHECKLIST.md` | add |

## Acceptance criteria
- [ ] Secret scan clean
- [ ] Zip installs and activates on a fresh WP
- [ ] Owner approval recorded before any push

## Tests & verification
- Install zip on clean WP
- Secret scan
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/17-public-release.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 17 (Public release preparation) as specified, on branch
feature/17-public-release. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
