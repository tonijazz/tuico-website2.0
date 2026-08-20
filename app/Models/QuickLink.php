<?php

namespace App\Models;

use App\Enums\QuickLinkLocation;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class QuickLink extends Model
{
    use HasTranslations;

    public $translatable = ['label'];
    protected $fillable = ['label', 'url', 'location', 'order'];

        protected $casts = [
        'location' => QuickLinkLocation::class,
    ];
}
