<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $isDraft = str_contains(request()->route()->uri, 'v2') && isset(request()->query()['draft']);
    if ($isDraft) {
      $data = Author::ordered()->get();
      if ($data) return response()->json(AuthorResource::collection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('authors_index', $cacheTTL, function () {
      $data = Author::published()->ordered()->get();
      return response()->json(AuthorResource::collection($data));
    });
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $isDraft = str_contains(request()->route()->uri, 'v2') && isset(request()->query()['draft']);
    if ($isDraft) {
      $data = Author::published()
        ->where('id', $id)
        ->first();
      if ($data) return response()->json(new AuthorResource($data));
    }

    return Cache::remember('author_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Author::published()
        ->where('id', $id)
        ->firstOrFail();
      return response()->json(new AuthorResource($data));
    });
  }
}
