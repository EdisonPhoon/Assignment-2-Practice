<html DOCTYPE! lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tasks List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>May the Machine Spirit Display Tasks List</h1>
        <!-- Content goes here -->
        <form action="{{ route('task.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- important for update -->
            <input type="text" name="name" value="{{ $task->name }}">
            <input type="number" name="duration" value="{{ $task->duration }}">
            <input type="text" name="author" value="{{ $task->author }}">
            <button type="submit">Update Task</button>
        </form>

    </body>
    
</html>
