<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    public function index()
    {
        return view('product-group.index');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        return $request;
    }
}
