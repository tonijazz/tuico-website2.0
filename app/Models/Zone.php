<?php

namespace App\Models;

use App\Models\Leader;
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
    public function zonalSecretary(): ?Leader
{
    $seat = $this->offices()->where('is_zonal_seat', true)->first();

    return $seat?->secretary;
}
}
