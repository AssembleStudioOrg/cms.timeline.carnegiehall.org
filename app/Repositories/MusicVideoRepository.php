<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\ModuleRepository;
use App\Repositories\Behaviors\HandleBrowser;
use App\Models\NotablePerformer;
use App\Models\MusicVideo;

class MusicVideoRepository extends ModuleRepository
{
  use HandleFiles;
  use HandleBrowser;

  public function __construct(MusicVideo $model)
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
        'edit' => moduleRoute('notable_performers', '', 'edit', $artist->id)
      ];
    }

    return $fields;
  }
}
