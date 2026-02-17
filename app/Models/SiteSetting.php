<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'site_name','tagline','hero_headline','hero_subheadline','location','seo_title_default','seo_description_default',
    ];

    protected $casts = [
        'robots_index' => 'boolean',
        'robots_follow' => 'boolean',
        'social_links' => 'array',
        'effects_enabled' => 'boolean',
    ];
}
