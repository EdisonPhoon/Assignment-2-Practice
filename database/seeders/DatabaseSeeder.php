<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() {
        // Clean table every time app opens
        Task::truncate();

        $this->call(TaskTableSeeder::class); // add this line
    }
}
