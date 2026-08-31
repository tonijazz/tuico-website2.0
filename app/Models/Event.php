<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title', 'description', 'location', 'starts_at', 'ends_at', 'banner_image', 'governance_meeting_id',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function governanceMeeting(): BelongsTo
    {
        return $this->belongsTo(GovernanceMeeting::class, 'governance_meeting_id');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('starts_at', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('ends_at', '<', now());
    }
}
