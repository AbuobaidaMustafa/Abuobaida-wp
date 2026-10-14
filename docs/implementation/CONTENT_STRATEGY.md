# Content Strategy and Information Architecture

**Rule zero:** no invented clients, metrics, testimonials, certifications or achievements. Anything missing stays a visible `[placeholder]` until the owner supplies it.

## 1. Positioning (owner's own words)

> A web developer with practical PHP, WordPress, Laravel and full-stack development experience, while also developing expertise in AI and machine learning.

The homepage line drafted from this, in the design canvas:

> "I build websites and web applications with PHP, WordPress and Laravel, and I'm growing into AI and machine-learning engineering."

## 2. Audiences and the questions they arrive with

| Audience | Likely language | Their question | What answers it |
|---|---|---|---|
| Clients hiring for WordPress or web work (for example via Mostaql) | Arabic, English | "Can he do my job well and reliably?" | Real client projects, Mostaql reviews, a clear contact route |
| Employers and recruiters | English | "What has he built, with what, at what level?" | Case studies with role, stack and outcome; résumé PDF; GitHub |
| Academic and AI collaborators | English, Chinese | "What's his research and ML experience?" | Research project(s), AI/ML projects, education details [owner to confirm] |

## 3. Site map

```
/                     Home (each language)
/projects/            All projects (filter by type)
/projects/<slug>/     Case study
/about/               About: story, experience, education and research (block content)
/#contact             Contact (homepage section; no separate page unless wanted)
/blog/ …              Only if the owner publishes posts (Q-05)
résumé PDF            Linked from the navigation, one per language if available
404                   Terminal-style "not found", with search and a home link
```

The navigation is the same in every language: **Work · About · Contact · Résumé (PDF) · language switcher**.

## 4. Homepage sections

| # | Section | Job | Source | Status |
|---|---|---|---|---|
| 1 | Hero: name in three scripts, one-line statement, availability, two CTAs ("See selected work", "Email me") | Who you are and what you do, in five seconds | `front_page.hero_statement`, `availability` | Text drafted; availability [confirm] |
| 2 | Selected work: 3–5 featured projects, the first one large | Show the evidence first | `project` with `featured = true` | **Blocked on Q-02.** Two Mostaql projects and this theme are real candidates |
| 3 | What I work with: capabilities, each linking to its projects | Skills tied to proof (D-24) | `project_type` terms | Draft list from the current skills |
| 4 | What clients said: original quote plus translation, client, project, platform link | Trust | `testimonial` | Two real reviews (permission Q-11) |
| 5 | Contact: email, form, résumé, profiles | Conversion | `front_page.contact_*` and the Customizer | Email `info@abuobaida.sd` [confirm Q-12] |

The About section on today's homepage moves to the `/about/` page. The homepage keeps only the one-line statement.

## 5. Case study structure (`project` fields)

The standard order: summary → facts (role, year, status, built with, links) → hero image → **the starting point** (problem) → **decisions** (approach) → **results** (outcome; real numbers only) → gallery → next project.

Every section is optional, and an empty section renders nothing. A project with only a summary and links is still valid, as a "lite" card.

The first case study is **this theme's rebuild**. Its "before" numbers are already measured (AUDIT §2), so it is honest from day one.

## 6. About page outline (block content)

1. Short story: 2–3 paragraphs, in the owner's voice. Today's playful 马飞 line can stay if the owner wishes (Q-10).
2. Experience timeline: role, organisation, dates [owner].
3. Education and research: Lanzhou University, Master's, GIS and snow remote sensing [confirm status and dates].
4. Tools: brief, and linked to the project types.
5. Photo: optional [Q-10].

## 7. Content inventory

| Item | Today | Action |
|---|---|---|
| Name | "Abuobaida Mustafa" | Keep. Add Arabic and Chinese forms [Q-10] |
| Roles (typed animation) | PHP / WordPress / Laravel Developer, Freelancer | Merge into the one-line statement. Drop the animation (D-15) |
| About intro (马飞 joke) | ACF `about.whoami` | Move to the About page if kept |
| About details ("1+ years", Master's student) | ACF `about.details` | **Rewrite** (Q-09) |
| Info list (nationality, age, phone, city, email, freelance) | ACF `about.info` | **Remove** age, nationality and phone (D-06). City is optional. Email and availability stay |
| Skills % bars | Hard-coded | Replace with capabilities (D-24) |
| Portfolio (9 placeholders, App/Card/Web filters) | Hard-coded | Replace with real projects (Q-02) |
| Testimonials (Mostaql) | `cb/carousel` in page content | Migrate to `testimonial` (D-09); ask permission (Q-11) |
| Contact info, map, form | ACF `contact_us` and CF7 #138 | Keep the email and form. Map: click-to-load or a link (D-20). One form per language |
| Social links | Five dead `#` links | Only real profiles (Q-12) |
| Résumé PDF | `uploads/2021/07/Abuobaida-Mustafa.pdf` | Owner to update it; one per language if possible |
| Photos (profile, about, hero) | 2021 uploads | Owner chooses (Q-10). The new designs don't require a hero photo |
| 404 copy | English only, hard-coded | Translatable strings |

## 8. Owner questionnaire (copy, fill in, send back)

```
1. Projects (4–8). For each:
   - Title:
   - One-sentence summary:
   - Your role:
   - Year(s):
   - Client type (personal / client / research / open source):
   - Built with:
   - Live URL / repo URL / platform URL:
   - The problem:
   - What you did:
   - Outcome (only real facts or numbers):
   - Screenshots (attach), may be shown publicly? (yes/no)
   - May the client be named? (yes/no)
2. Experience timeline: role, organisation, from–to, one line each.
3. Education and research: degree, university, status, topic, dates, publications (if any).
4. AI/ML: what you've built or studied (courses, tools, projects).
5. Updated one-paragraph bio (English is fine; Arabic or Chinese welcome).
6. Arabic spelling of your name; OK to show 马飞? Photo to use (or none)?
7. Public email; real profile URLs (GitHub, LinkedIn, Mostaql, others).
8. Permission to show the Mostaql reviews with client names? Mostaql profile URL.
9. Default site language; Simplified or Traditional Chinese; who reviews translations.
10. Availability line ("Open to freelance projects": still true?).
```
