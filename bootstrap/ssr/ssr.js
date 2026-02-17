import { createServer } from 'http';
import { readFileSync } from 'fs';
import { fileURLToPath } from 'url';
import { dirname, resolve } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const bundle = resolve(__dirname, '../../bootstrap/ssr/ssr.mjs');

(async () => {
  const mod = await import(bundle + '?t=' + Date.now());
  createServer(mod.default).listen(13714);
})();
