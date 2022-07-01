<?php

namespace App\Service;

use App\Product;
use App\ProductImage;

class ProductImageService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function create(Product $product, $image, $isFeatured = false)
    {
        $productImage = new ProductImage([
            'image_path' => $this->imageService->storeImage($image),
            'small_thumbnail_path' => $this->imageService->storeImage($image),
            'medium_thumbnail_path' => $this->imageService->storeImage($image),
            'is_featured' => $isFeatured
        ]);

        $this->imageService->createThumbnail('storage/' . $productImage['small_thumbnail_path'], null, 350);
        $this->imageService->createThumbnail('storage/' . $productImage['medium_thumbnail_path'], null, 600);

        $product->productImages()->save($productImage);

        return $productImage;
    }

    public function delete(ProductImage $productImage)
    {
        // Delete images
        $this->imageService->unlinkImage($productImage->image_path);
        $this->imageService->unlinkImage($productImage->small_thumbnail_path);
        $this->imageService->unlinkImage($productImage->medium_thumbnail_path);

        // Delete record
        $productImage->delete();
    }
}
