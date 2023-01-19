<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
  function __construct(Menu $model)
  {
    parent::__construct($model);
  }

  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'title' => $this->position,
      'active' => $this->active,
      'items' => MenuItemResource::collection($this->menu_items)
    ];
  }
}
