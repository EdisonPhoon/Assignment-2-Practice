# Laravel CRUD Operation

## *May the Machine God steady your programming*

**Project:** Assignment 2 Practice (A2P)

**Date:** 31-08-2025

**Developer:** Edison

**Environment:** Laravel 12, VSCode, MySQL, PHP 8.4

___

**Start Session:** 31-08-2025
**End Session:** 01-09-2025

**Remark:** 
> The Machine Spirit is not cooperative today

> Logbook structure was recalibrated as of 31/08/25 or 31-08-25:M3 (2025, 3rd millennium)


# 1. Check requirements 
``` 
bash

php -v
composer -v
mysql --version
```

📝 **Note:** Used PHP 8.4.11, PHP Package Manager and MYSQL.

*If mysql is not recognised in powershell and cmd, it means that it hasn't been installed. See Appendix A for error log and solution.*

*If Visual C++ Redistributable is not installed, download `Visual C++ Redistributable for Visual Studio 2019` from https://learn.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist?view=msvc-170&utm_source=chatgpt.com.*

# 2. Create Laravel Project
```
bash

composer create-project laravel/laravel Assignment-2-Practice
```

*If a curl error 60 occurs, the solution is to disable firewall temporarily.* 

# 3. Nagivate to directory
``` 
bash

cd Assignment-2-Practice
```

# 4. Run PHP dev server
``` 
bash

php artisan serve --host=localhost --port=8000
```

📝 **Note:** make they are **double** en dashes (-). Not a single em dash (—).

*If localhost failed to connect or not found, see Appendix B for error log and solution.*

# 5. Initialise Git
```
bash

git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/EdisonPhoon/Assignment-2-Practice.git
git push -u origin main
```
___
*End of Session 1 (01-09-2025)*


**Start Session:** 01-09-2025
**End Session:** 04-09-2025

**Remark:** 
> The Machine Spirit proved surprisingly cooperative today

> Took almost an entire day off from this session

> Logbook structure was recalibrated again  

# 6. Open TablePlus

1. Proceed to DBNgin

2. Create and enable service named **AP2**

*If TablePlus cannot be connected, refer to Appendix C for error log and solution.*

# 7. Configure .env file
1. Find this
```
plaintext

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

2. Change to this
```
plaintext

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=a2p
DB_USERNAME=test
DB_PASSWORD=admin@12345
```

# 8. Laravel Migration

Migration is a **system** that enables the *creating* and *modifying* of a table through PHP instead of SQL

1. Create migration file
```
bash

php artisan make:migration create_task_table --create=tasks
```

2. Go to `create_task_table` and insert this to set up columns
```
php

public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40)->nullable(false);
            $table->integer('duration')->nullable(false);
            $table->string('author', 80)->nullable(false);
            $table->timestamps();
        });
    }
```

`$table->id();` -> Primary key column named `id` that auto-generates and auto-increments with every migration.

`$table->string('name', 40)->nullable(false);` -> String column named `name` (40 characters maximum). This field is required.

`$table->integer('duration')->nullable(false);` -> Integer column named `duration` (no character limit). This field is required.

`$table->string('author', 80)->nullable(false);` -> String column named `author` (80 character maximum). This field is required.

`$table->timestamps();` -> Two special columns named `created_at` and `updated_at`. This field is generated automatically.

3. Run **php artisan migrate** to apply the migration.

*If a Query Exception occurs, see Appendix D*

# 9. Creating a Model

1. *Run this*
```
bash

php artisan make:model Task
```

2. Insert `protected $fillable` for mass assignment
```
php

// Allow mass assignment for these columns
    protected $fillable = ['name', 'duration', 'author'];
