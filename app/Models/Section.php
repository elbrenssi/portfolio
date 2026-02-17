<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'tech_stack' => 'array',
            'model_position' => 'array',
            'model_rotation' => 'array',
            'section_scene_states' => 'array',
            'robots_index' => 'boolean',
            'robots_follow' => 'boolean',
            'featured' => 'boolean',
            'is_enabled' => 'boolean',
            'effects_enabled' => 'boolean',
        ];
    }
}
