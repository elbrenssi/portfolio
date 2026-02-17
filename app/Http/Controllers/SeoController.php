<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteSetting;
use App\Support\SeoBuilder;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap()
    {
        $settings = SiteSetting::query()->firstOrFail();
        $baseUrl = rtrim($settings->canonical_base_url, '/');
        $sections = SeoBuilder::sectionsForSitemap();
        $projects = Project::query()->get();

        $xml = view('seo.sitemap', [
            'baseUrl' => $baseUrl,
            'sections' => $sections,
            'projects' => $projects,
        ])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function robots()
    {
        $settings = SiteSetting::query()->firstOrFail();
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= 'Sitemap: ' . rtrim($settings->canonical_base_url, '/') . "/sitemap.xml\n";
        if (! $settings->robots_index) {
            $content .= "Disallow: /\n";
        }

        return new Response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
