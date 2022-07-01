<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountCardController extends Controller
{
    public function index()
    {
        return view('frontend.discount-card.index');
    }
}
