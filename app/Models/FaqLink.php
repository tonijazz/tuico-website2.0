<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Route;

class FaqLink extends Model
{
    use HasTranslations;

    public $translatable = ['label'];
    protected $appends = ['label_en', 'label_sw'];

    protected $fillable = [
        'faq_id',
        'label',
        'label_en',
        'label_sw',
        'route_name',
        'order',
    ];

    /**
     * Get the English label for Filament forms.
     */
    public function getLabelEnAttribute(): ?string
    {
        return $this->getTranslation('label', 'en', false);
    }

    /**
     * Set the English label as a translation.
     */
    public function setLabelEnAttribute(?string $value): void
    {
        $this->setTranslation('label', 'en', $value ?? '');
    }

    /**
     * Get the Kiswahili label for Filament forms.
     */
    public function getLabelSwAttribute(): ?string
    {
        return $this->getTranslation('label', 'sw', false);
    }

    /**
     * Set the Kiswahili label as a translation.
     */
    public function setLabelSwAttribute(?string $value): void
    {
        $this->setTranslation('label', 'sw', $value ?? '');
    }

    /**
     * Each link belongs to one FAQ.
     */
    public function faq(): BelongsTo
    {
        return $this->belongsTo(Faq::class);
    }
    /**
     * Get the localized URL for this related link.
     */
    public function getUrlAttribute(): ?string
    {
        if (! Route::has($this->route_name)) {
            return null;
        }

        $path = route($this->route_name, [], false);

        return app()->getLocale() === 'sw'
            ? '/sw' . $path
            : $path;
    }
}
