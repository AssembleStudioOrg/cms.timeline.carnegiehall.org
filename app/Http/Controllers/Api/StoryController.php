<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Http\Resources\StoryResourceCollection;
use App\Models\Story;
use Illuminate\Support\Facades\Cache;

class StoryController extends Controller
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
      $data = Story::ordered()->paginate(100);
      if ($data) return response()->json(new StoryResourceCollection($data));
    }

    if ($isApiV2) {
      $cacheTTL = now()->addSeconds(60);

      return Cache::remember('story_index_v2', $cacheTTL, function () {
        $data = Story::published()->ordered()->paginate(100);
        if ($data) return response()->json(new StoryResourceCollection($data));
      });
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('story_index', $cacheTTL, function () {
      $data = Story::published()->ordered()->paginate(10);
      return response()->json(new StoryResourceCollection($data));
    });
  }

  /**
   * Display the specified resource.
   *
   * @param  integer $slug
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $isDraft = str_contains(request()->route()->uri, 'v2') && isset(request()->query()['draft']);
    if ($isDraft) {
      $data = Story::forSlug($slug)->draft()->first();
      if ($data) return response()->json(new StoryResource($data));
    }

    return Cache::remember('story_' . $slug, config('cache.expiration'), function () use ($slug) {
      $data = Story::forSlug($slug)->published()->first();
      if (!$data) return response()->json(['message', 'Entity not found']);
      return response()->json(new StoryResource($data));
    });
  }
}
