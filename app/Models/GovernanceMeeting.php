<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class GovernanceMeeting extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'frequency'];

    protected $fillable = ['name', 'frequency', 'governance_level_id', 'order'];

    public function governanceLevel(): BelongsTo
    {
        return $this->belongsTo(GovernanceLevel::class, 'governance_level_id');
    }
}
