<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Add this route for the root URL
Route::get('/', function () {
    return view('welcome');
});

/* "Task" routes
Route::get('task', [TaskController::class, 'index']);
Route::get('task/index', [TaskController::class, 'index']);
Route::get('task/create', [TaskController::class, 'create'])->name('task.create');
*/

// Resource route for TaskController
Route::resource('task', TaskController::class);