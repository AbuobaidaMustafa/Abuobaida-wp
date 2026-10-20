# Decisions

Each entry has an ID, a status and its evidence.

**Statuses:**

- ✅ confirmed by the owner;
- 🟡 recommended and awaiting the owner;
- ❓ open question.

**How to change this file:**

- Never rewrite an entry. Supersede it with a new entry that points back to it.
- Sessions read only the IDs their spec lists.

## Confirmed

| ID | Decision | Date | Basis |
|---|---|---|---|
| D-01 | Evolve the existing repo `AbuobaidaMustafa/Abuobaida-wp` and keep the theme slug `abuobaida`. No from-scratch rewrite: replace the presentation layer (AUDIT §7). | 2026-10-14 | Owner brief, audit |
| D-03 | The site is published in **Arabic, English and Chinese**. | 2026-10-14 | Owner |
| D-04 | This project is fully separate from the Dropshipping OMS project: code, documentation, repositories and sessions. | 2026-10-14 | Owner brief |
| D-18 | **Design gate:** no UI implementation (Sessions 06 onward) until the owner has reviewed and approved the designs in Claude Design (gate G1). | 2026-10-14 | Owner: "I want to check before implemented" |
| D-25 | Design direction **A, "Survey"** is chosen. Session 03 completes the full design set in this direction for gate G1. | 2026-10-20 | Owner choice (S02) |
| D-22 | **Hotfix the live v1 theme** now (S05): document shell, no crash without ACF, content visible without JS, escaping, link names. No visual change. | 2026-10-20 | Owner: "Yes, fix it now" |
| D-27 | **No ACF in v2.** The companion plugin registers every custom field natively: `register_post_meta()` / `register_term_meta()` (typed, sanitised, `show_in_rest`, `auth_callback`) edited in PHP meta boxes with nonce and capability checks. No build step is needed. Legacy ACF values are plain post meta (`about_whoami`, `about_info_phone`, `contact_us_map`, …, verified locally), so the hotfix and the migration read them without ACF. ACF can be deactivated after launch (S18). **Supersedes D-16; closes Q-08.** D-09, D-19 and D-24 stand, with "fields" meaning native meta. | 2026-10-20 | Owner: "not depend on ACF; I prefer to code it and make post types if needed" |
| D-28 | **Delivery:** each session's work is pushed as a `feature/NN-*` branch (plus `docs/*` branches) to GitHub for the owner's review. Claude never pushes to `master` or `main`, never force-pushes shared branches, and opens no releases. The owner merges. | 2026-10-20 | Owner: "Push branches to GitHub" |

## Recommended, awaiting approval

### Architecture

| ID | Proposal | Evidence | Main trade-off |
|---|---|---|---|
| D-02 | Use a **classic theme with `theme.json` v3**. Not a block theme or the Site Editor. Revisit only if the owner buys Polylang Pro and wants to edit layouts in the Site Editor. | Underscores is inactive, but classic themes are fully supported in 7.1 and `theme.json` v3 is the latest schema. Polylang documents Site Editor translation as Pro-only. The content is structured (projects, fields). | A block theme gives visual layout editing and follows WordPress's direction. It would cost a rebuild into block templates, Polylang Pro for translated template parts, and ACF Blocks (Pro) or custom JS blocks for case studies. |
| D-05 | Register the `project` post type and its taxonomies in a **small companion plugin** (`abuobaida-core`), not in the theme. | WordPress guidance: content must survive a theme change. | One more thing to install. The theme degrades gracefully when the plugin is missing. |
| D-13 | Theme header: **Requires at least 6.6, Requires PHP 8.1, Tested up to 7.1**. Production should run WordPress 7.1 on PHP **8.3 or newer** (8.4 recommended). | `theme.json` v3 needs WordPress 6.6. CF7 6.2.2 needs PHP 8.3 and WordPress 7.1. WordPress 7.1 recommends PHP 8.4/8.5. | Older hosts are excluded. Confirm hosting first (Q-03). |
| D-14 | **No build toolchain.** Plain CSS with custom properties and logical properties. Vanilla JS with deferred scripts or modules. Composer and Node only for development checks. | 11 MB of vendor code and a broken `node-sass` pipeline today. The design needs are modest. | Revisit only if CSS grows past about 60 KB or JS needs bundling. |
| D-17 | **Branches:** `master` stays production and receives only the optional hotfix (S05). The redesign lives on `v2`, with one `feature/NN-*` branch per session merged into `v2` after owner review. Launch merges `v2` into `master` with tag `v2.0.0`. Nothing is pushed without the owner's approval (approval for feature branches given in D-28). | A half-migrated design must never reach the live site. | A long-lived branch has to be rebased if `master` gets hotfixes. They are few. |
| D-23 | The **homepage and case studies are PHP template parts fed by structured fields**. The About page, generic pages and posts are **block content** styled through `theme.json`. | Gives design control and consistent markup for the key pages, and editor flexibility for prose. Both translate per post with Polylang free. | The owner edits homepage text through fields, not visually. Alternative: homepage as blocks plus Query Loop (more flexible, less designed, heavier core CSS). |

