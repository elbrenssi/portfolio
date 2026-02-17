<?php

namespace App\Support;

class SeoBuilder
{
    public static function fromPayload(array $payload): array
    {
        $site = $payload['site'];
        $project = $payload['activeProject'];

        $title = $project?->seo_title ?: $site->seo_title_default;
        $description = $project?->seo_description ?: $site->seo_description_default;
        $image = $project?->seo_image ?: $site->seo_image_default;
        $canonical = rtrim($site->canonical_base_url, '/') . ($project ? '/?project=' . $project->slug : '/');

        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'image' => $image,
            'jsonLd' => [
                '@context' => 'https://schema.org',
                '@type' => 'Person',
                'name' => $site->site_name,
                'url' => $site->canonical_base_url,
            ],
        ];
    }
}
