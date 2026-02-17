<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ $base }}/</loc>
  </url>
  @foreach($projects as $slug)
  <url>
    <loc>{{ $base }}/?project={{ $slug }}</loc>
  </url>
  @endforeach
</urlset>
