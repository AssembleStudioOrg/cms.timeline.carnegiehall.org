<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use A17\Twill\Repositories\SettingRepository;
use Spatie\Url\Url;

class Page extends Model implements Sortable
{
  use HasBlocks, HasSlug, HasMedias, HasFiles, HasRevisions, HasPosition, HasNesting;

  protected $fillable = [
    'published',
    'title',
    'description',
    'position',
    'seo_title',
    'seo_description',
    'seo_keywords',
  ];

  public $slugAttributes = [
    'title',
  ];

  public $mediasParams = [
    'seo_image' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ]
  ];

  public function getPreviewUrlAttribute()
  {
    $previewPath = ['api', 'preview'];
    $url = Url::fromString((string) app(SettingRepository::class)->byKey('preview_base_url'));
    return $url->withPath(join('/', [...$previewPath, $this->slug]));
  }
}
