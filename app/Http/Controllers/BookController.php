<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
    	$books = Book::all();
    	return view('books.index', compact('books'));
	}

	public function show($id) {
    	$book = Book::all()->find($id);
		return view('books.show', compact('book'));
	}
}