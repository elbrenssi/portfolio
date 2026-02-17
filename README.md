# Magical 3D Portfolio (Laravel 12 + Inertia SSR + React Three Fiber)

## Stack
- Laravel 12 + Inertia.js + React
- React Three Fiber / Three.js
- TailwindCSS + Vite
- MySQL
- Filament Admin
- Inertia SSR via Node process

## Delivered architecture
- Single public route: `/` (+ `?project=slug` query overlay).
- SEO metadata generated from DB payload server-side.
- Dynamic `sitemap.xml` and `robots.txt` from DB flags.
- All portfolio content is DB-driven with full migration + seed scaffolding.
- Repository pattern via `PortfolioRepository`.
- SSR entrypoint at `resources/js/ssr.jsx`.

## Local setup
```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate --seed
npm run dev
php artisan inertia:start-ssr
php artisan serve
```

## Production SSR notes
1. Build frontend and SSR bundles: `npm run build && npm run ssr`
2. Keep the Inertia SSR node process alive with PM2/systemd: `php artisan inertia:start-ssr`
3. Run PHP app with nginx + php-fpm.
4. Ensure `INERTIA_SSR_ENABLED=true` and `INERTIA_SSR_URL` points at your SSR daemon.

## Required env vars
- `APP_URL`
- `DB_*`
- `INERTIA_SSR_ENABLED`
- `INERTIA_SSR_URL`

## Constraints in this environment
This coding environment blocks outbound package registries, so dependencies could not be installed here. The repository includes full source scaffolding and configuration to run once dependencies are installed in a network-enabled environment.
