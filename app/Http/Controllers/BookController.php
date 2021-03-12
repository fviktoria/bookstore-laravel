<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
    	$books = Book::with(['authors', 'images'])->get(); // with -> lazy loading umgehen und gesamten object tree returnen
    	return $books;
	}

	public function show($id) {
    	$book = Book::all()->find($id);
		return view('books.show', compact('book'));
	}
}