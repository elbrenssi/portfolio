<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ $baseUrl }}/</loc>
    </url>
    @foreach($sections as $key)
    <url>
        <loc>{{ $baseUrl }}/#{{ $key }}</loc>
    </url>
    @endforeach
    @foreach($projects as $project)
    <url>
        <loc>{{ $baseUrl }}/?project={{ $project->slug }}</loc>
    </url>
    @endforeach
</urlset>