```
The `$fillable` property states which field should be automatically filled in.

*If you have a problem where `php artisan db:seed` runs a different Seeder file, see Appendix F*

# 10. Create a Seeder

1. Run this
```
bash
php artisan make:seeder TaskTableSeeder
```
Seeding is a system enabling the entering of data into tables through PHP instead of SQL.

2. Insert this at `database/seeders/TaskTableSeeder.php`.
```
php

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
            ['name' => 'Task 1', 'duration' => 30, 'author' => 'User 1'],
            ['name' => 'Task 2', 'duration' => 25, 'author' => 'User 2'],
            ['name' => 'Task 3', 'duration' => 40, 'author' => 'User 3'],
            ['name' => 'Task 4', 'duration' => 20, 'author' => 'User 4'],
        ];

        // Insert data into the table
        foreach ($tasks as $task) {
            DB::table('tasks')->insert($task);
        }
    }
}

```
We want to have the timestamp field set automatically, so we use the `DB::table('tasks')->insert($task);` method instead of Eloquent's `Task::create($task);` method.

3. Run `php artisan db:seed --class=TaskTableSeeder` to apply seeding

4. Check in TablePlus if the data has been inserted by typing `mysql> select * from tasks;` in the query window.

# 11. Create a Controller

1. *Run this*
```
bash

php artisan make:controller TaskController
```

2. Insert this at `app\Http\Controllers\TaskController.php`
```
php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $this->call(TaskTableSeeder::class);

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

```

*If `php artisan db:seed` cmdlet keeps looping, see Appendix E*

# 12. Create a Routes

1. Insert this into `/routes/web.php`
```
php

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
```
Since the **resource** route was used, the other routes were commented out and no need to manually define routes for "task`.

2. Run `php artisan route:list` to check if the routes were created successfully.

3. Open `http://localhost:8000/task` to check if the route is working.

# 13. Create Views
1. Create a folder named `task` in `resources/views`

2. Create `index.blade.php` in `resources/views/task` and create basic HTML code

3. For `create.blade.php` in `resources/views/task`, insert this into the HTML body
```
php

<form action="{{ route('task.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    
    <label>Duration:</label>
    <input type="number" name="duration" required>
    
    <label>Author:</label>
    <input type="text" name="author" required>
    
    <button type="submit">Add Task</button>
</form>
```

4. For `edit.blade.php` in `resources/views/task`, insert this into the HTML body
```
php
<form action="{{ route('task.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- important for update -->
    <input type="text" name="name" value="{{ $task->name }}">
    <input type="number" name="duration" value="{{ $task->duration }}">
    <input type="text" name="author" value="{{ $task->author }}">
    <button type="submit">Update Task</button>
</form>
```

5. For `show.blade.php` in `resources/views/task`, insert this into the HTML body
```
php
<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>ID</th>
    <td>{{ $task->id }}</td>
</tr>
<tr>
    <th>Name</th>
    <td>{{ $task->name }}</td>
</tr>
<tr>
    <th>Duration</th>
    <td>{{ $task->duration }}</td>
</tr>
<tr>
    <th>Author</th>
    <td>{{ $task->author }}</td>
</tr>
<tr>
    <th>Created At</th>
    <td>{{ $task->created_at }}</td>
</tr>
<tr>
    <th>Updated At</th>
    <td>{{ $task->updated_at }}</td>
</tr>
</table>
<a href="{{ route('task.index') }}">Back to Task List</a>
```

6. Create functions at `app/Http/Controllers/TaskController.php`
```
php

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
```

7. Test at your localhost site with `/task`, `/task/create` and `/task/edit` at the end of the URL

___

## Appendix A

**Error:** Command Not Found (MySQL not recognised in path)

**Cause:** MySQL was not installed properly or the path was not set correctly during installation.

**Solution:**

1. Download `Windows (x86, 64-bit, MSI Installer)` from https://dev.mysql.com/downloads/mysql/?utm_source=chatgpt.com0

2. Configure in this following:

    - The `Choose Setup Type` is *Custom*

    - The `MYSQL Server` is *Will be installed on local hard drive*

    - The `Client Programs` is *Will be installed on local hard drive*

    - No need to enable *Development Components*

    - Go to *Server Configuration Type* -> *Development Computer*

    - *Port* is 3306

    - *X Protocol Port* is 33060

    - Enable *Enable TCP/IP Networking*

    - Create your password and add your user account (make sure to update the .env file accordingly)

