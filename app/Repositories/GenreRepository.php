<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Genre;
use App\Models\Song;
use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRepeaters;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use App\Repositories\Behaviors\HandleBrowser;

class GenreRepository extends ModuleRepository
{
  use HandleSlugs;
  use HandleMedias;
  use HandleRepeaters;
  use HandleFiles;
  use HandleBrowser;
  use HandleBlocks;
  use HandleRevisions;

  public function __construct(Genre $model)
  {
    $this->model = $model;
  }

  public function afterSave($object, $fields)
  {
    $this->updateBrowser($object, $fields, 'authors');
    $this->updateBelongsTo($object, $fields, 'song', Song::class);
    $this->updateBrowser($object, $fields, 'songs');
    $this->updateBrowser($object, $fields, 'influences');
    $this->updateBrowser($object, $fields, 'influenced');
    $this->updateBrowser($object, $fields, 'cross_influences');
    $this->updateBrowser($object, $fields, 'cross_influenced');
    $this->updateBrowser($object, $fields, 'stories');
    $this->updateBrowser($object, $fields, 'notable_performers');
    $this->updateBrowser($object, $fields, 'instruments');
    $this->updateBrowser($object, $fields, 'themes');
    $this->updateBrowser($object, $fields, 'musical_features');
    parent::afterSave($object, $fields);
  }

  public function getFormFields($object)
  {
    $fields = parent::getFormFields($object);
    $fields['browsers']['notable_performers'] = $this->getFormFieldsForBrowser($object, 'notable_performers', null, 'name');
    $fields['browsers']['songs'] = $this->getFormFieldsForBrowser($object, 'songs');
    $fields['browsers']['stories'] = $this->getFormFieldsForBrowser($object, 'stories');
    $fields['browsers']['instruments'] = $this->getFormFieldsForBrowser($object, 'instruments', 'more');
    $fields['browsers']['themes'] = $this->getFormFieldsForBrowser($object, 'themes', 'more');
    $fields['browsers']['musical_features'] = $this->getFormFieldsForBrowser($object, 'musical_features', 'more');
    $fields['browsers']['authors'] = $this->getFormFieldsForBrowser($object, 'authors', 'more');

    $fields['browsers']['influences'] = $object->influences->map(function ($relatedElement) {
      return [
        'id' => $relatedElement->id,
        'name' => $relatedElement->name,
        'edit' => moduleRoute('genres', '', 'edit', $relatedElement->id)
      ];
    });

    $fields['browsers']['influenced'] = $object->influenced->map(function ($relatedElement) {
      return [
        'id' => $relatedElement->id,
        'name' => $relatedElement->name,
        'edit' => moduleRoute('genres', '', 'edit', $relatedElement->id)
      ];
    });

    $fields['browsers']['cross_influences'] = $object->cross_influences->map(function ($relatedElement) {
      return [
        'id' => $relatedElement->id,
        'name' => $relatedElement->name,
        'edit' => moduleRoute('genres', '', 'edit', $relatedElement->id)
      ];
    });

    $fields['browsers']['cross_influenced'] = $object->cross_influenced->map(function ($relatedElement) {
      return [
        'id' => $relatedElement->id,
        'name' => $relatedElement->name,
        'edit' => moduleRoute('genres', '', 'edit', $relatedElement->id)
      ];
    });

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
