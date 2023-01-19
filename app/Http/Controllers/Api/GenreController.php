<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GenreResourceCollection;
use Illuminate\Support\Facades\Cache;

class GenreController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $isApiV2 = str_contains(request()->route()->uri, 'v2');

    $isDraft = $isApiV2 && isset(request()->query()['draft']);
    if ($isDraft) {
      $data = Genre::with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
        ->orderBy('name', 'ASC')
        ->paginate(10);
      if ($data) return response()->json(new GenreResourceCollection($data));
    }

    if ($isApiV2) {
      $cacheTTL = now()->addSeconds(60);

      return Cache::remember('genre_index_v2', $cacheTTL, function () {
        $data = Genre::with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
          ->published()
          ->orderBy('name', 'ASC')
          ->paginate(100);
        return response()->json((new GenreResourceCollection($data)));
      });
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('genre_index', $cacheTTL, function () {
      $data = Genre::with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
        ->published()
        ->orderBy('name', 'ASC')
        ->paginate(10);
      return response()->json((new GenreResourceCollection($data)));
    });
  }

  /**
   * Display the specified resource.
   *
   * @param  int $slug
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $isDraft = str_contains(request()->route()->uri, 'v2') && isset(request()->query()['draft']);
    if ($isDraft) {
      $data = Genre::forSlug($slug)->with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
        ->draft()
        ->first();
      if ($data) return response()->json(new GenreResource($data));
    }

    $data = Genre::forSlug($slug)->with(['notable_performers', 'songs', 'influences', 'influenced', 'cross_influences', 'cross_influenced', 'stories'])
      ->published()
      ->firstOrFail();
    return response()->json(new GenreResource($data));
  }
}
