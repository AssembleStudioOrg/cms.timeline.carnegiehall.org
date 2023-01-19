<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;
use Illuminate\Support\Facades\DB;

class NotablePerformer extends Model
{
  use HasSlug;
  use HasMedias;

  protected $fillable = [
    'published',
    'name',
    'attribution',
    'ch_agent_id',
    'show_in_menu',
    'seo_title',
    'seo_description',
    'seo_keywords'
  ];

  public $checkboxes = [
    'published'
  ];

  public $mediasParams = [
    'image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ],
      'mobile' => [
        [
          'name' => 'mobile',
          'ratio' => 1,
        ],
      ],
    ],
    'seo_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ]
  ];

  protected $browserColumns = [
    'title' => [
      'title' => 'Title',
      'field' => 'title',
    ],
  ];

  public $slugAttributes = [
    'name'
  ];

  public function getTitleAttribute()
  {
    return $this->name;
  }

  /**
   * This is a duplicate of the method on HasSlug.
   */
  public function getExistingSlug($slugParams)
  {
    $query = DB::table($this->getSlugsTable())->where($this->getForeignKey(), $this->id);
    unset($slugParams['active']);

    foreach ($slugParams as $key => $value) {
      //check variations of the slug
      if ($key == 'slug') {
        $query->where(function ($query) use ($value) {
          $query->orWhere('slug', $value);
          $query->orWhere('slug', $value . '-' . $this->getSuffixSlug());
        });
      } else {
        $query->where($key, $value);
      }
    }

    return $query->first();
  }

  public function songs()
  {
    return $this->hasMany(Song::class);
  }
}
