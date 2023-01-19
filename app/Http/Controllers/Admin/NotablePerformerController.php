<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use Illuminate\Support\Facades\Config;

class NotablePerformerController extends ModuleController
{
  protected $moduleName = 'notablePerformers';

  protected $previewView = 'site.notablePerformer';

  protected $permalinkBase = 'performers';

  protected $perPage = 50;

  protected $titleColumnKey = 'name';

  protected $titleFormKey = 'name';

  protected $indexColumns = [
    'image' => [
      'thumb' => true, // image column
      'variant' => [
        'role' => 'image',
        'crop' => 'default',
      ],
    ],
    'name' => [ // field column
      'title' => 'Name',
      'field' => 'name',
    ],
    'ch_agent_id' => [ // field column
      'title' => 'Agent ID',
      'field' => 'ch_agent_id',
      'sort' => true,
      'visible' => true,
    ],
  ];

  protected $indexOptions = [
    'permalink' => true
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

  protected function formData($request): array
  {
    return [
      'editor' => false
    ];
  }
}
