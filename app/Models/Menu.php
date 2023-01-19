<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Menu extends Model implements Sortable
{
  use HasTranslation;
  use HasSlug;
  use HasRevisions;
  use HasPosition;

  protected $fillable = [
    'published',
    'title',
    'position',
  ];

  public $translatedAttributes = [
    'title',
    'active',
  ];

  public $slugAttributes = [
    'title',
  ];

  public function menu_items()
  {
    return $this->hasMany(MenuItem::class)->ordered();
  }

  // Menus are considered published by default
  public function getPublishedAttribute()
  {
    return true;
  }

  // Published by default, so remove any possibility of controlling the publish status
  public function getCanPublishAttribute()
  {
    return false;
  }
}
