<?php

namespace App\Models;

use App\Enums\LeaderLevel;
use App\Enums\LeaderRoleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Leader extends Model
{
    //
    use HasTranslations;

    public $translatable = ['position', 'bio'];

    protected $fillable = [
        'name', 'position', 'bio', 'photo', 'level', 'role_type', 'zone_id', 'org_unit_id', 'office_id', 'term_start', 'term_end', 'order',
    ];

    protected $casts = [
        'level' => LeaderLevel::class,
        'role_type' => LeaderRoleType::class,
        'term_start' => 'date',
        'term_end' => 'date',
    ];

    public function orgUnit(): BelongsTo
    {
        return $this->belongsTo(OrgUnit::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
}
