<?php

namespace App\Http\Controllers;

use App\Models\ResourceCategory;
use App\Models\ResourceItem;
use Illuminate\Http\Request;

class ResourceItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ResourceItem::with('category');

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title->en', 'like', "%{$search}%")
                    ->orWhere('title->sw', 'like', "%{$search}%")
                    ->orWhere('description->en', 'like', "%{$search}%")
                    ->orWhere('description->sw', 'like', "%{$search}%");
            });
        }

        // CATEGORY FILTER
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // YEAR FILTER
        if ($request->filled('year')) {
            $query->where('publish_year', $request->input('year'));
        }

        $resources = $query
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $categories = ResourceCategory::orderBy('name')->get();

        $years = ResourceItem::whereNotNull('publish_year')
            ->where('publish_year', '>', 0)
            ->distinct()
            ->orderByDesc('publish_year')
            ->pluck('publish_year');

        return view('resources.index', [
            'resources' => $resources,
            'categories' => $categories,
            'years' => $years,
        ]);
    }

    public function show(ResourceItem $resource)
    {
        $resource->load('category');

        return view('resources.show', [
            'resource' => $resource,
        ]);
    }
}
