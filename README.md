# Magical Portfolio (Laravel 9 + Inertia SSR + React + Filament)

## Local setup

```bash
php ./composer.phar install
npm install
php artisan migrate --seed
php artisan storage:link
npm run dev
php artisan serve
php artisan inertia:start-ssr
```

Admin default user (seeded): `admin@example.com` / `password`

## What is included
- Single public app route: `GET /` (SPA behavior with `#anchors` and `?project=slug`).
- SSR-ready Inertia + React frontend with SEO meta tags and JSON-LD.
- Filament v2 admin CRUD for projects/sections/skills/experiences and singleton settings pages.
- Translatable JSON fields via Spatie translatable (EN/FR/AR) persisted in MySQL JSON columns.
- Dynamic `sitemap.xml` and `robots.txt`.

## Deployment notes
- Build front-end assets (`npm run build`) and run SSR build (`npm run ssr`) in CI/CD.
- Keep the SSR node process running (for example with systemd/supervisor):
  - `php artisan inertia:start-ssr`
- Ensure `php artisan storage:link` has been executed on the server.
- Never commit `.env` to source control.
