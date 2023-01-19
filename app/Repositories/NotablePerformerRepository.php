<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\NotablePerformer;

class NotablePerformerRepository extends ModuleRepository
{
  use HandleSlugs;
  use HandleMedias;

  public function __construct(NotablePerformer $model)
  {
    $this->model = $model;
  }
}
