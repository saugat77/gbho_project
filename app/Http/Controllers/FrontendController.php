<?php

namespace App\Http\Controllers;

use App\CategoryMenu;
use App\Post;
use App\Product;
use App\ProductGrid;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Catalog Menu
        // $categoryMenus = CategoryMenu::whereHas('category')->with(['category' => function ($query) {
        //     $query->active();
        // }])->positioned()->get();

        $productGrids = ProductGrid::with(['category'])->positioned()->get();

        $productGrids->each(function ($productGrid) {
            if ($productGrid->category) {
                $productGrid->category->load(['products' => function ($query) use ($productGrid) {
                    $query->active()->limit($productGrid->number_of_products);
                }]);
            }
        });

        $topProducts = Product::where('is_top', true)->limit(6)->get()->shuffle();
        $latestProducts = Product::latest()->limit(18)->get()->shuffle();
        $posts = Post::published()->latest()->limit(3)->get();

        return view('frontend.index', compact([
            // 'categoryMenus',
            'topProducts',
            'latestProducts',
            'posts'
        ]));
    }
}
