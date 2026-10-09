<?php

namespace App\Models\Concerns;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Add `use \App\Models\Concerns\LogsChanges;` to a model and its
 * create / update / delete actions are written to the activity log.
 *
 * By default every changed field is recorded (old and new value).
 * A model can narrow this by declaring:
 *     protected array $activityLogOnly = ['status', 'type'];
 */
trait LogsChanges
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $options = LogOptions::defaults()
            ->useLogName('content')
            ->logOnlyDirty()          // only fields that actually changed
            ->dontSubmitEmptyLogs();  // skip saves that change nothing

        if (property_exists($this, 'activityLogOnly')) {
            return $options->logOnly($this->activityLogOnly);
        }

        return $options
            ->logAll()
            ->logExcept(['created_at', 'updated_at', 'password', 'remember_token']);
    }
}
