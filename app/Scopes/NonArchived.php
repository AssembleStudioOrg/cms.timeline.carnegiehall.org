<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class NonArchived implements Scope
{
  public function apply(Builder $builder, Model $model)
  {
    return $builder->where('is_archived', 0);
  }
}
