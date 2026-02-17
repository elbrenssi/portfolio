<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SceneSetting extends Model
{
    protected $fillable = [
        'background_mode', 'hero_model_path', 'hero_float_speed', 'hero_rotation_speed', 'bloom_intensity',
        'ambient_light_intensity', 'section_scene_states',
    ];

    protected $casts = [
        'section_scene_states' => 'array',
    ];
}
