<?php

namespace App\Http\Controllers;

use App\Models\ResourceCategory;

class ResourceItemController extends Controller
{
    public function index()
    {
        $categories = ResourceCategory::with('resources')->get();

        return view('resources.index', ['categories' => $categories]);
    }
}
