<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Http\Resources\MenuResourceCollection;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('menus_index', $cacheTTL, function () {
      $data = Menu::published()->get();
      return response()->json((new MenuResourceCollection($data)));
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
    $cacheTTL = now()->addSeconds(60);

    return Cache::remember('menu_' . $id, $cacheTTL, function () use ($id) {
      $data = Menu::where('id', $id)->published()->firstOrFail();
      return response()->json(new MenuResource($data));
    });
  }
}
