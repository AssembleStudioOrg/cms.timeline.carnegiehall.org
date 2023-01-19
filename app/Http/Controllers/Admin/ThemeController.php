<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class ThemeController extends ModuleController
{
  protected $moduleName = 'themes';

  protected $previewView = 'site.theme';

  protected $perPage = 50;

  protected $indexOptions = [
    'permalink' => false,
    'editInModal' => true
  ];
}
