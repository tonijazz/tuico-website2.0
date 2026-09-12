<?php

namespace App\Models;

use App\Enums\InquiryStatus;
use App\Enums\InquiryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    //
    protected $fillable = ['name','email','phone','subject','message','type','workplace','region_id','status',
];

    protected $casts = [
        'type' => InquiryType::class,
        'status' => InquiryStatus::class,
    ];

        public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'region_id');
    }

}
