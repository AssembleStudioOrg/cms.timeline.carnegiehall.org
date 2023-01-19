<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimelineResourceCollection;
use App\Models\Genre;
use Illuminate\Support\Facades\Cache;

class TimelineController extends Controller
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
      $data = Genre::orderBy('name', 'ASC')->get();
      if ($data) return response()->json(TimelineResourceCollection::collection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('timeline_index', $cacheTTL, function () {
      $data = Genre::published()->orderBy('name', 'ASC')->get();
      return response()->json((new TimelineResourceCollection($data)));
    });
  }
}
