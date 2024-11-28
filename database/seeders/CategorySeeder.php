<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Novel'],
            ['name' => 'Essay'],
            ['name' => 'Biography'],
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Horror'],
            ['name' => 'Thriller'],
            ['name' => 'Adventure'],
            ['name' => 'Classic'],
            ['name' => 'Science Fiction'],
            ['name' => 'Historical'],
            ['name' => 'Comedy'],
            ['name' => 'Drama'],
            ['name' => 'Poetry'],
            ['name' => 'Religion'],
            ['name' => 'Motivational'],
            ['name' => 'Educational'],
            ['name' => 'Manual'],
            ['name' => 'Autobiography'],
            ['name' => 'Short Stories'],
        ];

        foreach ($categories as $category) {
            Category::query()->create($category);
        }
    }
}
