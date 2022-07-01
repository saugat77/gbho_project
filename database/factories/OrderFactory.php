<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'user_id' => User::first()->id,
        'payment_method' => 'COD',
        'total_price' => random_int(1000, 5000),
        'status' => 'delivered',
        'created_at' => $faker->dateTimeBetween($startDate = '-400 days', $endDate = 'now', $timezone = null)
    ];
});
