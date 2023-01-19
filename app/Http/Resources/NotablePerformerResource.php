<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotablePerformerResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'slug' => $this->slug,
      'name' => $this->name,
      'image' => $this->image('image'),
      'attribution' => $this->attribution,
      'ch_agent_id' => $this->ch_agent_id,
      'show_in_menu' => boolval($this->show_in_menu),
      // 'songs' => SongResource::collection($this->songs), Not needed. See: https://simonbetton.slack.com/archives/C04BF3UFYN9/p1673223811689739
      'seo' => [
        'title' => $this->seo_title,
        'description' => $this->seo_description,
        'keywords' => $this->seo_keywords ?? null,
        'image' => $this->image('seo_image')
      ]
    ];
  }
}
