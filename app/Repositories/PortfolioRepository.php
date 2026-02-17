<?php

namespace App\Repositories;

use App\Models\Experience;
use App\Models\Project;
use App\Models\SceneSetting;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;

class PortfolioRepository
{
    public function payload(?string $projectSlug): array
    {
        $site = SiteSetting::query()->firstOrFail();
        $sections = Section::query()->where('is_enabled', true)->orderBy('sort_order')->get();
        $projects = Project::query()->orderBy('sort_order')->get();
        $experiences = Experience::query()->orderBy('sort_order')->get();
        $skills = Skill::query()->orderBy('sort_order')->get();
        $scene = SceneSetting::query()->first();
        $activeProject = $projectSlug ? $projects->firstWhere('slug', $projectSlug) : null;

        return compact('site', 'sections', 'projects', 'experiences', 'skills', 'scene', 'activeProject');
    }

    public function sitemapXml(): string
    {
        $base = SiteSetting::query()->value('canonical_base_url') ?? config('app.url');
        $projects = Project::query()->pluck('slug');
        $entries = collect([$base])->merge($projects->map(fn ($slug) => $base . '/?project=' . $slug));

        $urls = $entries->map(fn ($url) => "<url><loc>{$url}</loc></url>")->implode('');
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">{$urls}</urlset>";
    }

    public function robotsTxt(): string
    {
        $site = SiteSetting::query()->first();
        $index = $site?->robots_index ? 'index' : 'noindex';
        $follow = $site?->robots_follow ? 'follow' : 'nofollow';

        return "User-agent: *\nAllow: /\nX-Robots-Tag: {$index},{$follow}\nSitemap: " . route('sitemap');
    }
}
