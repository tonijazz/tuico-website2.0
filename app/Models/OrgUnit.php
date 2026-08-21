<?php

namespace App\Models;

use App\Enums\OrgUnitType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OrgUnit extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];
    protected $fillable = ['name', 'description', 'type', 'order'];

    protected $casts = [
        'type' => OrgUnitType::class,
    ];
}
