<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Allow mass assignment for these columns
    protected $table = 'books';

    protected $fillable = ['name', 'price', 'author'];
}