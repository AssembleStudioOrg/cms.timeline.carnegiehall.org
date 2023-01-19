<?php

namespace App\Http\Resources;

use App\Http\Resources\SongResource;
use App\Http\Resources\StoryResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
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
      'default_song' => SongResource::make($this->song),
      'featured_stories' => StoryResourceCollection::make($this->featured_stories),

      'site_name' => $this->site_name,
      'seo_image' => $this->image('seo_image'),
      'stories_index_heading' => $this->stories_index_heading,
      'seo_stories_title' => $this->seo_stories_title,
      'seo_stories_description' => $this->seo_stories_description,
      'seo_stories_image' => $this->image('seo_stories_image'),
      'seo_genres_title' => $this->seo_genres_title,
      'seo_genres_description' => $this->seo_genres_description,
      'seo_genres_image' => $this->image('seo_genres_image'),
      'seo_timeline_title' => $this->seo_timeline_title,
      'seo_timeline_description' => $this->seo_timeline_description,
      'seo_timeline_image' => $this->image('seo_timeline_image'),

      'missing_content' => $this->missing_content,
      'missing_link' => [
        'href' => $this->missing_link_href,
        'label' => $this->missing_link_label,
      ],

      '404_heading' => $this->{'404_heading'},
      '404_cta_message' => $this->{'404_cta_message'},
      '404_cta_relative_link' => $this->{'404_cta_relative_link'},

    ];
  }
}
