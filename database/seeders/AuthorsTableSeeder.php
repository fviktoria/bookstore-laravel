<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = new Author;
        $author1->firstName = 'Matt';
        $author1->lastName = 'Haig';
        $author1->save();

        $author2 = new Author;
		$author2->firstName = "J. R. R.";
		$author2->lastName = "Tolkien";
		$author2->save();

		$author3 = new Author;
		$author3->firstName = "J. K.";
		$author3->lastName = "Rowling";
		$author3->save();
    }
}
