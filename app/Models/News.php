<?php

namespace App\Models;

use App\Enums\NewsStatus;
use App\Enums\NewsType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    protected $table = 'news_posts';

    public $translatable = ['title', 'excerpt', 'body'];

    protected $fillable = [
        'title', 'excerpt', 'body', 'slug', 'type', 'status',
        'featured_image', 'published_at', 'author_id',
    ];

    protected $casts = [
        'type' => NewsType::class,
        'status' => NewsStatus::class,
        'published_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', NewsStatus::Published)
            ->where(function ($q) {
                $q->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }
}
