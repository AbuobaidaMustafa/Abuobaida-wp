// Playwright: a local install, or the copy preinstalled in Claude's cloud workspace.
const { chromium } = (() => { try { return require('playwright'); } catch (e) { return require('/opt/npm-tools/node_modules/playwright'); } })();
(async () => {
  const b = await chromium.launch();
  const ctx = await b.newContext({ javaScriptEnabled: false, viewport: { width: 1280, height: 900 } });
  const p = await ctx.newPage();
  await p.route('**/*', (r) => new URL(r.request().url()).hostname !== 'localhost' ? r.abort() : r.continue());
  await p.goto(process.argv[2], { waitUntil: 'load' });
  const res = await p.evaluate(() => [...document.querySelectorAll('[data-aos]')].map((e) => (e.closest('section') || {}).id + ':' + getComputedStyle(e).opacity));
  console.log(JSON.stringify(res));
  await p.screenshot({ path: process.argv[3], fullPage: true });
  await b.close();
})();
