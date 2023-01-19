<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Song;
use App\Models\SiteSetting;
use App\Repositories\Behaviors\HandleBrowser;

class SiteSettingRepository extends ModuleRepository
{
  use HandleMedias;
  use HandleBrowser;

  public function __construct(SiteSetting $model)
  {
    $this->model = $model;
  }

  public function getSiteSettings()
  {
    if (filled($entry = $this->theOnlyOne())) {
      return $entry;
    }

    return $this->generate();
  }

  public function afterSave($object, $fields)
  {
    $this->updateBelongsTo($object, $fields, 'song', Song::class);
    $this->updateBrowser($object, $fields, 'featured_stories');
    parent::afterSave($object, $fields);
  }

  public function getFormFields($object)
  {
    $fields = parent::getFormFields($object);
    $fields['browsers']['featured_stories'] = $this->getFormFieldsForBrowser($object, 'featured_stories', null, 'title', 'stories');

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
    return app(SiteSettingRepository::class)->create([
      'title' => "Global Site Settings",
      'published' => true,
    ]);
  }
}
