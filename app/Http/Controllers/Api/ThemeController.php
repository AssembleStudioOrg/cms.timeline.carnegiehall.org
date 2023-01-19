<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
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
      $data = Theme::orderBy('title', 'ASC')->get();
      if ($data) return response()->json(ThemeResource::collection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('theme_index', $cacheTTL, function () {
      $data = Theme::published()
        ->orderBy('title', 'ASC')
        ->get();

      return response()->json(ThemeResource::collection($data));
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
      $data = Theme::published()
        ->where('id', $id)
        ->first();
      if ($data) return response()->json(new ThemeResource($data));
    }

    return Cache::remember('theme_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Theme::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new ThemeResource($data));
    });
  }
}
