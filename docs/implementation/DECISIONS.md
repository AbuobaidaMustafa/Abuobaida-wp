# Decisions

Status: ✅ confirmed · 🟡 recommended, awaiting owner · ❓ open question. Add new entries at the bottom of the relevant list; never rewrite history — supersede instead.

## Confirmed

| ID | Decision | Date | Notes |
|---|---|---|---|
| D-01 | Evolve the existing repo `AbuobaidaMustafa/Abuobaida-wp`; no complete rewrite. Replace the iPortfolio presentation layer progressively. | 2026-10-14 | Owner brief + audit §7 |
| D-03 | Site languages: **Arabic, English, Chinese**. | 2026-10-14 | Owner request. Chinese assumed Simplified (`zh_CN`) — confirm in D-12. |
| D-04 | This project is fully separate from the Dropshipping OMS project (code, docs, repos, sessions). | 2026-10-14 | Owner brief |

## Recommended — awaiting owner approval

| ID | Proposal | Main trade-off |
|---|---|---|
| D-02 | **Classic theme + `theme.json`**, not a block/Site Editor theme. | Block theme would let you edit layout in the Site Editor, but would require rebuilding header/footer/home as block templates and re-wiring ACF + Polylang + CF7 through block bindings — high migration cost for a site whose content is structured fields, not free-form layouts. `theme.json` still gives tokens and good editor styling. |
| D-05 | Register the `project` post type + `project_type` taxonomy in a **small companion plugin** (`abuobaida-core`, separate repo or `/plugins` folder), not in the theme. | Correct WordPress separation and shows best practice; costs one more thing to install. Alternative: theme-registered (simpler, but projects disappear if the theme changes). |
| D-06 | Remove **age, nationality and phone** from the public page; keep email (preferably a domain address) + contact form. | Less personal info exposed vs. what some regional clients expect to see. |
| D-07 | Keep blog templates working and styled, but no blog-specific features (no related posts etc.). | Depends on whether you publish posts. |
| D-08 | Multilingual plugin: **Polylang (free)**. One post per language; theme strings via `.po/.mo`. Theme integrates only through `inc/i18n.php`. | WPML is more automatic (and paid); Polylang free can't sync ACF fields across translations, so each language's fields are entered separately — acceptable for a small site. |
| D-09 | Testimonials: keep the existing `cb/carousel` content short-term; long-term render them as a static, accessible list/grid (no autoplay) from a `testimonial` source. | Autoplay carousels fail accessibility; changing the source means re-entering reviews. |
| D-10 | Fonts: self-host one Latin+Arabic family (e.g. IBM Plex Sans Arabic / Noto Sans Arabic pairing) + a mono; **Chinese uses the system CJK stack** (PingFang SC, Microsoft YaHei, Noto Sans CJK SC). | CJK webfonts are multi-MB; system fonts are fast and native-looking but vary by device. Final pick in Session 05. |
| D-11 | Light theme only at launch; dark mode only if Session 04 shows it serves the design. | Owner brief: no fashion-driven dark mode. |
| D-13 | Minimum requirements: **WordPress 6.5, PHP 8.1** — pending hosting check. | Higher minimums allow cleaner code; must not exceed what the host runs. |
| D-14 | No build toolchain at first: plain CSS (custom + logical properties) and vanilla JS. Composer for PHPCS/linting only. | Revisit only if CSS size or JS needs justify it. |
| D-15 | Remove skill-percentage bars and the Typed.js animation. | Percentages read as unprofessional and are inaccessible; animation adds JS for little value. |

## Open questions for the owner

| ID | Question | Blocks |
|---|---|---|
| Q-01 | Which open-source licence? (GPL-2.0-or-later is required for code derived from `_s`; you can choose how to license your own images/content separately.) | 17 |
| Q-02 | Real projects: list 4–8 projects (name, your role, stack, year, link/repo, screenshots, outcome) incl. AI/ML work. Which may be named publicly? | 06, 09, 11 |
| Q-03 | Hosting: PHP and WordPress versions; list of active plugins (ACF free/Pro? Contact Form 7, Carousel Block, others). | 01, 13 |
| Q-04 | Can you export ACF field groups (Tools → Export → JSON) and a WXR content export, or give me a staging copy? | 01, 03, 06 |
| Q-05 | Do you publish blog posts? | 12 (D-07) |
| D-12 | Default language (recommend **English**, with `/ar/` and `/zh/` URL prefixes)? Chinese Simplified or Traditional? | 08 |
| Q-06 | Translations: will you write/review the Arabic and Chinese copy, or should Claude draft translations for your review? | 15 |
| Q-07 | Updated professional summary: years of experience, current role, AI/ML focus — the current About text ("1+ years", Master's student) is outdated. | 09 |
