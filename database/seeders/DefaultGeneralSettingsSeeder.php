<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultGeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        settings()->set([
            'site_name' => 'Makau Dog Cheq',
            'tagline' => 'Makalu Dairy Uhdyog',
            'site_logo' => '',
            'favicon' => '',

            'show_top_bar' => 'yes',
            'topbar_mobile' => '',
            'topbar_email' => '',

            'price_unit' => '$.',
            'tax_percent' => '',
            'low_stock_threshold' => '10',

            'show_bottom_bar' => 'yes',
            'footer_left_text' => 'Copyright © 2016 Makalu Dog Chew.   All Rights Reserved.',
            'footer_right_text' => 'Powered By: <a href="https://www.festnepal.com.np" target="_blank">Fest Nepal</a>',
        ]);
    }
}
