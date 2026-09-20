<?php

namespace App\Models;

use App\Enums\OrgUnitType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class OrgUnit extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];
    protected $fillable = ['name', 'description', 'type', 'order'];

    protected $casts = [
        'type' => OrgUnitType::class,
    ];

    public function leader(): HasOne
    {
        return $this->hasOne(Leader::class)->where('role_type', 'unit_head');
    }
}
