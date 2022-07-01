<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true) ,
        // 'slug' => $faker-> ,
        'store_id' => factory(\App\Store::class)->create()->id,
        'category_id' => factory(\App\Category::class)->create()->id ,
        'is_active' => $faker->boolean($chanceOfGettingTrue = 80) ,
        'regular_price' => $faker->numberBetween($min = 500, $max = 10000) ,
        // 'sale_price' => ,
        // 'sale_price_from' => $faker-> ,
        // 'sale_price_to' => $faker-> ,
        // 'product_highlights' => $faker-> ,
        'description' => $faker->text() ,
        'purchase_note' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true) ,
        // 'image' => 'uploads/'. $faker->image('public/storage/uploads',640,480, null, false) ,
        // 'sku' => $faker-> ,
        // 'manage_stock' => $faker-> ,
        // 'stock_quantity' => $faker-> ,
        // 'product_weight' => $faker-> ,
        // 'product_length' => $faker-> ,
        // 'product_width' => $faker-> ,
        // 'product_height' => $faker-> ,
    ];
});
