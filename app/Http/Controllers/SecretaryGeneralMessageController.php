<?php

namespace App\Http\Controllers;

use App\Models\SecretaryGeneralMessage;

class SecretaryGeneralMessageController extends Controller
{
    public function index()
    {
        $messages = SecretaryGeneralMessage::with('leader')
            ->where('is_published', true)
            ->latest('published_at')
            ->get();

        $featuredMessage = $messages->firstWhere('is_featured', true);

        if (! $featuredMessage) {
            $featuredMessage = $messages->first();
        }

        $selectedMessage = $featuredMessage;

        if (request()->filled('message')) {
            $requestedMessage = $messages->firstWhere(
                'id',
                (int) request('message')
            );

            if ($requestedMessage) {
                $selectedMessage = $requestedMessage;
            }
        }

        $otherMessages = $messages
            ->where('id', '!=', $selectedMessage?->id)
            ->values();

        return view('secretary-general-message', [
            'featuredMessage' => $featuredMessage,
            'selectedMessage' => $selectedMessage,
            'otherMessages' => $otherMessages,
        ]);
    }
}
