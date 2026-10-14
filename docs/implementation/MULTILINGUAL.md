# Multilingual Strategy: Arabic, English, Chinese

Decisions: D-03 (confirmed), D-08, D-09, D-10, D-12, D-19, D-21.
Verified behaviour comes from the Polylang spike on WordPress 7.1.3 (AUDIT §2.6).

## 1. Languages and URLs

| Language | Locale | Direction | URL | Font |
|---|---|---|---|---|
| English (default, D-12) | `en_US` | LTR | `/` | Chosen family (Latin) |
| Arabic | `ar` | **RTL** | `/ar/` | Chosen family (Arabic) |
| Chinese, Simplified (Q-07) | `zh_CN` | LTR | `/zh/` | System CJK stack |

## 2. Polylang (free) configuration

Recorded so S08 and S18 can reproduce it exactly.

1. Add the languages in the order **en_US, ar, zh_CN**. Polylang sets the Arabic language's RTL flag.
2. URL modifications:
   - "The language is set from the directory name in pretty permalinks".
   - "Hide URL language information for default language".
   - **"The front page URL contains the language code instead of the page name or page id"** (`redirect_lang`). **[M]** Without this, `/ar/` redirects to `/ar/<page-slug>/`.
3. Custom post types and taxonomies:
   - Translate `project` and `project_type`.
   - Do **not** translate `testimonial` (D-09) or `project_stack`.
4. Static front page: set the English front page in Settings → Reading, then create its Arabic and Chinese translations. Each translation gets its own `front_page` fields, contact form and résumé file.
5. Menus: one menu per language, assigned to the same location. Polylang free supports this for classic themes.
6. Language switcher: rendered by the theme (`template-parts/site/language-switcher.php`) from `pll_the_languages( array( 'raw' => 1 ) )` via `inc/i18n.php`. Do not use Polylang's widget.

## 3. Verified behaviour [M]

| Behaviour | Result |
|---|---|
| `<html>` attributes | English: `lang="en-US"`. Arabic: `dir="rtl" lang="ar"`. Chinese: `lang="zh-CN"`. No Arabic core language pack is needed for `dir`. |
| `hreflang` | `<link rel="alternate" hreflang="…">` for en, ar and zh printed on every page that has translations. |
| Translated front pages | Work at `/ar/` and `/zh/` once `redirect_lang` is on. **They render with `front-page.php` only.** Slug templates (`page-home.php`) are not used for translations, which is why the current theme falls back to `index.php`. |
| CPT archive | `/projects/` and `/ar/projects/` resolve, with the correct `dir` and `lang`. |

**Still to verify in S08:**

- whether an `x-default` alternate is printed;
- how the core `wp-sitemap.xml` handles languages;
- how a language switcher link behaves when a page has no translation (it should link to the home page of that language).

## 4. What Polylang free does not do, and how this plan works around it

| Limitation | Workaround |
|---|---|
| No ACF field sync or copy between translations | Each translation fills its own fields. Fields are kept few (ARCHITECTURE §5.2). Testimonials are shared rather than translated (D-09). |
| No translation of Site Editor templates or patterns (documented as Pro) | Classic theme (D-02). Templates contain no hard-coded copy, and every string goes through `__()`. |
| No ACF Options-page translation | No Options pages. Language content lives on each front page (D-19). |
| No XLIFF export or machine-translation integration | Translation workflow in §7. |

## 5. RTL rules

- **CSS uses logical properties only.** This is checked automatically in every UI session with `tools/qa/check-logical-css.sh` (added in S04). The forced-RTL render of today's theme shows the failure mode (`baseline/screens/home-rtl-forced-1280.jpg`).
- **Icons:**
  - directional icons (arrows, "next", chevrons) mirror with `:dir(rtl) .icon--directional { transform: scaleX(-1) }`;
  - non-directional icons (mail, download, menu) never mirror.
- **Mixed direction:**
  - Latin names, emails, URLs and code inside Arabic text are wrapped in `<bdi>` or given `dir="ltr"`;
  - Arabic quotes on English or Chinese pages get `lang="ar" dir="rtl"`;
  - any user-entered field that might contain either direction uses `dir="auto"`.
- **Numbers:** Western digits everywhere (D-21). Dates use `date_i18n()` for month names. Counts use `number_format_i18n()`.
- **Form fields:** CF7 forms per language. In Arabic, labels and placeholders are in Arabic and email inputs are `dir="ltr"`.

## 6. Typography per script

| | Latin | Arabic | Chinese |
|---|---|---|---|
| Family | Chosen family | Chosen family (Arabic glyphs) | `PingFang SC, "Microsoft YaHei", "Noto Sans SC", sans-serif` |
| Body size / line height | 17 px / 1.6 | **18 px / 1.8** | 16 px / 1.75 |
| Headings | Tight tracking allowed | **No letter-spacing.** Line height ≥ 1.2 | Weight 500 or 700. Line height ≥ 1.15 |
| Emphasis | Weight, italic allowed | **Weight only** (no italic, no uppercase) | **Weight only** (no italic) |
| Line length | ≤ 68 ch | ≤ 60 ch | ≤ 40 characters per line on desktop |

These live in `theme.json` and `base.css` using `:lang(ar)` and `:lang(zh)` selectors. The A-System artboard in the design canvas shows all three side by side.

## 7. Content and translation workflow

1. Write the content in **English first**. It is the source for structure, not necessarily the best text.
2. Claude drafts the Arabic and Chinese versions, **clearly marked as drafts**, if the owner opts in (Q-06).
3. The owner, or a reviewer the owner chooses, approves each language **before publishing**.
4. Glossary in `docs/content/GLOSSARY.md` (created in S17): fixed translations for recurring terms (WordPress = ووردبرس / WordPress, Laravel = لارافل, case study = دراسة حالة / 案例研究, …), so the three languages stay consistent.
5. Theme interface strings live in `languages/abuobaida.pot` (generated with `wp i18n make-pot`), then `ar.po` and `zh_CN.po`, compiled to `.mo`. The bar: `msgfmt --statistics` reports 0 untranslated strings before launch.
6. Testimonials are never machine-translated without a label. The original is always shown.
7. A résumé PDF per language if available. Otherwise the English PDF is linked and labelled "(English)".

## 8. SEO and launch notes

- English URLs stay at the root, so existing links to the site keep working. The only existing deep links are `#anchors` and `wp-content/uploads` files, and both survive.
- Polylang adds `hreflang`. Confirm that the SEO plugin, if any (Q-03), doesn't duplicate it.
- Install the core **ar** and **zh_CN language packs** on production (Settings → General; the host can reach wordpress.org) so the admin screens and core strings are translated.
