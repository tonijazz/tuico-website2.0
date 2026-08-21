<?php

namespace App\Models;

use App\Enums\ProgrammeStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Programme extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'outcomes'];

    protected $fillable = [
        'title', 'description', 'status', 'affiliation_id', 'outcomes', 'starts_at', 'ends_at',
    ];

    protected $casts = [
        'status' => ProgrammeStatus::class,
        'starts_at' => 'date',
        'ends_at' => 'date',
    ];

    public function affiliation(): BelongsTo
    {
        return $this->belongsTo(Affiliation::class, 'affiliation_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', ProgrammeStatus::Active);
    }

    public function scopePast($query)
    {
        return $query->where('status', ProgrammeStatus::Past);
    }
}
