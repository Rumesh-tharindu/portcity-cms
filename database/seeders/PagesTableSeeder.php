<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            //Menu
            ['id' => 1, 'name' => ['en' => 'Home Page']],
            ['id' => 2, 'name' => ['en' => 'Business Hub']],
            ['id' => 3, 'name' => ['en' => 'Lifestyle']],
            ['id' => 4, 'name' => ['en' => 'Laws & Regulation']],
            ['id' => 5, 'name' => ['en' => 'About']],
            ['id' => 6, 'name' => ['en' => 'Media Room']],
            ['id' => 7, 'name' => ['en' => 'Contact']],
            ['id' => 8, 'name' => ['en' => 'Portal']],

        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
