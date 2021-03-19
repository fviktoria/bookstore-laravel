<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class BookController extends Controller
{
    public function index() {
    	$books = Book::with(['authors', 'images', 'user'])->get(); // with -> lazy loading umgehen und gesamten object tree returnen
    	return $books;
	}

	public function findByISBN($isbn) {
    	$book = Book::where('isbn', $isbn)->with(['authors', 'images', 'user'])->first();
    	return $book;
	}

	public function checkISBN (string $isbn)  {
		$book = Book::where('isbn', $isbn)->first();
		return $book != null ? response()->json(true, 200) : response()->json(false, 200);
	}


	public function findBySearchTerm(string $searchTerm) {
		$book = Book::with(['authors', 'images', 'user'])
			->where ('title', 'LIKE', '%' . $searchTerm .'%')
			->orWhere ('subtitle' , 'LIKE', '%' . $searchTerm .'%')
			->orWhere ('description' , 'LIKE', '%' . $searchTerm .'%')

			->orWhereHas('authors', function ($query) use ($searchTerm) {
				$query->where('firstName', 'LIKE', '%' . $searchTerm .'%')
					->orWhere('lastName', 'LIKE', '%' . $searchTerm .'%');
			})->get();
		return $book;
	}

	public function save(Request $request) : JsonResponse {
		$request = $this->parseRequest($request);

		DB::beginTransaction();
		try {
			$book = Book::create($request->all());

			// save images
			if (isset($request['images']) && is_array($request['images'])) {
				foreach ($request['images'] as $img) {
					$image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
					$book->images()->save($image);
				}
			}

			// save authors
			if (isset($request['authors']) && is_array($request['authors'])) {
				foreach ($request['authors'] as $auth) {
					$author = Author::firstOrNew(['firstName' => $auth['firstName'], 'lastName' => $auth['lastName']]);
					$book->authors()->save($author);
				}
			}

			DB::commit();
			return response()->json($book, 201);
		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json('saving book failed: ' . $e->getMessage(), 420);
		}
	}

	public function update (Request $request, string $isbn) : JsonResponse {
		DB::beginTransaction();
		try {
			$book = Book::with(['authors', 'images', 'user'])->where('isbn', $isbn)->first();

			if ($book != null) {
				$request = $this->parseRequest($request);
				$book->update($request->all());

				$book->images()->delete();

				// update images
				if (isset($request['images']) && is_array($request['images'])) {
					foreach ($request['images'] as $img) {
						$image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
						$book->images()->save($image);
					}
				}

				// update authors
				$ids = [];
				if (isset($request['authors']) && is_array($request['authors'])) {
					foreach ($request['authors'] as $auth) {
						array_push($ids, $auth['id']);
					}
				}

				$book->authors()->sync($ids);
				$book->save();
			}

			DB::commit();
			$book1 = Book::with(['authors', 'images', 'user'])->get();
			return response()->json($book1, 201);

		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json("updating book failed: " . $e->getMessage(), 420);
		}
	}

	public function show($id) {
    	$book = Book::all()->find($id);
		return view('books.show', compact('book'));
	}

	/**

	 * modify / convert values if needed

	 */

	private function parseRequest(Request $request) : Request {

		// get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"

		$date = new \DateTime($request->published);

		$request['published'] = $date;

		return $request;

	}
}