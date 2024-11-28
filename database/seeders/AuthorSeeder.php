<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $authors = [
            ['name' => 'J.K. Rowling', 'birthday' => '1965-07-31'],
            ['name' => 'George Orwell', 'birthday' => '1903-06-25'],
            ['name' => 'Jane Austen', 'birthday' => '1775-12-16'],
        ];

        foreach ($authors as $author) {
            Author::query()->create($author);
        }
    }
}
