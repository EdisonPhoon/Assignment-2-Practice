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

💡 **Context:** Migration is a **system** that enables the *creating* and *modifying* of a table through PHP instead of SQL

1. Run this to create a migration file
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

*If a Query Exception occurs, see Appendix A*


**Error Output:**
```
powershell

php artisan migrate

    Illuminate\Database\QueryException 

    SQLSTATE[HY000] [1045] Access denied for user 'edison'@'localhost' (using password: YES) (Connection: mysql, SQL: select exists (select 1 from information_schema.tables where table_schema = schema() and table_name = 'migrations' and table_type in ('BASE TABLE', 'SYSTEM VERSIONED')) as `exists`)

    at vendor\laravel\framework\src\Illuminate\Database\Connection.php:824
    820▕                $this->getName(), $query, $this->prepareBindings($bindings), $e
    821▕                    );
    822▕                }
    823▕
    ➜ 824▕             throw new QueryException(
    825▕                 $this->getName(), $query, $this->prepareBindings($bindings), $e
    826▕             );
    827▕         }
    828▕     }

    1   vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:67
        PDOException::("SQLSTATE[HY000] [1045] Access denied for user 'edison'@'localhost' (using password: YES)")

    2   vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:67
        PDO::connect("mysql:host=127.0.0.1;port=3306;dbname=a2p", "edison", Object(SensitiveParameterValue), [])
```

**Solution:**

1. Use the root password
```
powershell

& "C:\Program Files\MySQL\MySQL Server 9.4\bin\mysql.exe" -u root -p
```

2. Check if `edison` exists
```
mysql

SELECT user, host, plugin FROM mysql.user WHERE user = 'edison';
ALTER USER 'edison'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'admin@12345678';
GRANT ALL PRIVILEGES ON a2p.* TO 'edison'@'localhost';
FLUSH PRIVILEGES;
exit
```

3. Ensure that the password in .env file is the same one in the MySQL server
```
bash

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=a2p
DB_USERNAME=edison
DB_PASSWORD=admin@12345678
MYSQL_ATTR_SSL_CA=null
```

4. Retry migration
```
bash

php artisan migrate
```


# 10. Creating a Model

1. Create the model
```
bash

php artisan make:model Book
```

2. Insert `protected $fillable` for mass assignment
```
php

// Allow mass assignment for these columns
    protected $fillable = ['name', 'price', 'author'];
```
💡 **Context:** $fillable states which field should be automatically filled in.


# 11. Initiating a Seeding

1. Run this
```
bash
php artisan make:seeder BookSeeder
```
💡 **Context:** A seeding is inserting data into the table *when the application starts* via running commands.

2. Navigate to `database/seeders` and open `BookSeeder.php`.

3. Modify to your liking. Here is an example.

```
php

public function run(): void
    {
        // Clean table every time app opens
        DB::table('books')->truncate();

        // Add new row with these data
        $books = [
            ['name' => 'Book of the Machine God', 'price' => 30, 'author' => 'Games Workshop'],
            ['name' => 'Starter Book of Warhammer 40K', 'price' => 25, 'author' => 'Games Workshop'],
            ['name' => 'Advanced Book of Warhammer 40K', 'price' => 40, 'author' => 'Games Workshop']
        ];
    }
```
📝 **Note:** Since the prerequiste is to have `created at` and `updated at` timestamps automatically assigned.

4. Run `php artisan db:seed` to apply seeding

**Error Output:**
```
php

php artisan db:seed

   INFO  Seeding database.


   Error 

  Class "Database\Seeders\DB" not found

  at database\seeders\DatabaseSeeder.php:17
     13▕      */
     14▕     public function run(): void
     15▕     {
     16▕         // Clean table every time app opens
  ➜  17▕         DB::table('books')->truncate();
     18▕
     19▕         // Add new row with these data
     20▕         $books = [
     21▕             ['name' => 'Book of the Machine God', 'price' => 30, 'author' => 'Games Workshop'],

  1   vendor\laravel\framework\src\Illuminate\Container\BoundMethod.php:36
      Database\Seeders\DatabaseSeeder::run()

  2   vendor\laravel\framework\src\Illuminate\Container\Util.php:43
      Illuminate\Container\BoundMethod::{closure:Illuminate\Container\BoundMethod::call():35}()
```

**Solution:**
```
php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
```

# 11. Controller & Routing

1. Type this into `web.php` at `/routes/`

```
php

use App\Http\Controllers\BookController;

Route::get('book', 'BookController@index');
```

This enables the Machine Spirit's client request to be directed to the *controller* rather than *returned*.

2. Create the controller
```
bash
php artisan make:controller BookController
```

3. Insert this after **namespace**
```
php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
```

4. Write the method to **retrieve all books**
```
php

class BookController extends Controller {
    public function index() {
    // Retrieve all values from the Book table
    $books = Book::all();


    // Pass the retrieved values to the “book/index” view
    return view('book/index', compact('books'));
    }
}
```

5. Write the method to **edit a book**
```
php

public function edit($id) {
    $book = Book::findOrFail($id);

    return view('book/edit', compact('book') );
}
```

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

**Solution:** Run `php -S 127.0.0.1:8000 -t public` to force Laravel Herd to run.

## Appendix C

**Error:** TablePlus cannot connect to MySQL server

**Cause:** The MySQL service is not running.

**Solution:** Start the MySQL by running `& "C:\Program Files\MySQL\MySQL Server 9.4\bin\mysql.exe" -u root -p`

___

## Annotation Used

💡 **Context:** 

📝 **Note:** 

___

## Disclaimer
- The Developer has an interest in Warhammer 40K lore. 
- Reading the fun text (or not) is up to the reader's choice.
- Fun text should not disturb actual, non-fun fact, messages and notes left behind.

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




