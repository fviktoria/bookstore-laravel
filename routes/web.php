<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$books = DB::table('books')->get();
	return $books;
	exit;
    return view('welcome', [
    	'firstName' => 'Viktoria',
    	'lastName' => 'Ferstl',
		'books' => ['Notes on a nervous planet', 'Sapiens']
	]);
});