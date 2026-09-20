<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcoming = Event::upcoming()->orderBy('starts_at')->get();
        $past = Event::past()->orderBy('starts_at', 'desc')->get();

        return view('events.index', [
            'upcoming' => $upcoming,
            'past' => $past,
        ]);
    }
}
