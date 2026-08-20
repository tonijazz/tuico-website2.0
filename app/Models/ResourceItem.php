<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ResourceItem extends Model
{
    protected $table = 'resources';

    // this model is for the "resources" table, which is a collection of resources that belong to a category. Each resource has a name, a slug, and category_id. The name is translatable.
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'author', 'file_path', 'access_level', 'is_publication', 'publish_year', 'cover_image', 'downloads_count', 'category_id'];

    protected $casts = [
        'is_publication' => 'boolean',
    ];

    /**
     * The "many" side: "this resource BELONGS TO one category." This is what makes
     * $resource->category->name work later — it follows category_id on this table
     * back to the matching row in resource_categories.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ResourceCategory::class);
    }
}
