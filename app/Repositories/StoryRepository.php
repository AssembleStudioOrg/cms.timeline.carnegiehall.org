<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Repositories\Behaviors\HandleBrowser;
use App\Models\Story;

class StoryRepository extends ModuleRepository
{
  use HandleBlocks;
  use HandleBrowser;
  use HandleFiles;
  use HandleMedias;
  use HandleRevisions;
  use HandleSlugs;

  public function __construct(Story $model)
  {
    $this->model = $model;
  }

  public function order($query, array $orders = [])
  {
    $query = $query->ordered();
    return parent::order($query, $orders);
  }

  public function afterSave($object, $fields)
  {
    $this->updateBelongsTo($object, $fields, 'song', Song::class);
    $this->updateBrowser($object, $fields, 'authors');

    parent::afterSave($object, $fields);
  }

  public function getFormFields($object)
  {
    $fields = parent::getFormFields($object);
    $fields['browsers']['authors'] = $this->getFormFieldsForBrowser($object, 'authors', 'more');

    $song = $object->song;

    if ($song) {
      $fields['browsers']['song'][] = [
        'id' => $song->id,
        'name' => $song->title,
        'edit' => moduleRoute('songs', '', 'edit', $song->id)
      ];
    }

    return $fields;
  }
}
