<?php

namespace App\Support;

use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use App\Models\OrgUnit;
use Illuminate\Support\Facades\Mail;

class InquiryNotifier
{
    /**
     * Email the staff about a saved enquiry. Runs after the visitor's page
     * has been sent, and never throws: the enquiry is already saved.
     */
    public static function staff(Inquiry $inquiry): void
    {
        defer(function () use ($inquiry) {
            try {
                $clean = fn ($list) => collect($list)
                    ->map(fn ($email) => strtolower(trim((string) $email)))
                    ->filter()
                    ->unique()
                    ->values();

                $to = $clean(
                    OrgUnit::where('receives_enquiries', true)->whereNotNull('email')->pluck('email')
                        ->push($inquiry->office?->email)
                );

                $cc = $clean(explode(',', (string) config('mail.enquiry_copy')))->diff($to)->values();

                if ($to->isEmpty()) {
                    $to = $cc;
                    $cc = collect();
                }

                if ($to->isEmpty()) {
                    logger()->warning("Enquiry {$inquiry->id} has no notification recipients.");

                    return;
                }

                $pending = Mail::to($to->all());

                if ($cc->isNotEmpty()) {
                    $pending->cc($cc->all());
                }

                $pending->send(new InquiryReceived($inquiry));
            } catch (\Throwable $e) {
                report($e);
            }
        });
    }
}