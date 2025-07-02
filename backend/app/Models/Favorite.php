<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'movie_id',
        'adult',
        'backdrop_path',
        'genre_ids',
        'original_language',
        'original_title',
        'overview',
        'popularity',
        'poster_path',
        'release_date',
        'title',
        'name',
        'video',
        'vote_average',
    ];

    protected $casts = [
        'genre_ids' => 'array',
        'adult' => 'boolean',
        'video' => 'boolean',
        'popularity' => 'float',
        'vote_average' => 'float',
    ];
}
