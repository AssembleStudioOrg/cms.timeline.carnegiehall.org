<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlobalFooter;
use App\Http\Resources\FooterResource;
use Illuminate\Support\Facades\Cache;

class FooterController extends Controller
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
      $data = GlobalFooter::first();
      if ($data) return response()->json(new FooterResource($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('footer', $cacheTTL, function () {
      $data = GlobalFooter::published()
        ->firstOrFail();
      return response()->json(new FooterResource($data));
    });
  }
}
