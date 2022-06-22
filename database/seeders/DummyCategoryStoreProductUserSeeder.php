<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DummyCategoryStoreProductUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Category::class, 1)->create()->each(function ($category) {
            $store = factory(\App\Store::class)->create();
            factory(\App\Product::class, 1)->create([
                'category_id' => $category->id,
                'store_id' => $store->id
            ]);
        });
    }
}
