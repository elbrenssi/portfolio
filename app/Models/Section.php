<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['title','subtitle','content_html','seo_title','seo_description'];

    protected $casts = ['is_enabled' => 'boolean'];
}
