<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstrumentResource;
use App\Models\Instrument;
use Illuminate\Support\Facades\Cache;

class InstrumentController extends Controller
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
      $data = Instrument::orderBy('title', 'ASC')->get();
      if ($data) return response()->json(InstrumentResource::collection($data));
    }

    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('instrument_index', $cacheTTL, function () {
      $data = Instrument::published()
        ->orderBy('title', 'ASC')
        ->get();

      return response()->json(InstrumentResource::collection($data));
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
      $data = Instrument::draft()
        ->where('id', $id)
        ->first();
      if ($data) return response()->json(new InstrumentResource($data));
    }

    return Cache::remember('instrument_' . $id, config('cache.expiration'), function () use ($id) {
      $data = Instrument::published()
        ->where('id', $id)
        ->firstOrFail();

      return response()->json(new InstrumentResource($data));
    });
  }
}
