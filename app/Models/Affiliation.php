<?php

namespace App\Models;

use App\Enums\AffiliationScope;
use App\Enums\AffiliationType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Affiliation extends Model
{
    use HasTranslations;

    public $translatable = ['description'];
    protected $fillable = ['name', 'description', 'type', 'scope', 'website_url', 'logo', 'order'];

        protected $casts = [
        'type' => AffiliationType::class,
        'scope' => AffiliationScope::class,
    ];
}
