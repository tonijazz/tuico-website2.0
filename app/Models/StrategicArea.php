<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class StrategicArea extends Model
{
     use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'icon', 'order'];
}
