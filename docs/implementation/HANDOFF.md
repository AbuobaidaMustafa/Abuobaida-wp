# Handoff

_Last updated: 2026-10-14 — end of Session 00_

## Current state
- Audit and planning complete. Docs live in `docs/implementation/` on local branch `docs/modernization-plan` (one commit, **not pushed**).
- No theme code has been changed.
- New requirement recorded: site in **Arabic, English and Chinese** (D-03). Built into Sessions 04, 05, 08, 15.

## Most important findings
1. Front-end is the BootstrapMade iPortfolio *free* template with its required credit removed — cannot be published as a public theme in its current form (AUDIT P-01).
2. Homepage outputs two doctypes/heads; posts/pages/archives render with no `<body>` or navigation (P-02, P-03).
3. Portfolio section is nine placeholder images — no real projects (P-04).
4. Fatal error if ACF is deactivated (P-05); phone/age/nationality are public (P-06).

## Waiting on the owner
Answers to `DECISIONS.md` open questions, most urgently:
- Q-03 hosting PHP/WP versions + active plugins · Q-04 ACF JSON + content export
- Q-02 real project list · D-12 default language and Chinese variant
- Approval of D-02 (classic + theme.json), D-05 (companion plugin), D-06 (hide personal details), D-08 (Polylang)

## Next recommended task
**Session 02 — Repo hygiene & dev tooling** (`sessions/02-repo-hygiene-and-tooling.md`). It needs no owner input and unlocks linting and a local WordPress for every later session. Session 01 starts as soon as the exports arrive.

## Not verified
- Live site HTML (robots.txt blocks automated fetching); relied on owner screenshots.
- No local WordPress run yet; plugin identities (`cb/carousel` = Carousel Block) assumed.
