<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Zone extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name', 'slug', 'order'];

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class, 'zone_id')->orderBy('name');
    }
}
