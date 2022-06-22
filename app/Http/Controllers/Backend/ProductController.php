<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create-edit', [
            'product' => new Product()
        ]);
    }

    public function store(ProductRequest $request)
    {
        // $this->authorizeSeller($request->store_id);
        $product = $this->productService->save($request->validated());

        return redirect()->route('products.edit', $product)->with('success', 'Product added. Also do not forget to update product image gallery if you have any.');
    }

    public function show()
    {
        // Route has been declared
        abort(404);
    }


    public function edit(Product $product)
    {
        // $this->authorizeSeller($product->id);
        return view('product.create-edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        // $this->authorizeSeller($request->store_id);
        $this->productService->update($product, $request->validated());

        return redirect()->route('products.edit', $product)->with('success', 'All done. Product have been updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product has been deleted');
    }

    public function images(Product $product)
    {
        return view('product.images', compact('product'));
    }

    public function seo(Product $product)
    {
        return view('product.seo', compact('product'));
    }

    public function storeSeo(Request $request, Product $product)
    {
        $request->validate([
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'custom_json_ld' => 'nullable'
        ]);

        $product->update([
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'custom_json_ld' => $request->custom_json_ld,
        ]);

        // Alert::success()->message('Changes saved.')->send();

        return back();
    }
}
