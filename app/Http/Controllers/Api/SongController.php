<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Http\Resources\SongResourceCollection;
use App\Models\Song;
use Illuminate\Support\Facades\Cache;

class SongController extends Controller
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
      $data = Song::with(['notable_performer'])->paginate(30);
      if ($data) return response()->json(new SongResourceCollection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('songs_index', $cacheTTL, function () {
      $data = Song::with(['notable_performer'])->published()->paginate(30);
      return response()->json(new SongResourceCollection($data));
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
      $data = Song::with(['notable_performer'])
        ->draft()
        ->where('id', $id)
        ->first();
      if ($data) return response()->json(new SongResource($data));
    }

    return Cache::remember('song_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Song::with(['notable_performer'])
        ->published()
        ->where('id', $id)
        ->firstOrFail();
      return response()->json(new SongResource($data));
    });
  }
}
