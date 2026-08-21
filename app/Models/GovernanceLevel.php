<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class GovernanceLevel extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'order'];

    public function meetings(): HasMany
    {
        return $this->hasMany(GovernanceMeeting::class, 'governance_level_id')->orderBy('order');
    }
}
