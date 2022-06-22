<?php

namespace App\Service;

use App\Product;
use Illuminate\Support\Arr;

class ProductService
{
    protected $imageService;
    protected $productImageService;

    public function __construct(ImageService $imageService, ProductImageService $productImageService)
    {
        $this->imageService = $imageService;
        $this->productImageService = $productImageService;
    }

    public function save($data)
    {
        $product = Product::create(Arr::except($data, ['image']));

        if (array_key_exists('image', $data)) {
            $this->productImageService->create($product, $data['image'], true);
        }

        return $product;
    }

    public function update(Product $product, $data)
    {
        if (array_key_exists('image', $data)) {
            // delete old featuted image
            $this->productImageService->delete($product->featuredImage);

            // store new image
            $this->productImageService->create($product, $data['image'], true);
        }

        return $product->update(Arr::except($data, ['image']));
    }
}
