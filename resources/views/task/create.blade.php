<html DOCTYPE! lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create Tasks</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>May the Machine Spirit Create Tasks List</h1>
        <!-- Content goes here -->
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Task name">
            <input type="number" name="duration" placeholder="Duration">
            <input type="text" name="author" placeholder="Author">
            <button type="submit">Add Task</button>
        </form>

    </body>
    
</html>
