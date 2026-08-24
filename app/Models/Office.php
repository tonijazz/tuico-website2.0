<?php

namespace App\Models;

use App\Enums\LeaderRoleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Office extends Model
{
    protected $fillable = [
        'type', 'parent_office_id', 'zone_id', 'is_zonal_seat',
        'name', 'slug', 'address', 'phone', 'email', 'lat', 'lng',
    ];

    protected $casts = [
        'is_zonal_seat' => 'boolean',
    ];

    public function parentOffice(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'parent_office_id');
    }

    public function subOffices(): HasMany
    {
        return $this->hasMany(Office::class, 'parent_office_id');
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function secretary(): HasOne
{
    return $this->hasOne(Leader::class)->where('role_type', LeaderRoleType::Secretary);
}
}
