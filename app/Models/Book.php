<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'genre_id', 'published_year', 'description', 'cover'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
