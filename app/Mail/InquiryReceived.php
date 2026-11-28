<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Str;

class InquiryReceived extends Mailable
{
    public function __construct(public Inquiry $inquiry)
    {
    }

    public function envelope(): Envelope
    {
        $label = $this->inquiry->type?->getLabel() ?? 'General';
        $name = Str::limit(trim(preg_replace('/\s+/', ' ', $this->inquiry->name)), 60, '');

        return new Envelope(
            replyTo: [new Address($this->inquiry->email, $name)],
            subject: "New website enquiry ({$label}): {$name}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.inquiry-received');
    }
}