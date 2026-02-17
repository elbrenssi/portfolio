<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name', 'tagline', 'hero_headline', 'hero_subheadline', 'primary_email', 'location',
        'seo_title_default', 'seo_description_default', 'seo_image_default', 'canonical_base_url',
        'robots_index', 'robots_follow', 'social_links', 'effects_enabled', 'effects_intensity',
    ];

    protected $casts = [
        'social_links' => 'array',
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
        'effects_enabled' => 'boolean',
    ];
}
