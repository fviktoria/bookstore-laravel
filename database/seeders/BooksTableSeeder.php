<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;


class BooksTableSeeder extends Seeder
{
	/*
     * CLI COMMAND TO CREATE SEEDER:
     * php artisan make:seeder BooksTableSeeder
	 *
	 * RUN SEEDER:
	 * php artisan db:seed
     */

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$book = new Book();
		$book->title = 'Lord of the Rings';
		$book->isbn = '123456789';
		$book->subtitle = 'Lorem Ipsum';
		$book->rating = 10;
		$book->description = 'Lorem ipsum dolor sit amet';
		$book->published = new DateTime();
		$book->save();
	}
}
