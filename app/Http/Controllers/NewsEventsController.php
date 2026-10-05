<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;

class NewsEventsController extends Controller
{
    public function index()
    {
        $latestNews = News::published()
            ->with('author')
            ->latest('published_at')
            ->take(3)
            ->get();

        $upcomingEvents = Event::upcoming()
            ->orderBy('starts_at')
            ->take(3)
            ->get();

        return view('news-events.index', [
            'latestNews' => $latestNews,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}
