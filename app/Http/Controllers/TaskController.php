<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Retrieve all from tasks table and return to view
    public function index() {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));
    }

    public function edit(Task $task) {
        // Find the task by ID
        $task = Task::findOrFail($id);
        // Return the task to the "task/edit" view
        return view('task.edit', compact('task'));
    }

    public function create() {
        return view('task.create');
    }

    public function store (Request $request) {
        
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:40',
            'duration' => 'required|integer',
            'author' => 'required|string|max:40',
        ]);

        // Create new "task"
        Task::create($validatedData);

        // Redirect to the task index page with a success message
        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task) {
        return view('task.show', compact('task'));
    }
}
