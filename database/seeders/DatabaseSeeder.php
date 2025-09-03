<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() {
        // Clean table every time app opens
        Book::truncate();

        // Define the seed data
        $books = [
            ['name' => 'Book of the Machine God', 'price' => 30, 'author' => 'Games Workshop'],
            ['name' => 'Starter Book of Warhammer 40K', 'price' => 25, 'author' => 'Games Workshop'],
            ['name' => 'Advanced Book of Warhammer 40K', 'price' => 40, 'author' => 'Games Workshop'],
        ];

        // Insert each book using Eloquent, timestamps will auto-generate
        foreach ($books as $book) {
            Book::create($book);
        }

        $this->command->info('Books table seeded successfully!');
    }
}
