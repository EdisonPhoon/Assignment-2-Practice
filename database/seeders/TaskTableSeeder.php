<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Clean table every time app opens
        DB::table('tasks')->truncate();

        // Add new row with these data
        $tasks = [
            ['name' => 'Task 1', 'duration' => 30, 'author' => 'User1'],
            ['name' => 'Task 2', 'duration' => 25, 'author' => 'User2'],
            ['name' => 'Task 3', 'duration' => 40, 'author' => 'User3'],
        ];

        // Insert data into the table
        foreach ($tasks as $task) {
            DB::table('tasks')->insert($task);
        }


    }
}
