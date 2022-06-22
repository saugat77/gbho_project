<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            CategorySeeder::class,
            SettingsSeeder::class,
            DefaultGeneralSettingsSeeder::class,
            DefaultFooterSettingsSeeder::class
        ]);
    }
}
