<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;
use A17\Twill\Repositories\SettingRepository;
use App\Models\Author;
use App\Models\Instrument;
use App\Models\MusicalFeature;
use App\Models\NotablePerformer;
use App\Models\Song;
use App\Models\Story;
use App\Models\Theme;
use Spatie\Url\Url;

class Genre extends Model
{
  use HasSlug;
  use HasMedias;
  use HasFiles;
  use HasBlocks;
  use HasRevisions;

  protected $fillable = [
    'name',
    'hero_caption',
    'hero_credit',
    'hero_credit_link',
    'author_id',
    'year_start',
    'year_finish',
    'tradition',
    'display_date',
    'song_id',
    'citation',
    'published',
    'seo_title',
    'seo_description',
    'seo_keywords',
  ];

  public $slugAttributes = [
    'name',
  ];

  public $checkboxes = [
    'published'
  ];

  public static $TRADITIONS_ENUM = [
    [
      'title' => 'Secular',
      'key' => 'secular',
      'color' => '#8DC0EF', //blue
      'secondary_color' => '#17246D'
    ],
    [
      'title' => 'Sacred',
      'key' => 'sacred',
      'color' => '#EA9AD3', //purple
      'secondary_color' => '#69184F'
    ],
    [
      'title' => 'Secular Instrumental',
      'key' => 'secular-instrumental',
      'color' => '#CF1126', //red
      'secondary_color' => '#CF1126'
    ],
  ];

  public $mediasParams = [
    'hero_image' => [
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

  public function getTitleAttribute()
  {
    return $this->name;
  }

  public function getPreviewUrlAttribute()
  {
    $previewPath = ['api', 'preview'];
    $url = Url::fromString((string) app(SettingRepository::class)->byKey('preview_base_url'));
    return $url->withPath(join('/', [...$previewPath, 'genres', $this->slug]));
  }

  public function authors()
  {
    return $this->belongsToMany(Author::class, 'genre_author', 'genre_id')
      ->withPivot(['position'])
      ->orderBy('pivot_position', 'asc');
  }

  public function song()
  {
    return $this->belongsTo(Song::class);
  }

  public function songs()
  {
    return $this->belongsToMany(Song::class);
  }

  public function influenced()
  {
    return $this->belongsToMany(Genre::class, 'genre_influenced', 'influenced_id');
  }

  public function influences()
  {
    return $this->belongsToMany(Genre::class, 'genre_genre', 'influence_id');
  }

  public function cross_influenced()
  {
    return $this->belongsToMany(Genre::class, 'genre_cross_influenced', 'cross_influenced_id');
  }

  public function cross_influences()
  {
    return $this->belongsToMany(Genre::class, 'genre_cross_genre', 'cross_influence_id');
  }

  public function stories()
  {
    return $this->belongsToMany(Story::class);
  }

  public function notable_performers()
  {
    return $this->belongsToMany(NotablePerformer::class);
  }

  public function instruments()
  {
    return $this->belongsToMany(Instrument::class);
  }

  public function themes()
  {
    return $this->belongsToMany(Theme::class);
  }

  public function musical_features()
  {
    return $this->belongsToMany(MusicalFeature::class);
  }
}
