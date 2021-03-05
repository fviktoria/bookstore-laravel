<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
	/*
	 * CLI COMMAND TO CREATE MIGRATION:
	 * php artisan make:migration create_books_table --create=books
	 */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable(); // nullable = col can be empty
            $table->date('published')->nullable();
            $table->integer('rating')->default('1');
            $table->text('description')->nullable(); // TEXT/LONGTEXT (no varchar)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
