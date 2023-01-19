<?php

namespace App\Http\Resources;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
  function __construct(MenuItem $model)
  {
    parent::__construct($model);
  }

  public function toArray($request)
  {
    $page = null;
    if ($this->linkable_id) {
      $page = Page::find($this->linkable_id);
    }

    return [
      'id' => $this->id,
      "menu_id" => $this->menu_id,
      "title" => $this->title,
      "url" => $this->url,
      "destination" => $this->destination,
      "new_window" => boolval($this->new_window),
      "class_attribute" => $this->class_attribute,
      "id_attribute" => $this->id_attribute,
      "anchor" => $this->anchor,
      "query_string" => $this->query_string,
      "position" => $this->position,
      "active" => $this->active,
      $this->mergeWhen($page !== null, [
        'page' => $page ? [
          'id' => $page->id,
          'slug' => $page->slug,
          'nested_slug' => $page->getNestedSlug(),
        ] : []
      ]),
    ];
  }
}
