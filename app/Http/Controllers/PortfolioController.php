<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use App\Models\SceneSetting;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function __invoke(Request $request)
    {
        $project = Project::where('slug', $request->query('project'))->first();
        $site = SiteSetting::first();

        return Inertia::render('Portfolio', [
            'site_settings' => $site,
            'sections' => Section::where('is_enabled', true)->orderBy('sort_order')->get(),
            'projects' => Project::orderByDesc('featured')->orderBy('sort_order')->get(),
            'skills' => Skill::orderBy('sort_order')->get(),
            'experiences' => Experience::orderBy('sort_order')->get(),
            'scene_settings' => SceneSetting::first(),
            'currentLocale' => app()->getLocale(),
            'activeProject' => $project,
            'seo' => [
                'title' => $project?->getTranslation('seo_title', app()->getLocale()) ?: $site?->getTranslation('seo_title_default', app()->getLocale()),
                'description' => $project?->getTranslation('seo_description', app()->getLocale()) ?: $site?->getTranslation('seo_description_default', app()->getLocale()),
                'canonical' => rtrim($site?->canonical_base_url ?: config('app.url'), '/') . '/',
            ],
        ]);
    }

    public function sitemap()
    {
        $base = rtrim(optional(SiteSetting::first())->canonical_base_url ?: config('app.url'), '/');
        $projects = Project::pluck('slug');

        return response()->view('sitemap', compact('projects', 'base'))->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $site = SiteSetting::first();
        $disallow = ($site && $site->robots_index) ? '' : "Disallow: /\n";
        $content = "User-agent: *\n".$disallow."Sitemap: ".url('/sitemap.xml')."\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
