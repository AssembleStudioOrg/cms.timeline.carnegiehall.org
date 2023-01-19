<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class MusicalFeatureController extends ModuleController
{
  protected $moduleName = 'musicalFeatures';

  protected $previewView = 'site.musicalFeatures';

  protected $perPage = 50;

  protected $indexOptions = [
    'permalink' => false,
    'editInModal' => true
  ];
}
