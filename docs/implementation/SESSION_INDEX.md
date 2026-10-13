# Session Index

One line per session. Details in `sessions/`. Update status at the end of every session.

| # | Session | Phase | Depends on | Status | File |
|---|---|---|---|---|---|
| 00 | Audit & planning | 0 | — | ✅ Done | [00-audit-and-planning.md](sessions/00-audit-and-planning.md) |
| 01 | Baseline & content inventory | 0 | 00 | Waiting for owner input | [01-baseline-and-content-inventory.md](sessions/01-baseline-and-content-inventory.md) |
| 02 | Repo hygiene & dev tooling | 2 | 00 | ⏳ Next | [02-repo-hygiene-and-tooling.md](sessions/02-repo-hygiene-and-tooling.md) |
| 03 | Critical fixes on the current theme | 2 | 01, 02 | Pending | [03-critical-fixes.md](sessions/03-critical-fixes.md) |
| 04 | Design direction exploration | 1 | 01 | Pending | [04-design-direction.md](sessions/04-design-direction.md) |
| 05 | Design system & tokens (incl. RTL/CJK) | 1 | 04 | Pending | [05-design-system.md](sessions/05-design-system.md) |
| 06 | Project content model | 2 | 01, 03 | Pending | [06-project-content-model.md](sessions/06-project-content-model.md) |
| 07 | Site shell: header, navigation, footer | 3 | 03, 05 | Pending | [07-site-shell.md](sessions/07-site-shell.md) |
| 08 | Multilingual foundation & RTL | 3 | 07 | Pending | [08-multilingual-and-rtl.md](sessions/08-multilingual-and-rtl.md) |
| 09 | Homepage sections | 4 | 06, 08 | Pending | [09-homepage.md](sessions/09-homepage.md) |
| 10 | Project archive & filtering | 5 | 06, 08 | Pending | [10-project-archive.md](sessions/10-project-archive.md) |
| 11 | Project case-study template | 5 | 10 | Pending | [11-project-case-study.md](sessions/11-project-case-study.md) |
| 12 | Generic templates & 404 | 6 | 07 | Pending | [12-generic-templates-and-404.md](sessions/12-generic-templates-and-404.md) |
| 13 | Vendor removal & performance | 7 | 09–12 | Pending | [13-vendor-removal-and-performance.md](sessions/13-vendor-removal-and-performance.md) |
| 14 | Asset & licence clean-up | 8 | 13 | Pending | [14-asset-and-licence-cleanup.md](sessions/14-asset-and-licence-cleanup.md) |
| 15 | Translation completion (ar, zh_CN) | 8 | 09–12 | Pending | [15-translations.md](sessions/15-translations.md) |
| 16 | Accessibility & regression QA | 7 | 13, 15 | Pending | [16-accessibility-and-regression-qa.md](sessions/16-accessibility-and-regression-qa.md) |
| 17 | Public release preparation | 8 | 14, 16 | Pending | [17-public-release.md](sessions/17-public-release.md) |

Recommended next: **02 — Repo hygiene & dev tooling** (needs no owner input). In parallel, the owner gathers the inputs for **01** (ACF export, plugin list, PHP/WP versions, project list).
