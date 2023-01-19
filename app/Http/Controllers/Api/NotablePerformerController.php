<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotablePerformerResource;
use App\Models\NotablePerformer;
use Illuminate\Support\Facades\Cache;

class NotablePerformerController extends Controller
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
      $data = NotablePerformer::get();
      if ($data) return response()->json(NotablePerformerResource::collection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('notable_performer_index', $cacheTTL, function () {
      $data = NotablePerformer::published()->get();
      return response()->json(NotablePerformerResource::collection($data));
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
      $data = NotablePerformer::forSlug($slug)->draft()->first();
      if ($data) return response()->json(new NotablePerformerResource($data));
    }

    return Cache::remember('notable_performer_' . $slug, config('cache.expiration'), function () use ($slug) {
      $data = NotablePerformer::forSlug($slug)->published()->firstOrFail();
      return response()->json(new NotablePerformerResource($data));
    });
  }
}
