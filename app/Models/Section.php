<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'key', 'title', 'subtitle', 'content_html', 'sort_order', 'is_enabled',
        'seo_title', 'seo_description', 'seo_image',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];
}
