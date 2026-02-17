# Magical 3D Portfolio (Laravel + Inertia + React + R3F)

Production-oriented single-route portfolio scaffold with SSR SEO, DB-driven content, and Filament admin.

## Stack
- Laravel 9 (PHP `^8.0` compatible)
- Inertia.js (Laravel + React)
- Vite
- TailwindCSS
- React Three Fiber / Three.js
- Filament Admin
- MySQL

## Public Routing Contract
- Public route: `/`
- Anchor navigation: `/#about`, `/#projects`, etc.
- Project overlays: `/?project=slug` (still `/` route)
- SEO endpoints: `/sitemap.xml`, `/robots.txt`

## Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate --seed
```

## Development
```bash
npm run dev
php artisan serve
php artisan inertia:start-ssr
```

## SSR Notes
- Inertia SSR is configured with a dedicated Node process.
- SSR ensures crawlers receive fully rendered content and server-generated metadata.
- Metadata is built from database content (`SiteSetting`, `Project`) and injected in `resources/views/app.blade.php`.

## Production Deployment Guide
1. Provision PHP 8.0+ runtime, Node.js, MySQL, queue worker, and process manager.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Run `npm ci && npm run build && npm run ssr`.
4. Run database migrations and seed baseline content.
5. Run Laravel web process + queue worker + Inertia SSR process (`php artisan inertia:start-ssr`).
6. Ensure `APP_URL` and canonical URL in `site_settings` are correct.

## Admin
- URL: `/admin`
- Auth-protected Filament panel.
- Resources scaffolded for all content tables.

## Performance Considerations Included
- `prefers-reduced-motion` fallback for heavy 3D.
- Lazy-loaded 3D scene component.
- Clamped device pixel ratio for Canvas.
- SSR text content always available before 3D hydration.
