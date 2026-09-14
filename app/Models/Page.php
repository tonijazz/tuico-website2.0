<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'locale', 'slug', 'blocks', 'seo_title', 'seo_description'];

    protected $casts = [
        'blocks' => 'array',
    ];
}
