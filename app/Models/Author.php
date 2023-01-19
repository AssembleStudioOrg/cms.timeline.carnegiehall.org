<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
use App\Models\Story;

class Author extends Model
{
  use HasRelated;
  use HasPosition;
  use HasRevisions;

  protected $fillable = [
    'published',
    'first_name',
    'last_name',
    'bio',
    'short_bio',
    'external_link',
    'position'
  ];

  public $checkboxes = [
    'published'
  ];

  public function getFullNameAttribute()
  {
    return implode(' ', [$this->first_name ?? '', $this->last_name ?? '']);
  }

  public function getTitleAttribute()
  {
    return $this->getFullNameAttribute();
  }

  public function stories()
  {
    return $this->belongsToMany(Story::class, 'story_author', 'author_id');
  }
}
