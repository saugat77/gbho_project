<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ProductController extends Controller
{
    use SEOToolsTrait;

    public function index()
    {
        $filter = [];
        $products = Product::latest();

        if (request()->has('category')) {
            $category = Category::whereSlug(request('category'))->first();
            if ($category) {
                $filter['category'] = $category;
                $products = $products->where('category_id', $category->id);
                // Here we get some related categories
                $relatedCategories = Category::Where('parent_id', $category->parent_id)->limit(7)->get();
            }
        }

        if (request()->has('pname')) {
            $filter['pname'] = request()->get('pname');
            $products = $products->orWhere('name', 'like', '%' . request()->input('pname') . '%');
        }

        // filter for minimun price
        if (request()->has('min_price') && !is_null(request()->get('min_price'))) {
            $filter['min_price'] = request()->get('min_price');
            $product = $products->where(function ($query) {
                return $query->addSelect(\DB::raw('COALESCE(`sale_price`, `regular_price`)'));
            }, '>=', request()->get('min_price'));
        }

        // filter for maximun price
        if (request()->has('max_price') && !is_null(request()->get('max_price'))) {
            $filter['max_price'] = request()->get('max_price');
            $product = $products->where(function ($query) {
                return $query->addSelect(\DB::raw('COALESCE(`sale_price`, `regular_price`)'));
            }, '<=', request()->get('max_price'));
        }

        // filter by rating
        if (request()->has('min_rating') && !is_null(request()->get('min_rating'))) {
            $products = $products->whereHas('ratings', function ($query) {
                return $query->havingRaw('AVG(rating) >= ?', [request()->min_rating]);
            });
        }

        $products = $products->paginate(20);

        // declare empty relatedCategories if category was not searched for
        if (!isset($relatedCategories)) {
            $relatedCategories = [];
        }

        $filter = collect($filter);

        return view('frontend.product.index', compact([
            'products',
            'relatedCategories',
            'filter'
        ]));
    }

    public function show(Product $product)
    {
        $product->load('productImages');

        $this->seo()->setTitle($product->seoTitle());
        $this->seo()->setDescription($product->seoDescription());
        $this->seo()->metatags()->addKeyword([$product->name]);
        $this->seo()->opengraph()->addImage($product->seoImage());
        $this->seo()->opengraph()->setType('product');
        $this->seo()->opengraph()->setProduct([
            'original_price:amount' => $product->regular_price,
            'original_price:currency' => priceUnit(),
            'pretax_price:amount' => $product->current_price,
            'pretax_price:currency' => priceUnit(),
            'price:amount' => $product->current_price,
            'price:currency' => priceUnit(),
            'shipping_cost:amount' => shippingCharge(),
            'shipping_cost:currency' => priceUnit(),
            'weight:value' => $product->product_weight,
            'weight:units' => null,
            'shipping_weight:value' => null,
            'shipping_weight:units' => null,
            'sale_price:amount' => $product->sale_price,
            'sale_price:currency' => priceUnit(),
            'sale_price_dates:start' => $product->sale_price_from,
            'sale_price_dates:end' => $product->sale_price_to
        ]);

        $relatedProducts = Product::active()->where('category_id', $product->category->id)->limit(5)->get();

        return view('frontend.product.show', compact('product', 'relatedProducts'));
    }

    public function byGroup($tag)
    {
        $title = 'Top Products';
        $products = Product::latest()->limit(6)->paginate(30);

        return view('frontend.product.by-group', compact('products', 'title'));
    }
}
