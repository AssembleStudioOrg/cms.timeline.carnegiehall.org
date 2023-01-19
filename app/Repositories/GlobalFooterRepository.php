<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\GlobalFooter;

class GlobalFooterRepository extends ModuleRepository
{
  use HandleBlocks, HandleMedias;

  public function __construct(GlobalFooter $model)
  {
    $this->model = $model;
  }

  public function getGlobalFooter()
  {
    if (filled($entry = $this->theOnlyOne())) {
      return $entry;
    }

    return $this->generate();
  }

  private function theOnlyOne()
  {
    return $this->model
      ->newQuery()
      ->withoutGlobalScope(MustBePublished::class)
      ->orderBy('id')
      ->take(1)
      ->get()
      ->first();
  }

  private function generate()
  {
    return app(GlobalFooterRepository::class)->create([
      'title' => 'Global Footer',
      'published' => true,
    ]);
  }
}
