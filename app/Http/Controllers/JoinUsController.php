<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Office;
use Illuminate\Http\Request;

class JoinUsController extends Controller
{
    public function create()
    {
        $regions = Office::where('type', 'regional')->orderBy('name')->get();

        return view('join-us.create', ['regions' => $regions]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'region_id' => 'nullable|exists:offices,id',
            'message' => 'required|string',
        ]);

        Inquiry::create([
            ...$validated,
            'type' => 'membership',
        ]);

        return redirect()->route('join-us.create')->with('success', 'Thank you for your interest in joining TUICO. A regional office will be in touch with you soon.');
    }
}
