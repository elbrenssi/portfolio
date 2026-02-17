<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Experience extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public $translatable = ['company','role','location','description_html'];

    protected $casts = ['start_date' => 'date','end_date' => 'date'];
}
