<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

            ['page_id' =>6, 'section' => 'publication', 'sort' => 1, 'name' => ['en' => 'Press Releases']],
            ['page_id' =>6, 'section' => 'publication', 'sort' => 2, 'name' => ['en' => 'Media Coverage']],
            ['page_id' =>6, 'section' => 'publication', 'sort' => 3, 'name' => ['en' => 'Media Kit']],

            ['page_id' => 3, 'section' => 'activity', 'sort' => 1, 'name' => ['en' => 'Social']],
            ['page_id' => 3, 'section' => 'activity', 'sort' => 2, 'name' => ['en' => 'Recreational']],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
