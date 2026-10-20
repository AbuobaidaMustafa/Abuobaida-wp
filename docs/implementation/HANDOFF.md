# Handoff

*Last updated: 2026-10-20, end of Session 05 (theme 1.0.1).*

## Branches

| Branch | Content | State |
|---|---|---|
| `docs/modernization-plan` | S00: audit, plan, decisions, specs, baseline, design brief | Ready |
| `feature/04-repo-hygiene` | S04 on top of the docs branch: tooling, CI, metadata | Ready |
| `feature/05-v1-hotfix` | S05 on top of S04: theme **1.0.1** | Ready |
| `master` / `main` | Untouched. `main` is an orphan branch holding a 2021 zip (Q-14). | — |

**Push status:** the push was refused because the Claude GitHub App has no access to this repository (D-28 can't be carried out yet). To fix it, install the app on the repository (<https://github.com/apps/claude/installations/select_target>) or reconnect GitHub in claude.ai settings, then ask Claude to push. Until then, the branches are delivered as a git bundle and patch files.

**Merge:** `feature/05-v1-hotfix` contains everything (docs → S04 → S05). Merging it into `master` brings all three.

## Deploying 1.0.1 to the live site (the owner's step)

1. **Back up:** download the current `wp-content/themes/abuobaida` folder, or keep `abuobaida-1.0.0-rollback.zip`.
2. **Upload:** Appearance → Themes → Add New → Upload Theme → `abuobaida-1.0.1.zip` → **Replace active with uploaded**.
3. **Check:**
   - the homepage looks as before;
   - a blog post and `/any-missing-url/` now show the sidebar;
   - with JavaScript disabled, the homepage content is visible;
   - the contact form sends.
4. **Optional:** Customizer → *Social links and contact form*: enter real profile URLs (the icons link to `#` until you do).
5. **Roll back:** upload `abuobaida-1.0.0-rollback.zip` the same way. No data changes are involved.

## What 1.0.1 fixes (details in `sessions/05-v1-hotfix.md`)

- One valid document on every page. Posts, pages, archives and search previously had no `<body>` and no navigation.
- No crash without ACF: fields are read from post meta. No warnings on empty fields. No raw shortcode when CF7 is off.
- Content is visible without JavaScript, and reduced motion is respected.
- The mobile menu is a keyboard-operable button.
- Named icon links, visible focus, AA link colour on content pages, and a titled map.
- Upload URLs follow the site address. Favicons are fixed.
- The whole theme passes WPCS 3.4 and PHPCompatibility, and CI gates on it.

## Decisions on 2026-10-20

- **D-25:** design A.
- **D-22:** hotfix.
- **D-27:** no ACF in v2, native fields.
- **D-28:** push feature branches for review.

New questions:

- **Q-14:** the orphan `main` branch.
- **Q-15:** restore the BootstrapMade credit that the free licence requires.

## Next recommended tasks

1. **Owner:** grant GitHub access; deploy 1.0.1; answer Q-14 and Q-15.
2. **S03:** full design set for direction A, then **gate G1**. Required before S06 and any v2 UI.
3. **S07:** the companion plugin with native fields (D-27). It has no UI, so it can run before G1. Branch from `feature/05-v1-hotfix`, or from `master` once that is merged.

## Waiting on the owner

- **S01 inputs:** hosting PHP and WordPress versions, the plugin list (Q-03), the content export (Q-04), and the content questionnaire (CONTENT_STRATEGY §8).
- **Q-10:** Arabic name spelling, 马飞, photo.
