<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Support\InquiryNotifier;

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
            'message' => 'required|string|max:5000',
        ]);

        $inquiry = Inquiry::create([
            ...$validated,
            'type' => 'membership',
        ]);

        InquiryNotifier::staff($inquiry);

        return redirect(locale_url('join-us'))->with('success', localized('Thank you for your interest in joining TUICO. A regional office will be in touch with you soon.', 'Asante kwa kuonyesha nia ya kujiunga na TUICO. Ofisi ya mkoa itawasiliana nawe hivi karibuni.'));
    }
}
