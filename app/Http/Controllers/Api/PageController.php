<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Http\Resources\PageResourceCollection;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
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
      $data = Page::defaultOrder()->paginate(40)->toTree();
      if ($data) return response()->json(new PageResourceCollection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('pages_index', $cacheTTL, function () {
      $data = Page::published()->defaultOrder()->paginate(40)->toTree();
      return response()->json(new PageResourceCollection($data));
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
      $data = Page::forSlug($slug)->draft()->first();
      if ($data) return response()->json(new PageResource($data));
    }

    return Cache::remember('page_' . $slug, config('cache.expiration'), function () use ($slug) {
      $data = Page::forSlug($slug)->published()->first();
      if (!$data) return response()->json(['message', 'Entity not found']);
      return response()->json(new PageResource($data));
    });
  }
}
