# Handoff

*Last updated: 2026-10-20, end of Session 04.*

## Current state

| Branch | Content | State |
|---|---|---|
| `docs/modernization-plan` | S00: audit, plan, decisions, session specs, baseline, design brief | Ready to push (D-28). **The push was refused:** the Claude GitHub App has no access to the repository. Delivered as a bundle and patches meanwhile. |
| `feature/04-repo-hygiene` | S04, on top of the docs branch | Same as above. |
| `master` / `main` | Untouched. `main` is an orphan branch holding a 2021 zip of the same theme (Q-14). | — |

**Merge order** (the owner's step): `docs/modernization-plan` → `master`, then `feature/04-repo-hygiene` → `master`. The S04 branch already contains the docs commits, so merging it alone brings both.

## Decisions taken on 2026-10-20

- **D-25:** design direction A "Survey".
- **D-22:** hotfix the live theme.
- **D-27:** no ACF in v2; native post and term meta with meta boxes in the companion plugin.
- **D-28:** feature branches are pushed for review; never `master` or `main`.

## What S04 delivered

- **Repo hygiene:** `.gitignore`, `.distignore` and `.editorconfig`. The `_s` lint configs are removed.
- **`tools/`:**
  - the local WordPress recipe;
  - the QA scripts;
  - a **changed-lines PHPCS gate**;
  - a **logical-CSS (RTL) gate**;
  - a checker installer;
  - a zip builder.
  Usage is in `tools/README.md`.
- **Configs:** `composer.json` (dev tools and scripts), `phpcs.xml.dist` (abuobaida prefix and text domain, WP 6.6 / PHP 8.1+) and `package.json` (Playwright and axe only).
- **CI:** `.github/workflows/ci.yml` runs PHP 8.1/8.3/8.5 syntax, the PHPCS changed-lines gate, an informational full report and the logical-CSS gate.
- **Theme metadata:** `style.css`, `style-rtl.css` and `readme.txt`. `_S_VERSION` is now `ABUOBAIDA_VERSION`. The dead `home.php`, `blocks/block-testimonial.php` and `template-parts/header-home.php` are removed.

## Verified / not verified

**Verified:**

- Rendered HTML of 7 page types is byte-identical before and after, and `debug.log` stays empty.
- The changed-lines gate passes, and it is proven to fail on new violations.
- Full PHPCS is down to 520 errors and 204 warnings in 9 files.
- The fresh `setup.sh` run works, and the zip installs and renders.

**Not verified:**

- The first GitHub Actions run. It happens once the branches are pushed.
- `composer install` itself (Packagist is blocked in Claude's workspace).

## Next recommended tasks

1. **S05, the live-site hotfix** (approved): branch `feature/05-v1-hotfix` from `feature/04-repo-hygiene`. Read v1 fields with `get_field()` when ACF is active, else from post meta (`about_*`, `contact_us_*`).
2. **S03, the full design set** for direction A, then **gate G1**. Required before S06 and any v2 UI.
3. **S07, the companion plugin** with native fields (D-27). It has no UI dependency, so it can run before G1.

## Waiting on the owner

- Give Claude push access: install the Claude GitHub App on the repository (github.com/apps/claude), or reconnect GitHub in claude.ai settings. Then Claude pushes both branches. Until then, apply the bundle or patches yourself.
- Review and merge the branches. Report any CI failures.
- Q-14: keep or delete the orphan `main` branch.
- S01 inputs: hosting PHP and WordPress versions, the plugin list (Q-03), the content export (Q-04), and the content questionnaire (CONTENT_STRATEGY §8).
- Q-10: Arabic name spelling, 马飞, photo.
