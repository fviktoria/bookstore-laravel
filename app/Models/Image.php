<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title'];

    /**
	 * book has many images (1:n)
	 */
    public function book() : BelongsTo {
    	return $this->belongsTo(Book::class);
	}
}

/**
 * traits: helper functions
 * https://www.php.net/manual/en/language.oop5.traits.php
 */