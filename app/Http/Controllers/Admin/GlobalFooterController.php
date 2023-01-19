<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Repositories\GlobalFooterRepository;

class GlobalFooterController extends ModuleController
{
  protected $moduleName = 'globalFooters';

  protected $defaultIndexOptions = [
    'create' => true,
    'edit' => true,
    'publish' => true,
    'bulkPublish' => true,
    'feature' => false,
    'bulkFeature' => false,
    'restore' => true,
    'bulkRestore' => true,
    'forceDelete' => true,
    'bulkForceDelete' => true,
    'delete' => true,
    'duplicate' => false,
    'bulkDelete' => true,
    'reorder' => false,
    'permalink' => false,
    'bulkEdit' => false,
    'editInModal' => false,
    'skipCreateModal' => false,
  ];

  public function landing(GlobalFooterRepository $entries)
  {
    return view(
      $this->getViewPrefix() . '.form',
      $this->form($entries->getGlobalFooter()->id),
    );
  }

  protected function formData($request): array
  {
    return [
      'editor' => false,
    ];
  }
}
