<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * CREATE MODEL CLI COMMAND
 * php artisan make:model Book
 */

class Book extends Model
{
	use HasFactory;

	// define which properties are writable (NOT: id, created_at, updated_at)
	protected $fillable = ['isbn', 'title', 'subtitle', 'published', 'rating', 'description', 'user_id'];

	/*
	 * TEST WITH TINKER (CLI): php artisan tinker
	 * >>> App\Models\Book::first()->isFavorite();
	 */
	public function isFavorite(): bool {
		return $this->rating >= 8;
	}

	/**
	 * book has many images
	 */
	public function images(): HasMany {
		return $this->hasMany(Image::class);
	}

	/**
	 * book belongs to one user
	 */
	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}
}
