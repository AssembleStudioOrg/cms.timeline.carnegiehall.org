<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorRepository extends ModuleRepository
{
  use HandleRevisions;

  public function __construct(Author $model)
  {
    $this->model = $model;
  }

  public function filter($query, array $scopes = [])
  {
    if (isset($scopes['name'])) {
      $parts = Str::of($scopes['name'])->split('/[\s,]+/');

      foreach ($parts as $part) {
        $query
          ->where('first_name', 'like', '%' . $part . '%')
          ->orWhere('last_name', 'like', '%' . $part . '%');
      }

      return $query;
    }

    return parent::filter($query, $scopes);
  }

  public function order($query, array $orders = [])
  {
    $query = $query->ordered();
    return parent::order($query, $orders);
  }
}
