<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Support\InquiryNotifier;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',

        ]);



        $inquiry = Inquiry::create([
            ...$validated,
            'type' => 'general',
        ]);

        InquiryNotifier::staff($inquiry);

        return redirect(locale_url('contact'))->with('success', localized('Your message has been sent. We will get back to you soon.', 'Ujumbe wako umetumwa. Tutawasiliana nawe hivi karibuni.'));
    }
}
