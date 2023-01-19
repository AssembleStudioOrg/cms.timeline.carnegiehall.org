<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Http\Resources\SiteSettingResource;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
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
      $data = SiteSetting::draft()->first();
      if ($data) return response()->json(new SiteSettingResource($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('site-settings', $cacheTTL, function () {
      $data = SiteSetting::published()
        ->firstOrFail();

      return response()->json(new SiteSettingResource($data));
    });
  }
}
