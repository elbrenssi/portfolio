<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SceneSetting extends Model
{
    protected $guarded = [];

    protected $casts = ['section_scene_states' => 'array'];
}
