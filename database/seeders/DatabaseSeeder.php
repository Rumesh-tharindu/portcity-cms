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
        if (! app()->isProduction()) {
            $this->call([
                PermissionsTableSeeder::class,
                RolesTableSeeder::class,
                UsersTableSeeder::class,
                PagesTableSeeder::class,
                CategoriesTableSeeder::class,
            ]);
        }
    }
}
