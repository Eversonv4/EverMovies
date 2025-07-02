<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TmdbController extends Controller
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.key');
        $this->baseUrl = config('services.tmdb.url');
    }

    private function request(string $endpoint, array $params = [])
    {
        $params['api_key'] = $this->apiKey;

        $response = Http::get("{$this->baseUrl}{$endpoint}", $params);

        return response()->json($response->json(), $response->status());
    }

    public function getMoviesList($type, Request $request)
    {
        return $this->request("movie/{$type}", $request->all());
    }

    public function getTvList($type, Request $request)
    {
        return $this->request("tv/{$type}", $request->all());
    }

    public function getVideos($category, $id)
    {
        return $this->request("{$category}/{$id}/videos");
    }

    public function search($category, Request $request)
    {
        return $this->request("search/{$category}", $request->all());
    }

    public function detail($category, $id, Request $request)
    {
        return $this->request("{$category}/{$id}", $request->all());
    }

    public function credits($category, $id)
    {
        return $this->request("{$category}/{$id}/credits");
    }

    public function similar($category, $id)
    {
        return $this->request("{$category}/{$id}/similar");
    }
}
