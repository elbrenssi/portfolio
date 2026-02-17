<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title','short_description','long_description_html','seo_title','seo_description'];

    protected $casts = [
        'tech_stack' => 'array',
        'featured' => 'boolean',
        'model_position' => 'array',
        'model_rotation' => 'array',
        'model_scale' => 'float',
    ];
}
