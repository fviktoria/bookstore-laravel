<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['middleware' => ['api', 'auth.jwt']], function() {
    Route::post('book', [BookController::class, 'save']);
    Route::put('book/{isbn}', [BookController::class, 'update']);
    Route::delete('book/{isbn}', [BookController::class, 'delete']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

Route::get('books', [BookController::class, 'index']);
Route::get('book/{isbn}', [BookController::class, 'findByISBN']);

Route::get('book/checkisbn/{isbn}', [BookController::class,'checkISBN']);

Route::get('books/search/{searchTerm}', [BookController::class,'findBySearchTerm']);



