<?php

namespace App\Http\Controllers\Backend;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactFormSubmissionController extends Controller
{
    public function index()
    {
        $data = ContactUs::latest()->paginate(30);

        return view('contact-us.index', compact('data'));
    }

    public function show(ContactUs $contactUs)
    {
        $contactUs->update(['read_at' => now()]);
        return view('contact-us.show', compact('contactUs'));
    }
}
