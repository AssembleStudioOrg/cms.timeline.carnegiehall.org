<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicalFeatureResource;
use App\Models\MusicalFeature;
use Illuminate\Support\Facades\Cache;

class MusicalFeatureController extends Controller
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
      $data = MusicalFeature::orderBy('title', 'ASC')->get();
      if ($data) return response()->json(MusicalFeatureResource::collection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('musical_feature_index', $cacheTTL, function () {
      $data = MusicalFeature::published()
        ->orderBy('title', 'ASC')
        ->get();

      return response()->json(MusicalFeatureResource::collection($data));
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
      $data = MusicalFeature::draft()
        ->where('id', $id)
        ->first();
      if ($data) return response()->json(new MusicalFeatureResource($data));
    }

    return Cache::remember('musical_feature_' . $id, config('cache.expiration'), function () use ($id) {
      $data = MusicalFeature::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new MusicalFeatureResource($data));
    });
  }
}
