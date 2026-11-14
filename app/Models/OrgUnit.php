<?php

namespace App\Models;

use App\Enums\OrgUnitType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class OrgUnit extends Model
{
    use \App\Models\Concerns\LogsChanges;
    use HasTranslations;

    public $translatable = ['name', 'description', 'examples'];
    protected $fillable = ['name', 'description', 'examples', 'type', 'order', 'icon'];

    protected $casts = [
        'type' => OrgUnitType::class,
        'icon' => 'string',
    ];

    public function leader(): HasOne
    {
        return $this->hasOne(Leader::class)->where('role_type', 'unit_head');
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->getTranslation('name', 'en'));
    }

    public function siblings()
    {
        return static::where('type', $this->type)
            ->where('id', '!=', $this->id)
            ->orderBy('order');
    }
}
