<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Store;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $customersCount = User::count();
        $ordersCount = Order::count();

        return view('dashboard.index', compact([
            'productsCount',
            'categoriesCount',
            'customersCount',
            'ordersCount',
        ]));
    }
}
