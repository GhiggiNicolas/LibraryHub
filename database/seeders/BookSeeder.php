<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'description' => 'The first book in the Harry Potter series.',
                'pages' => 223,
                'image' => 'book_1a2b3c.png',
                'author_id' => 1,
                'category_id' => 4,
            ],
            [
                'title' => '1984',
                'description' => 'A dystopian novel about total control.',
                'pages' => 328,
                'image' => 'book_4d5e6f.png',
                'author_id' => 2,
                'category_id' => 1,
            ],
            [
                'title' => 'Pride and Prejudice',
                'description' => 'A classic of English literature.',
                'pages' => 279,
                'image' => 'book_7g8h9i.png',
                'author_id' => 3,
                'category_id' => 1,
            ],
        ];

        foreach ($books as $book) {
            Book::query()->create($book);
        }
    }
}
