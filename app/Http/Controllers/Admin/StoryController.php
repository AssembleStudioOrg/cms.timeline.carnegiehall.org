<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use Illuminate\Support\Facades\Config;

class StoryController extends ModuleController
{
  protected $moduleName = 'stories';

  protected $previewView = 'site.story';

  protected $perPage = 50;

  protected $indexOptions = [
    'permalink' => true,
    'reorder' => true
  ];

  protected $indexColumns = [
    'image' => [
      'thumb' => true, // image column
      'variant' => [
        'role' => 'hero_image',
        'crop' => 'mobile',
      ],
    ],
    'title' => [ // field column
      'title' => 'Title',
      'field' => 'title',
    ],
    'song' => [ // relation column
      'title' => 'Default Song name',
      'relationship' => 'song',
      'field' => 'title'
    ],
    'position' => [ // field column
      'title' => 'Story Number',
      'field' => 'position',
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
}
