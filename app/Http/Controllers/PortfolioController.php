<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use App\Models\SceneSetting;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Support\SeoBuilder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $settings = SiteSetting::query()->firstOrFail();
        $projectSlug = $request->query('project');

        return Inertia::render('Portfolio', [
            'settings' => $settings,
            'sections' => Section::query()->where('is_enabled', true)->orderBy('sort_order')->get(),
            'projects' => Project::query()->orderBy('sort_order')->get(),
            'experiences' => Experience::query()->orderBy('sort_order')->get(),
            'skills' => Skill::query()->orderBy('sort_order')->get(),
            'scene' => SceneSetting::query()->first(),
            'activeProjectSlug' => $projectSlug,
            'seo' => SeoBuilder::build($settings, $projectSlug),
            'robots' => SeoBuilder::robotsDirectives($settings),
        ]);
    }
}
