<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;
use A17\Twill\Repositories\SettingRepository;
use App\Models\Author;
use App\Models\Song;
use Illuminate\Support\Facades\DB;
use Spatie\Url\Url;

class Story extends Model
{
  use HasSlug;
  use HasMedias;
  use HasBlocks;
  use HasFiles;
  use HasPosition;
  use HasRevisions;

  protected $fillable = [
    'title',
    'published',
    'year_start',
    'year_finish',
    'hero_image_attribution',
    'position',
    'song_id',
    'author_id',
    'color',
    'citation',
    'seo_title',
    'seo_description',
    'seo_keywords',
  ];

  public $slugAttributes = [
    'title'
  ];

  public $checkboxes = [
    'published'
  ];

  public $mediasParams = [
    'hero_image' => [
      'default' => [
        [
          'name' => 'default'
        ],
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

  public $filesParams = ['video'];

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

  public function getPreviewUrlAttribute()
  {
    $previewPath = ['api', 'preview'];
    $url = Url::fromString((string) app(SettingRepository::class)->byKey('preview_base_url'));
    return $url->withPath(join('/', [...$previewPath, 'stories', $this->slug]));
  }

  public function genres()
  {
    return $this->belongsToMany(Genre::class);
  }

  public function authors()
  {
    return $this->belongsToMany(Author::class, 'story_author', 'story_id')
      ->withPivot(['position'])
      ->orderBy('pivot_position', 'asc');
  }

  public function song()
  {
    return $this->belongsTo(Song::class);
  }
}
