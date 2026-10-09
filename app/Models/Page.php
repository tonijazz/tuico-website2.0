<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use \App\Models\Concerns\LogsChanges;

    protected $fillable = ['title', 'locale', 'slug', 'blocks', 'seo_title', 'seo_description'];

    protected $casts = [
        'blocks' => 'array',
    ];
}
