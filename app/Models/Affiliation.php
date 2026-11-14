<?php

namespace App\Models;

use App\Enums\AffiliationScope;
use App\Enums\AffiliationType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Affiliation extends Model
{
    use \App\Models\Concerns\LogsChanges;

    use HasTranslations;

    public $translatable = ['description'];
    protected $fillable = ['name', 'description', 'type', 'scope', 'website_url', 'logo', 'order'];

        protected $casts = [
        'type' => AffiliationType::class,
        'scope' => AffiliationScope::class,
    ];

        public function getUrlAttribute(): ?string
    {
        $url = trim((string) $this->website_url);

        if ($url === '') {
            return null;
        }

        return preg_match('#^https?://#i', $url) ? $url : 'https://' . $url;
    }
}
