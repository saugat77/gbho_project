<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImageRequest;
use App\Product;
use App\ProductImage;
use App\Service\ImageService;
use App\Service\ProductImageService;

class ProductImageController extends Controller
{
    protected $imageService;
    protected $productImageService;

    public function __construct(ImageService $imageService, ProductImageService $productImageService)
    {
        $this->imageService = $imageService;
        $this->productImageService = $productImageService;
    }

    public function index(Product $product)
    {
        $productImages = $product->productImages;
        $productImages = $productImages->map(function ($productImage) {
            $productImage['url'] = $productImage->getUrl();
            return $productImage;
        });

        return response()->json($productImages);
    }

    public function store(ProductImageRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        $this->productImageService->create($product, $request->file('file'));

        return response()->json([
            'success' => 'Image Saved'
        ]);
    }

    public function destroy(ProductImage $productImage)
    {
        try {
            $this->productImageService->delete($productImage);

            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(null, 500);
        }
    }
}
