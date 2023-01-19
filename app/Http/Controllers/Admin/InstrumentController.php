<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class InstrumentController extends ModuleController
{
  protected $moduleName = 'instruments';

  protected $previewView = 'site.instrument';

  protected $perPage = 50;

  protected $indexOptions = [
    'permalink' => false,
    'editInModal' => true
  ];
}
