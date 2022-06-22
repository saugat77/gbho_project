<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\CategoryMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryMenuController extends Controller
{
    public function index(CategoryMenu $categoryMenu = null)
    {
        $categoryMenus = CategoryMenu::positioned()->get();
        $categories = Category::whereNotIn('id', function ($query) {
            $query->select('category_id')->from('category_menus');
        })->latest()->get();

        if (!$categoryMenu) {
            $categoryMenu = new CategoryMenu();
        }

        return view('category-menu.index', compact([
            'categoryMenus',
            'categories',
            'categoryMenu'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ]);

        $categoryMenu = new CategoryMenu();
        $categoryMenu->category_name = 'catalog_menu';
        $categoryMenu->category_id = $request->category_id;
        $categoryMenu->display_name = $request->display_name ?? Category::find($request->category_id)->name;
        $categoryMenu->position = 100;
        $categoryMenu->save();

        return redirect()->back()->with('success', 'Item added to menu');
    }

    public function sort(Request $request)
    {
        $menuItems = json_decode(json_encode($request->menuItems));

        foreach ($menuItems as $menuItem) {
            CategoryMenu::whereId($menuItem->id)->update(['position' => $menuItem->position]);
        }

        return response()->json(['message' => 'Menu has been sorted'], 200);
    }

    public function removeItem(Request $request)
    {
        CategoryMenu::find($request->id)->delete();

        return response()->json(['message' => 'Item removed'], 200);
    }
}
