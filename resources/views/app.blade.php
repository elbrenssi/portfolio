<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? '' }}" />
    <link rel="canonical" href="{{ $seo['canonical'] ?? config('app.url') }}" />
    <meta property="og:title" content="{{ $seo['title'] ?? '' }}" />
    <meta property="og:description" content="{{ $seo['description'] ?? '' }}" />
    <meta property="og:image" content="{{ $seo['image'] ?? '' }}" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $seo['title'] ?? '' }}" />
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}" />
    <meta name="twitter:image" content="{{ $seo['image'] ?? '' }}" />
    <script type="application/ld+json">@json($seo['jsonLd'] ?? [])</script>
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
