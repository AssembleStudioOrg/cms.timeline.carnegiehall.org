<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\NotablePerformer;
use App\Models\Song;
use App\Repositories\Behaviors\HandleBrowser;

class SongRepository extends ModuleRepository
{
  use HandleFiles, HandleBrowser;

  public function __construct(Song $model)
  {
    $this->model = $model;
  }

  public function filter($query, array $scopes = [])
  {
    if (isset($scopes['title'])) {
      $query->orWhere('title', 'like', "%{$scopes['title']}%");
      unset($scopes['title']);
    }

    if (isset($scopes['performer'])) {
      $query->orWhereHas('notable_performer', function ($query) use ($scopes) {
        $query->where('name', 'like', "%{$scopes['performer']}%");
      });
      unset($scopes['performer']);
    }

    return parent::filter($query, $scopes);
  }

  public function afterSave($object, $fields)
  {
    $this->updateBelongsTo($object, $fields, 'notable_performer', NotablePerformer::class);
    parent::afterSave($object, $fields);
  }

  public function getFormFields($object)
  {
    $fields = parent::getFormFields($object);
    $artist = $object->notable_performer;

    if ($artist) {
      $fields['browsers']['notable_performer'][] = [
        'id' => $artist->id,
        'name' => $artist->name,
        'edit' => moduleRoute('notablePerformers', '', 'edit', $artist->id)
      ];
    }

    return $fields;
  }
}
