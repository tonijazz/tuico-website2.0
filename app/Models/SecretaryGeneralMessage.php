<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class SecretaryGeneralMessage extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'content',
    ];

    protected $fillable = [
        'title',
        'content',
        'leader_id',
        'is_published',
        'is_featured',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Leader::class);
    }
}