## Appendix B

**Error:** Localhost not found or failed to connect

**Cause:** The `hosts` file in the system32 folder is misconfigured or corrupted.

**Solution:** Make sure that the localhost setting isn't contained in comments (#) and run `php -S 127.0.0.1:8000 -t public` to force Laravel Herd to run.

## Appendix C

**Error:** TablePlus cannot connect to MySQL server

**Cause:** The MySQL service is not running.

**Solution:** Start the MySQL service by running `net start mysql` in the command prompt.

## Appendix D
**Error:** Query Exception - Access denied for user 'username'@'localhost' (using password: YES)

**Cause:** The user does not have the correct password or privileges to access the database.

**Solution:** *Then run these commands*
```
bash

& "C:\Program Files\MySQL\MySQL Server 9.4\bin\mysql.exe" -u root -p
```
```
mysql

SELECT user, host, plugin FROM mysql.user WHERE user = 'edison';
ALTER USER 'edison'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin@12345678';
GRANT ALL PRIVILEGES ON a2p.* TO 'edison'@'localhost';
FLUSH PRIVILEGES;
exit;
```

## Appendix E
**Error:** Seeder cmdlet keeps running indefinitely

**Cause:** The `TaskTableSeeder.php` file is misconfigured / incorrect usage of `php artisan db:seed`.

**Solution:** Make sure that `TaskTableSeeder.php` contains this code
```
php

public function run(): void {
    $this->call(TaskTableSeeder::class);
}
```
Then run `php artisan db:seed` instead of `php artisan db:seed --class=TaskTableSeeder`. And **run the command inside** the Seeder file, not anywhere else. Because it may trigger a different Seeder file!

## Appendix F
**Error:** Seeder cmdlet runs a different Seeder file

**Cause:** The `DatabaseSeeder.php` file is misconfigured / incorrect usage of `php artisan db:seed`.

**Solution:** Make sure that `DatabaseSeeder.php` contains this code
```
php

$this->call(TaskTableSeeder::class);
```

Run `php artisan migrate:fresh --seed` to reset the database and re-apply migration and seeding.

## Appendix G
**Error:** BindingResolutionException - Target class [App\Http\Controllers\TaskController] does not exist.

**Cause:** The `TaskController.php` file is misconfigured / incorrect usage of `php artisan make:controller`.

**Solution:** Make sure that this code is found at `DatabaseSeeder.php` not `TaskTableSeeder.php`
```
php

$this->call(TaskTableSeeder::class);
```
*End of Session 2 (04-09-2025)*

## End of Logbook

**Remark:** 
> It was pure nightmare of day and night of 13-16 hours per session, 6 days total.

> Experienced lots of burnouts, eye strains and hunger withdrawals.

> The Machine Spirit is finally at peace.

> Ignored self-care and health protocols many occassions.

> Currently under "Mind Parliament" supervision (no need to worry about this).

> Logbook had to be re-written entirely due to restarting from square one (many times).

> Up next; Sisyphean task of... doing this for 2nd time -_- X_X

> This was only "practice". No rest for the wicked like me.

___

## Annotation Used

💡 **Context:** 

📝 **Note:** 

___

## **Footnote:**

*Fun Text Section*

[^1]: It means "Good luck to your code!"

[^2]: It means that the developer's local device had multiple problems throughout session

[^3]: It means to use common sense through the process due to self-explanatory instructions

[^4]: It means that logbook had to be re-written entirely due to restarting from square one


*Normal Footnote Section*

[^5]: (Currently this is unused)

[^6]: (Currently this is unused)

[^7]: Former instruction to initiating a connection between Laravel Herd to TablePlus. But the Machine Spirit's unrest caused multiple problems before it was resolved




