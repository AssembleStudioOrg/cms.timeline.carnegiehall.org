<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SongResourceCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    if (get_class($this->resource) === 'Illuminate\Pagination\LengthAwarePaginator' && !str_contains($request->route()->uri, 'v2')) {
      return [
        'count' => $this->count(),
        'total' => $this->total(),
        'prev'  => $this->previousPageUrl(),
        'next'  => $this->nextPageUrl(),
        'data' => $this->collection
      ];
    }

    return [
      'data' => $this->collection
    ];
  }
}
