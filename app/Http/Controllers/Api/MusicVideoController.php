<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicVideoResource;
use App\Http\Resources\MusicVideoResourceCollection;
use App\Models\MusicVideo;
use Illuminate\Support\Facades\Cache;

class MusicVideoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $isDraft = isset(request()->query()['draft']);
    if ($isDraft) {
      $data = MusicVideo::with(['notable_performer'])->paginate(30);
      if ($data) return response()->json(new MusicVideoResourceCollection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    // return Cache::remember('music_videos_index', $cacheTTL, function () {
    $data = MusicVideo::with(['notable_performer'])->published()->paginate(30);
    return response()->json(new MusicVideoResourceCollection($data));
    // });
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $isDraft = isset(request()->query()['draft']);
    if ($isDraft) {
      $data = MusicVideo::with(['notable_performer'])
        ->draft()
        ->where('id', $id)
        ->first();
      if ($data) return response()->json(new MusicVideoResource($data));
    }

    // return Cache::remember('music_video_' . $id, config('cache.expiration'), function () use ($id) {
    $data = MusicVideo::with(['notable_performer'])
      ->published()
      ->where('id', $id)
      ->firstOrFail();
    return response()->json(new MusicVideoResource($data));
    // });
  }
}
