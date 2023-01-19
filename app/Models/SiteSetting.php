<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;
use App\Models\Song;
use App\Models\Story;

class SiteSetting extends Model
{
  use HasMedias;

  protected $fillable = [
    'published',
    'title',
    'site_name',
    'seo_stories_title',
    'seo_stories_description',
    'seo_genres_title',
    'seo_genres_description',
    'seo_timeline_title',
    'seo_timeline_description',
    'song_id',
    'stories_index_heading',
    '404_heading',
    '404_cta_message',
    '404_cta_relative_link',
    'missing_content',
    'missing_link_href',
    'missing_link_label'
  ];

  public $mediasParams = [
    'seo_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ],
    'seo_stories_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ],
    'seo_genres_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ],
    'seo_timeline_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ]
  ];

  public function song()
  {
    return $this->belongsTo(Song::class);
  }

  public function featured_stories()
  {
    return $this->belongsToMany(Story::class, 'featured_stories')->withPivot('story_id')->orderBy('featured_stories.position');
  }
}
