<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TmdbController;
use App\Http\Controllers\FavoriteController;

Route::get('/test', function () {
    return response()->json(['message' => 'Api is working!']);
});

Route::prefix('tmdb')->group(function () {
  Route::get('movie/{type}', [TmdbController::class, 'getMoviesList']);
  Route::get('tv/{type}', [TmdbController::class, 'getTvList']);
  Route::get('{category}/{id}/videos', [TmdbController::class, 'getVideos']);
  Route::get('search/{category}', [TmdbController::class, 'search']);
  Route::get('{category}/{id}', [TmdbController::class, 'detail']);
  Route::get('{category}/{id}/credits', [TmdbController::class, 'credits']);
  Route::get('{category}/{id}/similar', [TmdbController::class, 'similar']);
  Route::get('favorites', [FavoriteController::class, 'index']);
  Route::post('favorites', [FavoriteController::class, 'store']);
  Route::delete('/favorites/{movie_id}', [FavoriteController::class, 'destroy']);
});