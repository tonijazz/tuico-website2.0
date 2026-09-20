<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::active()->orderBy('order')->get();
        $featuredNews = News::published()->latest('published_at')->take(3)->get();

        return view('home', [
            'slides' => $slides,
            'featuredNews' => $featuredNews,
        ]);
    }
}
