# Session 17: Translations and content entry

**Status:** Pending  
**Phase:** 8  
**Size:** M  
**Branch:** `feature/17-translations`  
**Depends on:** 09–13

## Objective

Complete the Arabic and Chinese theme strings and content (front pages, projects, menus, forms, About), drafted by Claude where agreed and reviewed by the owner.

## Required context

- PROJECT_CONTEXT.md
- MULTILINGUAL.md §6–7
- CONTENT_STRATEGY.md
- docs/content/*
- DECISIONS.md Q-06, Q-07

## Prerequisites

- S09–S13
- Q-06 answered

## Scope

- Regenerate `.pot`; complete `ar.po` and `zh_CN.po`; compile `.mo`
- `docs/content/GLOSSARY.md` (fixed term translations)
- Draft the ar and zh content files under `docs/content/` for the owner's review (marked DRAFT); enter the approved content in the local environment
- Form copy per language (CF7 messages)
- Production entry checklist for S18

## Out of scope

- Inventing content

## Expected file changes

| File | Change |
|---|---|
| `languages/*.po, *.mo, abuobaida.pot` | add/update |
| `docs/content/GLOSSARY.md, docs/content/*-ar.md, *-zh.md` | add |

## Acceptance criteria

- [ ] `msgfmt --statistics`: 0 untranslated strings
- [ ] The owner signs off on ar and zh content (recorded in HANDOFF)

## Tests and verification

- `msgfmt -c`
- Screenshots of every template in 3 languages
- Record anything that could not be verified, and why.

## Documentation updates

- `HANDOFF.md`, `SESSION_INDEX.md` status, `IMPLEMENTATION_PLAN.md` §11; `DECISIONS.md` if anything was decided.

## Prompt for a fresh Claude session

```
Project: Abuobaida WordPress portfolio theme (repo AbuobaidaMustafa/Abuobaida-wp).
Read docs/implementation/PROJECT_CONTEXT.md, docs/implementation/SESSION_INDEX.md and
docs/implementation/sessions/17-translations-and-content.md, plus only the decisions, docs sections and code it lists.
Do not repeat the audit. Carry out Session 17 (Translations and content entry) as specified on branch feature/17-translations.
Inspect the existing code first, explain key decisions briefly, verify per TEST_STRATEGY §4,
and separate verified results from assumptions. Never invent content; use [placeholders] and ask.
Do not push, open PRs or publish. At the end, update HANDOFF.md, SESSION_INDEX.md
and the progress log in IMPLEMENTATION_PLAN.md (and DECISIONS.md if anything was decided).
```
