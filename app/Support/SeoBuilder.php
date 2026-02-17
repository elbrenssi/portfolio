<?php

namespace App\Support;

use App\Models\Project;
use App\Models\Section;
use App\Models\SiteSetting;

class SeoBuilder
{
    public static function build(SiteSetting $settings, $projectSlug = null)
    {
        $project = null;
        if ($projectSlug) {
            $project = Project::query()->where('slug', $projectSlug)->first();
        }

        $title = $project && $project->seo_title ? $project->seo_title : $settings->seo_title_default;
        $description = $project && $project->seo_description ? $project->seo_description : $settings->seo_description_default;
        $image = $project && $project->seo_image ? $project->seo_image : $settings->seo_image_default;
        $canonical = rtrim($settings->canonical_base_url, '/') . '/';
        if ($project) {
            $canonical .= '?project=' . $project->slug;
        }

        return [
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'canonical' => $canonical,
            'jsonLd' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'Person',
                    'name' => $settings->site_name,
                    'jobTitle' => $settings->tagline,
                    'email' => $settings->primary_email,
                    'address' => $settings->location,
                ],
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => $settings->site_name,
                    'url' => rtrim($settings->canonical_base_url, '/') . '/',
                ],
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'ItemList',
                    'name' => 'Featured Projects',
                    'itemListElement' => Project::query()->where('featured', true)->orderBy('sort_order')->get()->values()->map(function (Project $item, $index) {
                        return [
                            '@type' => 'ListItem',
                            'position' => $index + 1,
                            'name' => $item->title,
                            'url' => '/?project=' . $item->slug,
                        ];
                    })->toArray(),
                ],
            ],
        ];
    }

    public static function robotsDirectives(SiteSetting $settings)
    {
        return ($settings->robots_index ? 'index' : 'noindex') . ',' . ($settings->robots_follow ? 'follow' : 'nofollow');
    }

    public static function sectionsForSitemap()
    {
        return Section::query()->where('is_enabled', true)->orderBy('sort_order')->pluck('key')->toArray();
    }
}
