<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FaqCategory extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'slug'];

    /**
     * The inverse of Faq's belongsTo(FaqCategory) below — "one category HAS MANY
     * faqs." Laravel infers the foreign key (category_id) and the related table
     * (faqs) from the method name and model automatically, same way constrained()
     * did in the migration — you only need to spell it out if your naming doesn't
     * follow the convention.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class, 'category_id')->orderBy('order');
    }
}
