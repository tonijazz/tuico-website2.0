<?php

namespace App\Http\Controllers;

use App\Enums\NewsType;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');

        $articles = News::published()
            ->with('author')
            ->when($type, function ($query, $type) {
                if (in_array($type, array_column(NewsType::cases(), 'value'), true)) {
                    $query->where('type', $type);
                }
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('news.index', [
            'articles' => $articles,
            'selectedType' => $type,
            'newsTypes' => NewsType::cases(),
        ]);
    }

    public function show(string $slug)
    {
        $article = News::published()
            ->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('news.show', ['article' => $article]);
    }
}
