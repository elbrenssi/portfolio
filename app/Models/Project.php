<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'short_description', 'long_description_html', 'tech_stack', 'role', 'year', 'client',
        'featured', 'sort_order', 'cover_image_path', 'model_gltf_path', 'model_scale', 'model_position',
        'model_rotation', 'seo_title', 'seo_description', 'seo_image',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'model_position' => 'array',
        'model_rotation' => 'array',
        'featured' => 'boolean',
    ];
}
