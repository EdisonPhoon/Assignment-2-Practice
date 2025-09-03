<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller {
    
    public function index() {
        $books = Book::all();
        return view('book.index', compact('books')); // Make sure it's 'book.index'
    }

    public function create() {
        return view('book.create');
    }
}
