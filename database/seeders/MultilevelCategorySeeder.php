<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MultilevelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Category::class, 10)->create()->each(function ($category) {
            factory(\App\Category::class, 10)->create([
                'parent_id' => $category->id
            ])->each(function ($category) {
                factory(\App\Category::class, 5)->create([
                    'parent_id' => $category->id
                ]);
            });
        });
    }
}
