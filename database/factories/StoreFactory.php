<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        // 'slug' => $faker,
        'user_id' => factory(\App\User::class)->create()->id,
        'contact' => $faker->e164PhoneNumber,
        // 'cover_image' => $faker,
        // 'logo' => $faker,
        'status' => 'active',
    ];
});
