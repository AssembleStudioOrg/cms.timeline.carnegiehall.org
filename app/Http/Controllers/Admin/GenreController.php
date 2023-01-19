<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Models\Genre;
use Illuminate\Support\Facades\Config;

class GenreController extends ModuleController
{
  protected $moduleName = 'genres';

  protected $previewView = 'site.genre';

  protected $perPage = 50;

  protected $titleColumnKey = 'name';

  protected $titleFormKey = 'name';

  protected $indexOptions = [
    'permalink' => true
  ];

  protected $indexColumns = [
    'hero_image' => [
      'thumb' => true, // image column
      'variant' => [
        'role' => 'hero_image',
        'crop' => 'mobile',
      ],
    ],
    'name' => [ // field column
      'title' => 'Title',
      'field' => 'name',
    ],
    'song' => [ // relation column
      'title' => 'Default Song name',
      'relationship' => 'song',
      'field' => 'title'
    ],
    'year_start' => [ // field column
      'title' => 'Year Start',
      'field' => 'year_start',
      'sort' => true,
    ],
    'year_finish' => [ // field column
      'title' => 'Year Finish',
      'field' => 'year_finish',
      'sort' => true,
    ],
  ];

  protected function getPermalinkBaseUrl()
  {
    $appUrl = Config::get('app.website_url');

    if (blank(parse_url($appUrl)['scheme'] ?? null)) {
      $appUrl = $this->request->getScheme() . '://' . $appUrl;
    }

    return $appUrl . '/'
      . ($this->moduleHas('translations') ? '{language}/' : '')
      . ($this->moduleHas('revisions') ? '{preview}/' : '')
      . ($this->permalinkBase ?? $this->getModulePermalinkBase())
      . (isset($this->permalinkBase) && empty($this->permalinkBase) ? '' : '/');
  }

  private function getTraditions()
  {
    $traditions = [];
    foreach (Genre::$TRADITIONS_ENUM as $tradition) {
      $traditions[] = [
        'value' => $tradition['key'],
        'label' => $tradition['title']
      ];
    }
    return $traditions;
  }

  protected function formData($request): array
  {
    return [
      'traditions' => $this->getTraditions()
    ];
  }
}
