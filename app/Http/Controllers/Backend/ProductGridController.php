<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductGridController extends Controller
{
    public function index(ProductGrid $productGrid = null)
    {
        if (!$productGrid) {
            $productGrid = new ProductGrid();
        }

        $productGrids = ProductGrid::with('category')->positioned()->get();
        $categories = Category::latest()->get();

        return view('product-grid.index', compact([
            'productGrid',
            'productGrids',
            'categories',
        ]));
    }

    public function store(Request $request)
    {
        ProductGrid::create($this->validator($request->all())->validate());

        return redirect()->back()->with('success', 'Product grid has been added');
    }

    public function edit(Request $request, ProductGrid $productGrid)
    {
        return $this->index($productGrid);
    }

    public function update(Request $request, ProductGrid $productGrid)
    {
        $productGrid->update($this->validator($request->all())->validate());

        return redirect()->route('product-grids.index')->with('success', 'Product grid has been updated');
    }

    public function destroy(ProductGrid $productGrid)
    {
        $productGrid->delete();

        return redirect()->route('product-grids.index')->with('success', 'Product grid has been deleted');
    }

    public function sort(Request $request)
    {
        $productGridItems = json_decode(json_encode($request->productGridItems));

        foreach ($productGridItems as $productGridItem) {
            ProductGrid::whereId($productGridItem->id)->update(['position' => $productGridItem->position]);
        }

        return response()->json(['message' => 'Product grid has been sorted'], 200);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'number_of_products' => 'required|integer',
            'active' => 'nullable|boolean'
        ]);
    }
}
