<?php

namespace App\Http\Controllers;


use App\Models\News;


class NewsController extends Controller
{
    public function index()
    {
        $articles = News::published()
            ->latest('published_at')
            ->paginate(9);

        return view('news.index', ['articles' => $articles]);
    }

    public function show(string $slug)
    {
        $article = News::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('news.show', ['article' => $article]);
    }
}