### Content model

| ID | Proposal | Evidence | Main trade-off |
|---|---|---|---|
| D-16 | **Superseded by D-27 (2026-10-20).** Use free ACF field types only: Group, Text, Textarea, Image, File, URL, Link, oEmbed, Taxonomy, Post Object, True/False. No Repeater or Gallery: screenshots go in a core Gallery block in the case study content. No Options page: global settings live in the Customizer. Supersede this if the owner has ACF PRO (Q-08). | ACF 6.8.10 free field list, verified in code. | A fixed number of field slots instead of repeaters. |
| D-24 | **Capabilities are `project_type` terms**: name, description and order. The homepage capability list links to the projects that prove each one. Terms are translated with Polylang's taxonomy translation. | It ties claims to evidence and needs no Repeater. Polylang free translates taxonomies. | Capabilities without a project need a term with no posts. That's allowed, and the link is hidden. |
| D-09 | **Testimonials become a `testimonial` post type in the companion plugin, shared across languages** (not Polylang-translated). Fields: client name, original quote with its language, an English and a Chinese translation, project (Post Object), platform name and URL, date. Each page shows the original quote and, where the page language differs, the translation labelled "Translated from Arabic". The current `cb/carousel` content is migrated by hand (two or more reviews). | Keeps one source of truth for genuine reviews. No autoplay carousel, which is an accessibility failure. | Re-entering the reviews once. Permission from the clients (Q-11). |
| D-19 | **Where settings live:** language-specific content sits on the front page of each language (hero statement, availability, contact form, résumé file). Global non-language settings (email, GitHub, LinkedIn, Mostaql URLs) live in the **Customizer**. | ACF Options pages are Pro-only, and free Polylang can't sync fields. A per-language front page is translated naturally. | Settings sit in two places, documented in `ARCHITECTURE.md`. |
| D-06 | **Remove age, nationality and phone number** from public pages. Show email (the domain address) and the contact form. | Privacy, finding P-09. | Some regional clients expect a phone number. The owner can opt back in per field. |
| D-07 | Keep blog templates working and styled. No blog-specific features. | Unknown whether posts exist (Q-05). | None if there are no posts. |
| D-15 | **Retire** skill percentage bars, the typing animation, scroll-reveal animation, autoplay sliders and the Isotope filter. Use no motion that the visitor didn't trigger. | Finding P-04 (invisible without JS), reduced motion ignored, percentages are meaningless. | Less "movement" on the page. That is intentional. |
| D-20 | The **Google Map embed** loads only on click, or is replaced by a text location link (owner's choice). | Privacy (third-party request on page load), performance, and an untitled iframe. | One extra click to see the map. |

### Multilingual

| ID | Proposal | Evidence | Main trade-off |
|---|---|---|---|
| D-08 | Use **Polylang (free) 3.8+**. Settings: languages en_US, ar, zh_CN; URLs by directory with the default language hidden; **"front page URL contains the language code"** turned on. Translatable: pages, posts, `project`, `project_type`. The theme talks to Polylang only through `inc/i18n.php` and still works without it. | Spike [M]: `dir`/`lang`/`hreflang` correct, `/ar/` and `/zh/` front pages work with that setting. | No field sync (each language fills its own fields), no XLIFF export. WPML is paid and heavier. |
| D-12 | Default language **English** at `/`, Arabic at `/ar/`, **Simplified Chinese** at `/zh/`. | Matches the current site (English). | If most clients are Arabic-speaking, Arabic could be the default. Owner decides (Q-07). |
| D-21 | **Western digits (0–9)** in all languages, including Arabic. | Consistency for code, dates and email. Common on the Arabic web. | Some readers prefer Eastern Arabic digits (٠–٩). Owner decides. |
| D-10 | **Fonts:** self-host one variable family that covers Latin and Arabic (chosen with the design direction: Readex Pro for A, IBM Plex Sans Arabic for B, Alexandria for C). **Chinese uses the system font stack** (PingFang SC, Microsoft YaHei, Noto Sans SC). Every font is SIL Open Font License. | CJK web fonts are several megabytes. Self-hosting avoids third-party requests (finding P-10). | Chinese rendering varies a little by device. |

### Design and release

| ID | Proposal | Evidence | Main trade-off |
|---|---|---|---|
| D-25 | **Confirmed 2026-10-20 (see Confirmed).** Design direction **A, "Survey"**: light, typography-led, the name in three scripts, a contour-line motif from the owner's research, survey blue `#0B5FA5` (6.1:1). Pending the owner's choice in Session 02. | Pre-design canvas, `DESIGN_BRIEF.md`. | B (Console) has stronger continuity with today's identity but weak Arabic and Chinese typography. C (Two Rivers) is the most personal, but costs more and is the hardest in RTL. |
| D-11 | Light theme only at launch. Dark mode only if the chosen direction calls for it. | Owner brief: no fashion-driven dark mode. | None. |
| D-22 | **Confirmed 2026-10-20 (see Confirmed).** Ship an **optional hotfix** (S05) to the current live theme: fix the document shell, guard ACF, make content visible without JS, fix escaping and link names. No visual changes. | The live site is broken for posts and pages and is one plugin deactivation away from a fatal error. The redesign will take weeks. | About one session of work on code that v2 replaces. |
| D-26 | The **old iPortfolio layer stays in git history** and is not rewritten out of it. The public repository is published only after the BootstrapMade files are removed from the tree. Whether to squash history before going public is decided in S19. | Licence (P-01). Rewriting history is irreversible for anyone who has cloned. | Old commits remain reachable in history. The licence restricts redistribution, so S19 must weigh a fresh public repository against a history rewrite (Q-01). |

## Open questions for the owner

| ID | Question | Blocks |
|---|---|---|
| Q-01 | Licence for your own code: GPL-2.0-or-later is required for code derived from `_s`. How do you want to license your images and writing? Should the public repository keep its history or start fresh (D-26)? | S19 |
| Q-02 | **Real projects:** 4–8 of them. For each: name, your role, stack, year, link or repo, screenshots, outcome. Include AI/ML work. Which may be named publicly? | S07, S09, S12 |
| Q-03 | **Hosting:** PHP version, WordPress version, the list of active plugins and versions (ACF free or PRO? CF7, Carousel Block, an SEO plugin, cache, security), and whether a staging site is possible. | S01, S05, S18 |
| Q-04 | ACF export (ACF → Tools → Export → JSON) and a content export (Tools → Export → All content). | S01 |
| Q-05 | Do you publish blog posts? | S13 (D-07) |
| Q-06 | Who writes and reviews the Arabic and Chinese text? Should Claude draft and you review? | S17 |
| Q-07 | Default language (D-12), and Simplified or Traditional Chinese? | S08 |
| Q-08 | ~~ACF free or PRO?~~ Closed by D-27: v2 doesn't use ACF. | — |
| Q-09 | Updated professional summary: current role, years of experience, Master's status at Lanzhou University, and AI/ML focus. The current About text says "1+ years". | S09, S13 |
| Q-10 | Is the Arabic spelling أبو عبيدة مصطفى correct? May **马飞** appear on the site? Which photo, if any, should appear? | S03, S09 |
| Q-11 | May the two Mostaql reviews (Mohammed Sharaf Addin, طالب الاشقر) be shown with names and a link to your Mostaql profile? | S10 |
| Q-12 | Is your public contact email `info@abuobaida.sd`? Which social profiles are real (GitHub is; LinkedIn? Mostaql URL?) | S08, S10 |
| Q-13 | Contact-form spam protection: CF7 with Akismet, a honeypot add-on, or Cloudflare Turnstile? | S10 |
| Q-14 | The repository has an orphan `main` branch holding a 2021 zip of this theme (`abuobaida.zip`, same code as `master`). Keep it, or delete it before going public? Old commits also show the author email `abobeada@gmail.com`: fine to stay public, or part of the D-26 fresh-start decision? | S19 |
