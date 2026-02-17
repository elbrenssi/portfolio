<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title inertia>{{ $page['props']['seo']['title'] ?? 'Portfolio' }}</title>
    <meta name="description" content="{{ $page['props']['seo']['description'] ?? '' }}" />
    <link rel="canonical" href="{{ $page['props']['seo']['canonical'] ?? url('/') }}" />
    <meta name="robots" content="{{ $page['props']['robots'] ?? 'index,follow' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $page['props']['seo']['title'] ?? '' }}" />
    <meta property="og:description" content="{{ $page['props']['seo']['description'] ?? '' }}" />
    <meta property="og:url" content="{{ $page['props']['seo']['canonical'] ?? url('/') }}" />
    <meta property="og:image" content="{{ $page['props']['seo']['image'] ?? '' }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $page['props']['seo']['title'] ?? '' }}" />
    <meta name="twitter:description" content="{{ $page['props']['seo']['description'] ?? '' }}" />
    <meta name="twitter:image" content="{{ $page['props']['seo']['image'] ?? '' }}" />
    @foreach(($page['props']['seo']['jsonLd'] ?? []) as $schema)
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endforeach
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
    @inertiaHead
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    @inertia
</body>
</html>
