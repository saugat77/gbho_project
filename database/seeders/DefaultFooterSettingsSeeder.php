<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultFooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        settings()->set([
            'about_us_short_text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, non architecto temporibus libero voluptatem aperiam iusto veniam dolorem aut numquam.',
            'about_us_page_slug' => 'about-us'
        ]);
    }
}
