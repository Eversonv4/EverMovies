<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
     public function index()
    {
        return Favorite::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id' => 'required|integer|unique:favorites,movie_id',
            'adult' => 'required|boolean',
            'backdrop_path' => 'nullable|string',
            'genre_ids' => 'nullable|array',
            'original_language' => 'nullable|string',
            'original_title' => 'nullable|string',
            'overview' => 'nullable|string',
            'popularity' => 'nullable|numeric',
            'poster_path' => 'nullable|string',
            'release_date' => 'nullable|date',
            'title' => 'nullable|string',
            'name' => 'nullable|string',
            'video' => 'boolean',
            'vote_average' => 'nullable|numeric',
        ]);

        $favorite = Favorite::create($data);

        return response()->json($favorite, 201);
    }

    public function destroy($movie_id)
    {
        $favorite = Favorite::where('movie_id', $movie_id)->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found.'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite removed successfully.'], 200);
    }
}
