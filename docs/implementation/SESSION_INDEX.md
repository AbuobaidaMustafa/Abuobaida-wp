# Session Index

One line per session. The details are in `sessions/`. Update the status at the end of every session.

**Gates:**

- G1: design approved (before S06)
- G2: content ready
- G3: release ready (before S18)
- G4: go public (before the S19 push)

| # | Session | Phase | Size | Depends on | Status | File |
|---|---|---|---|---|---|---|
| 00 | Audit and planning (v2) and pre-design | 0 | L | — | ✅ Done | [00-audit-and-planning.md](sessions/00-audit-and-planning.md) |
| 01 | Production inventory and content intake | 0 | S | 00 | Waiting on owner input | [01-production-inventory.md](sessions/01-production-inventory.md) |
| 02 | Design direction review and selection | 1 | M | 00 | ✅ Done (A chosen) | [02-design-direction-review.md](sessions/02-design-direction-review.md) |
| 03 | Full design set and approval (gate G1) | 1 | L | 02 (01 helps) | ⏳ Next | [03-design-full-set.md](sessions/03-design-full-set.md) |
| 04 | Repo hygiene, dev tooling and CI | 2 | M | 00 | ✅ Done (push pending GitHub access) | [04-repo-hygiene-and-tooling.md](sessions/04-repo-hygiene-and-tooling.md) |
| 05 | Optional hotfix of the live v1 theme | 2 | M | 04 | ⏳ Next (approved, D-22) | [05-v1-hotfix.md](sessions/05-v1-hotfix.md) |
| 06 | v2 foundation: structure, tokens, fonts, assets, i18n adapter | 2 | L | 03 (G1), 04 | Pending | [06-v2-foundation.md](sessions/06-v2-foundation.md) |
| 07 | Companion plugin and content model | 2 | L | 04 (01 helps) | Pending | [07-content-model-plugin.md](sessions/07-content-model-plugin.md) |
| 08 | Site shell: header, navigation, language switcher, footer | 3 | M | 06 | Pending | [08-site-shell.md](sessions/08-site-shell.md) |
| 09 | Homepage I: hero, selected work, capabilities | 4 | M | 07, 08 | Pending | [09-homepage-hero-work-capabilities.md](sessions/09-homepage-hero-work-capabilities.md) |
| 10 | Homepage II: testimonials, contact, résumé, map | 4 | M | 07, 08 | Pending | [10-homepage-testimonials-contact.md](sessions/10-homepage-testimonials-contact.md) |
| 11 | Projects archive and filter | 5 | M | 07, 08 | Pending | [11-projects-archive.md](sessions/11-projects-archive.md) |
| 12 | Project case study template | 5 | M | 11 | Pending | [12-project-case-study.md](sessions/12-project-case-study.md) |
| 13 | Other templates: page/About, posts, archive, search, comments, 404 | 6 | M | 08 | Pending | [13-other-templates-and-404.md](sessions/13-other-templates-and-404.md) |
| 14 | Performance, vendor removal, asset and licence clean-up | 7 | M | 09–13 | Pending | [14-performance-and-cleanup.md](sessions/14-performance-and-cleanup.md) |
| 15 | Accessibility and cross-language QA, regression against the inventory | 7 | M | 14, 17 | Pending | [15-accessibility-and-regression-qa.md](sessions/15-accessibility-and-regression-qa.md) |
| 16 | Security and compatibility review | 7 | S | 14 | Pending | [16-security-and-compatibility.md](sessions/16-security-and-compatibility.md) |
| 17 | Translations and content entry | 8 | M | 09–13 | Pending | [17-translations-and-content.md](sessions/17-translations-and-content.md) |
| 18 | Staging rehearsal, migration and launch | 8 | M | 15, 16, 17 (G2, G3) | Pending | [18-staging-and-launch.md](sessions/18-staging-and-launch.md) |
| 19 | Public repository release | 8 | M | 15, 16 (G4) | Pending | [19-public-release.md](sessions/19-public-release.md) |

**Recommended next:**

- **S05:** live-site hotfix (approved, D-22). Builds on S04.
- **S03:** full design set in direction A, ending with gate G1.
- **S07:** the companion plugin with native fields (D-27). It can start before G1 because it has no UI.
- **S01:** whenever the owner sends the hosting facts, exports and the questionnaire.
