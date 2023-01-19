<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class SongController extends ModuleController
{
  protected $moduleName = 'songs';

  protected $previewView = 'site.song';

  protected $perPage = 50;

  protected $defaultFilters = ['search' => 'title|performer|search'];

  protected $indexOptions = [
    'permalink' => false,
  ];

  protected $indexColumns = [
    'hero' => [
      'thumb' => true, // image column
    ],
    'title' => [ // field column
      'title' => 'Title',
      'field' => 'title',
    ],
    'notable_performer' => [ // relation column
      'title' => 'Related Performer',
      'relationship' => 'notable_performer',
      'field' => 'name',
      'visible' => true,
    ],
    'apple_music_artist_name' => [ // field column
      'title' => 'Apple Music Artist name',
      'field' => 'apple_music_artist_name',
      'visible' => true,
    ],
    'apple_music_song_name' => [ // field column
      'title' => 'Apple Music Song name',
      'field' => 'apple_music_song_name',
      'visible' => true,
    ],
    'id' => [ // field column
      'title' => 'ID',
      'field' => 'id',
    ],
  ];

  /*
  * Columns of the browser view for this module when browsed from another module
  * using a browser form field
  */
  protected $browserColumns = [
    'title' => [
      'title' => 'Title',
      'field' => 'title',
    ]
  ];

  protected function formData($request): array
  {
    return [
      'editor' => false,
    ];
  }
}
