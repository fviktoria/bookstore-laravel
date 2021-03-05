<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
		DB::table('books')->insert([
			'title' => 'The Midnight Library',
			'subtitle' => '',
			'isbn' => '9781786892713',
			'published' => '2020-08-13',
			'rating' => 10,
			'description' => 'Between life and death there is a library. When Nora Seed finds herself in the Midnight Library, she has a chance to make things right. Up until now, her life has been full of misery and regret. She feels she has let everyone down, including herself. But things are about to change. The books in the Midnight Library enable Nora to live as if she had done things differently. With the help of an old friend, she can now undo every one of her regrets as she tries to work out her perfect life. But things aren\'t always what she imagined they\'d be, and soon her choices place the library and herself in extreme danger. Before time runs out, she must answer the ultimate question: what is the best way to live?',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
	}
}
