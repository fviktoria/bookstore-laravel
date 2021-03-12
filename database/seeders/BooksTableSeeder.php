<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use App\Models\User;
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

		// assign user to book
		$user = User::all()->first();
		$book->user()->associate($user);

		$book->save();

		$image1 = new Image;
		$image1->title = 'Bild 1';
		$image1->url = 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2167&q=80';

		$image2 = new Image;
		$image2->title = 'Bild 2';
		$image2->url = 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2653&q=80';

		$book->images()->saveMany([$image1, $image2]);
		$book->save();

		// CLI: php artisan migrate:refresh --seed
	}
}

/*
 * eloquent: OR mapper von laravel
 *
 * OR MAPPING:
 * objektstruktur mit relationaler datenbank verknüpfen -> objektstruktur in db abbilden
 */