<?php

namespace App\Models;

use A17\Twill\Models\Model;
use App\Models\Genre;

class Instrument extends Model
{
  protected $fillable = [
    'published',
    'title',
  ];

  public $checkboxes = [
    'published'
  ];

  public function genres()
  {
    return $this->hasMany(Genre::class);
  }
}
