// Baseline measurement of the current theme on local WordPress.
// Usage: node measure.js <outdir> <name=url>...
const path = require('path');
const fs = require('fs');
// Playwright: a local install, or the copy preinstalled in Claude's cloud workspace.
const { chromium } = (() => { try { return require('playwright'); } catch (e) { return require('/opt/npm-tools/node_modules/playwright'); } })();

const outDir = process.argv[2];
const targets = process.argv.slice(3).map((a) => { const i = a.indexOf('='); return { name: a.slice(0, i), url: a.slice(i + 1) }; });
// axe-core bundle: set AXE_PATH (npm i axe-core gives node_modules/axe-core/axe.min.js). See README.md.
const AXE = fs.readFileSync(process.env.AXE_PATH || path.join(__dirname, 'axe.min.js'), 'utf8');
const WIDTHS = { home: [375, 768, 1280, 1920] };

(async () => {
  fs.mkdirSync(outDir, { recursive: true });
  const browser = await chromium.launch();
  const report = {};
  for (const t of targets) {
    const widths = WIDTHS[t.name] || [375, 1280];
    const r = { url: t.url, widths: {}, requests: {}, axe: null };
    for (const w of widths) {
      const ctx = await browser.newContext({ viewport: { width: w, height: 900 } });
      const page = await ctx.newPage();
      const reqs = []; const external = []; const failed = []; const consoleErrors = []; const pageErrors = [];
      await page.route('**/*', (route) => {
        const u = new URL(route.request().url());
        if (u.hostname !== 'localhost' && u.hostname !== '127.0.0.1') { external.push(route.request().url()); return route.abort(); }
        return route.continue();
      });
      page.on('requestfinished', async (req) => {
        try { const res = await req.response(); const body = res ? await res.body() : Buffer.alloc(0); reqs.push({ url: req.url(), type: req.resourceType(), status: res ? res.status() : 0, bytes: body.length }); } catch (e) { reqs.push({ url: req.url(), type: req.resourceType(), status: -1, bytes: 0 }); }
      });
      page.on('requestfailed', (req) => { if (!external.includes(req.url())) failed.push(req.url()); });
      page.on('console', (m) => { if (m.type() === 'error') consoleErrors.push(m.text().slice(0, 200)); });
      page.on('pageerror', (e) => pageErrors.push(String(e).slice(0, 200)));
      await page.goto(t.url, { waitUntil: 'load', timeout: 60000 });
      await page.waitForTimeout(1500);
      const metrics = await page.evaluate(() => ({
        scrollWidth: document.documentElement.scrollWidth,
        clientWidth: document.documentElement.clientWidth,
        height: document.documentElement.scrollHeight,
      }));
      await page.screenshot({ path: path.join(outDir, `${t.name}-${w}.png`), fullPage: true });
      const byType = {};
      for (const q of reqs) { byType[q.type] = byType[q.type] || { count: 0, bytes: 0 }; byType[q.type].count++; byType[q.type].bytes += q.bytes; }
      r.widths[w] = { horizontalOverflow: metrics.scrollWidth > metrics.clientWidth, scrollWidth: metrics.scrollWidth, pageHeight: metrics.height, consoleErrors, pageErrors, failedLocal: failed, notFound: reqs.filter((q) => q.status === 404).map((q) => q.url) };
      if (w === 1280) {
        r.requests = { total: reqs.length, external: external.length, externalHosts: [...new Set(external.map((u) => new URL(u).hostname))], byType, totalBytes: reqs.reduce((s, q) => s + q.bytes, 0) };
        await page.addScriptTag({ content: AXE });
        r.axe = await page.evaluate(async () => {
          const res = await window.axe.run(document, { resultTypes: ['violations'] });
          return res.violations.map((v) => ({ id: v.id, impact: v.impact, nodes: v.nodes.length, help: v.help, sample: v.nodes.slice(0, 3).map((n) => n.target.join(' ')) }));
        });
        // Structural facts
        r.structure = await page.evaluate(() => {
          const ids = {}; document.querySelectorAll('[id]').forEach((e) => { ids[e.id] = (ids[e.id] || 0) + 1; });
          return {
            lang: document.documentElement.getAttribute('lang'),
            dir: document.documentElement.getAttribute('dir'),
            h1: [...document.querySelectorAll('h1')].map((h) => h.textContent.trim().slice(0, 60)),
            headings: [...document.querySelectorAll('h1,h2,h3,h4,h5,h6')].map((h) => h.tagName).join(' '),
            imgsNoAlt: [...document.querySelectorAll('img')].filter((i) => !i.getAttribute('alt')).length,
            imgs: document.querySelectorAll('img').length,
            emptyHashLinks: [...document.querySelectorAll('a[href="#"]')].length,
            duplicateIds: Object.entries(ids).filter(([, c]) => c > 1).map(([k, c]) => `${k}×${c}`),
            landmarks: { header: document.querySelectorAll('header').length, nav: document.querySelectorAll('nav').length, main: document.querySelectorAll('main').length, footer: document.querySelectorAll('footer').length },
            stylesheets: [...document.querySelectorAll('link[rel=stylesheet]')].map((l) => l.getAttribute('href').replace(/^https?:\/\/[^/]+/, '').split('?')[0]),
            scripts: [...document.querySelectorAll('script[src]')].map((s) => s.getAttribute('src').replace(/^https?:\/\/[^/]+/, '').split('?')[0]),
          };
        });
      }
      if (w === 375 && t.name === 'home') {
        // Keyboard: can the mobile menu toggle be reached and operated?
        const toggle = await page.$('.mobile-nav-toggle');
        r.mobileToggle = toggle ? await toggle.evaluate((el) => ({ tag: el.tagName, tabIndex: el.tabIndex, role: el.getAttribute('role'), name: el.getAttribute('aria-label') || el.textContent.trim() })) : null;
        const seen = [];
        for (let i = 0; i < 12; i++) { await page.keyboard.press('Tab'); seen.push(await page.evaluate(() => { const a = document.activeElement; return a ? `${a.tagName}${a.className ? '.' + String(a.className).split(' ')[0] : ''}:${(a.getAttribute('aria-label') || a.textContent || '').trim().slice(0, 20)}` : null; })); }
        r.first12TabStops = seen;
      }
      await ctx.close();
    }
    report[t.name] = r;
    console.error('done', t.name);
  }
  // Reduced motion check on home: are AOS elements hidden until animated?
  const ctx = await browser.newContext({ viewport: { width: 1280, height: 900 }, reducedMotion: 'reduce' });
  const page = await ctx.newPage();
  await page.route('**/*', (route) => { const u = new URL(route.request().url()); return (u.hostname !== 'localhost') ? route.abort() : route.continue(); });
  await page.goto(targets[0].url, { waitUntil: 'load' });
  await page.waitForTimeout(1200);
  report.reducedMotion = await page.evaluate(() => ({
    aosElements: document.querySelectorAll('[data-aos]').length,
    typedRunning: !!document.querySelector('.typed-cursor'),
    hiddenBelowFold: [...document.querySelectorAll('[data-aos]')].filter((e) => getComputedStyle(e).opacity === '0').length,
  }));
  await ctx.close();
  await browser.close();
  fs.writeFileSync(path.join(outDir, 'report.json'), JSON.stringify(report, null, 2));
})();
