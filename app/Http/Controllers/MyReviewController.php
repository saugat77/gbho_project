<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyReviewController extends Controller
{
    public function __invoke()
    {
        $heading = 'My Reviews';

        $reviews = auth()->user()->ratings()->with(['product'])->latest()->get();

        return view('frontend.review.my-reviews', compact(['heading', 'reviews']));
    }
}
