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

            ['id' => 1, 'page_id' =>6, 'sort' => 1, 'name' => ['en' => 'Press Releases']],
            ['id' => 2, 'page_id' => 6, 'sort' => 2, 'name' => ['en' => 'Media Coverage']],
            ['id' => 3, 'page_id' =>6, 'sort' => 3, 'name' => ['en' => 'Media Kit']],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
