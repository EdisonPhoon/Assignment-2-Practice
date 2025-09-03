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

📝 **Note:** To appease your Machine Spirit when recreating this. **Be informed** that this uses PHP 8.4.11, PHP Package Manager and MYSQL.

**Error Output:** 🔥
```
bash

mysql --version
mysql : The term 'mysql' is not recognized as the name of a cmdlet, function, script file, or operable program. Check the spelling of the name, or if a path was included, verify that the path is correct and 
try again.
At line:1 char:1
+ mysql --version
+ ~~~~~
    + CategoryInfo          : ObjectNotFound: (mysql:String) [], CommandNotFoundException
    + FullyQualifiedErrorId : CommandNotFoundException
```

This means that the Machine Spirit has naught found the MYSQL client installed.

**Solution:**  🔥

1. Navigate to *MySQL Community Server Downloads* at https://dev.mysql.com/downloads/mysql/?utm_source=chatgpt.com0

2. Select and download *Windows (x86, 64-bit, MSI Installer)* [^5]

3. Run the `mysql-9.4.0-winx64.msi` file

4. Under section **Choose Setup Type**, select *Custom*

5. Select **MYSQL Server** → **Will be installed on local hard drive**

6. Select **Client Programs** → **Will be installed on local hard drive**

📝 **Note:** It is not mandatory to 'enable' **Development Components** since *DBNgin* will be used

7. Ensure that data directory is allocated to correct path

8. Under section **Server Configuration Type**, select **Development Computer**

9. Ensure **Port** is 3306 and **X Protocol Port** is 33060

10. Ensure option **Enable TCP/IP Networking** is enabled

11. Create your password and add your user account

12. Allow basic sense through the remainder of the process

13. Execute this in cmd
```
bash

mysql --version
```

**Error Output:** 🕰️
``` 
plaintext

This application requires the latest Visual Studio 2019 x64 Redistributable. Please install it and then run this installer again.
```

**Solution:** 🕰️

1. Navigate to *Visual C++ Redistributable for Visual Studio 2019* at https://learn.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist?view=msvc-170&utm_source=chatgpt.com

2. Proceed to the section **Visual Studio 2015, 2017, 2019, and 2022**

3. Download and run `VC_redist.x64.exe` for 64-bit Windows

**Error Output:** 😐
```
bash

mysql --version
mysql : The term 'mysql' is not recognized as the name of a cmdlet, function, script file, or operable program. Check
the spelling of the name, or if a path was included, verify that the path is correct and try again.
At line:1 char:1
+ mysql --version
+ ~~~~~
    + CategoryInfo          : ObjectNotFound: (mysql:String) [], CommandNotFoundException
    + FullyQualifiedErrorId : CommandNotFoundException
```

**Solution:** 😐

1. Press `Win + S` → search **Environment Variables** → **system environment variables**

2. Click **System variables** → select **Path** → Edit → New

3. Paste *C:\Program Files\MySQL\MySQL Server 9.4\bin*

4. Click OK → OK → OK

5. Run in cmd
```
bash

mysql -u root -p
```

6. Exit terminal by typing *exit*

# 2. Create Laravel Project
```
bash

composer create-project laravel/laravel Assignment-2-Practice
```

**Error Output:** 😅
``` 
bash

https://repo.packagist.org could not be fully loaded (curl error 60 while downloading https://repo.packagist.org/packages.json:
SSL certificate problem: unable to get local issuer certificate), package information was loaded from the local cache and may be out of date
```

**Solution:** 😅

1. Disable your firewall [temporarily] to so that the composer can download the necessary repository files.


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

📝 **Note:** en dashes (-) are not to be mistaken for em dashes (—) which are longer than en dashes


**Error Output:** 😨
```
bash

php artisan serve --host=localhost --port=8000
<br />
    <b>Warning</b>:  Unknown: php_network_getaddresses: getaddrinfo for localhost failed: No such host is known in <b>Unknown</b> on line <b>0</b><br />
    PHP Warning:  Unknown: php_network_getaddresses: getaddrinfo for localhost failed: No such host is known in Unknown on line 0
    Failed to listen on localhost:8000 (reason: php_network_getaddresses: getaddrinfo for localhost failed: No such host is known 
```

**Solution:** 😨

1. Run **Notepad** as administrator

2. Open *C:\\Windows\\System32\\drivers\\etc\\hosts*

3. Ensure the following is not commented with #
``` 
file

127.0.0.1	localhost
:: 1		localhost
```

4. Run this if `php artisan serve --host=localhost --port=8000` still does not work
``` 
bash

php -S 127.0.0.1:8000 -t public
```
5. To exit, close the window or hit `Ctrl + C`

📝 **Note:** This forces the Laravel file to run and brings you to a web server log


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


**Start Session:** 01-09-2025
**End Session:** 03-09-2025

**Remark:** 
> The Machine Spirit proved surprisingly cooperative today

> The Developer took almost a day off from this session

> Logbook structure was recalibrated again


___


# 6. Open TablePlus 

1. Proceed to DBNgin

2. Create and enable service named **AP2**

3. Invoke this command to the Machine Spirit
```
powershell

& "C:\Program Files\MySQL\MySQL Server 9.4\bin\mysql.exe" -u root -p
```

4. Run this to check if created database was successful
```
mysql

CREATE DATABASE A2P CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON A2P.* TO 'edison'@'localhost';
FLUSH PRIVILEGES;
SHOW DATABASES;
```


___


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

2. Edit to match mysql server config
```
plaintext

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=a2p
DB_USERNAME=test
DB_PASSWORD=admin@12345
```


___


# 8. Laravel Migration

💡 **Context:** Migration is a **system** that enables the *creating* and *modifying* of a table through PHP instead of SQL

1. Type this in your terminal within your workspace file
```
bash

php artisan make:migration create_40k_starter_book --create=books
```

2. Go to recently created table

2. Insert this in the `up` method
```
php

public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('chapter', 40)->nullable(false);
            $table->integer('price')->nullable(false);
            $table->string('author', 80)->nullable(false);
            $table->timestamps();
        });
    }
```

4. Run **php artisan migrate** to apply the migration.

## Code Analysis

**ID Field**
```
php

$table->id();
```
This declares a **primary key column** named `id`. This field auto-increments with each migration.

**Chapter Field**
```
php

$table->string('chapter', 40)->nullable(false);
```
This declares a **string column** named `chapter` (40 characters maximum). This field is required.

**Price Field**
```
php

$table->integer('price')->nullable(false);
```
This declares an **integer column** named `price` (no character limit). This field is required.

**Author Field**
```
php

$table->string('author', 80)->nullable(false);
```
This declares an **string column** named `author` (80 character maximum). This field is required.

**Timestamp Field**
```
php

$table->timestamps();
```
This declares 2 **timestamp columns** named `created_at` and `updated_at`. This field is generated automatically.

___

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

Annotation Used:

💡 **Context:** 

📝 **Note:** 


## Disclaimer
- The Developer has an interest in Warhammer 40K lore. 
- Reading the fun text (or not) is up to the reader's choice
- Fun text should not impede the intended and sensical meaning of actual messages and notes written by the Developer
- Kindly contact and mediate with Edison if you find certain messages and notes to be confusing due to the fun text!

## Fun Text Terms (You DO NOT have to read this if you WANT to ignore the fun text)
- Machine Spirit - Local device or terminal (depends on context)
- Omnimessiah - Fictional character in Warhammer 40K. Note that Edison does not intend to offend any religious beliefs

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




