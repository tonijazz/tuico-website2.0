<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;


class ResourceCategory extends Model
{
    //this model is for the "resource_categories" table, which is a collection of categories that resources belong to. Each category has a name and a slug. The name is translatable.
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'slug'];

    /**
     * The inverse of Resource's belongsTo(ResourceCategory) below — "one category HAS MANY
     * resources." Laravel infers the foreign key (category_id) and the related table
     * (resources) from the method name and model automatically, same way constrained()
     * did in the migration — you only need to spell it out if your naming doesn't
     * follow the convention.
     */
    public function resources(): HasMany
    {
        return $this->hasMany(ResourceItem::class, 'category_id')->orderBy('order');
    }

}
