<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;

    public $translatable = ['question', 'answer'];

    protected $fillable = ['question', 'answer', 'category_id', 'order'];

    /**
     * The "many" side: "this faq BELONGS TO one category." This is what makes
     * $faq->category->name work later — it follows category_id on this table
     * back to the matching row in faq_categories.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class);
    }
}
