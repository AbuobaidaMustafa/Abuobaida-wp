# Session 15 — Translation completion (ar, zh_CN)

**Status**: Pending · **Phase**: 8 · **Branch**: `feature/15-translations`

## Objective
Complete Arabic and Chinese translations of theme strings and site content.

## Required context
- PROJECT_CONTEXT.md
- DECISIONS.md D-03, D-12, Q-06

## Prerequisites
- Sessions 09–12
- Q-06 answered

## Scope
- Regenerate `.pot`; complete `ar.po`, `zh_CN.po`; compile `.mo`
- Translate page content, projects, menus, CF7 forms, ACF fields (drafts by Claude only if owner opted in; owner reviews before publish)
- Arabic testimonials stay original; decide whether to show translations

## Out of scope
- New content

## Expected file changes
| File | Change |
|---|---|
| `languages/*.po, *.mo` | add/update |

## Acceptance criteria
- [ ] No untranslated theme strings in ar/zh (check with `msgfmt --statistics`)
- [ ] Owner sign-off on Arabic and Chinese copy

## Tests & verification
- Screenshots of every template in 3 languages
- `msgfmt -c`
- Record anything that could not be verified, and why.

## Documentation updates
- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §8; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session
```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/15-translations.md, plus the decisions and code it lists.
Do not repeat the audit. Implement Session 15 (Translation completion (ar, zh_CN)) as specified, on branch
feature/15-translations. Inspect the existing code first, explain key decisions briefly,
and separate verified results from assumptions. Do not push, open PRs or publish.
At the end, update HANDOFF.md, SESSION_INDEX.md and the progress log in IMPLEMENTATION_PLAN.md.
```
