<?php

use Illuminate\Support\Facades\Route;

Route::middleware('cache.headers:public;max_age=300;etag')->group(function () {
  Route::get('footer', 'App\Http\Controllers\Api\FooterController@index');
  Route::get('site-settings', 'App\Http\Controllers\Api\SiteSettingController@index');

  Route::apiResources([
    'authors' => 'App\Http\Controllers\Api\AuthorController',
    'genres' => 'App\Http\Controllers\Api\GenreController',
    'instruments' => 'App\Http\Controllers\Api\InstrumentController',
    'musical-features' => 'App\Http\Controllers\Api\MusicalFeatureController',
    'notable-performers' => 'App\Http\Controllers\Api\NotablePerformerController',
    'songs' => 'App\Http\Controllers\Api\SongController',
    'stories' => 'App\Http\Controllers\Api\StoryController',
    'themes' => 'App\Http\Controllers\Api\ThemeController',
    'timeline' => 'App\Http\Controllers\Api\TimelineController'
  ], ['only' => ['index', 'show']]);

  Route::group(['prefix' => 'v2'], function () {
    Route::apiResources([
      'authors' => 'App\Http\Controllers\Api\AuthorController',
      'genres' => 'App\Http\Controllers\Api\GenreController',
      'instruments' => 'App\Http\Controllers\Api\InstrumentController',
      'menus' => 'App\Http\Controllers\Api\MenuController',
      'music-videos' => 'App\Http\Controllers\Api\MusicVideoController',
      'musical-features' => 'App\Http\Controllers\Api\MusicalFeatureController',
      'notable-performers' => 'App\Http\Controllers\Api\NotablePerformerController',
      'pages' => 'App\Http\Controllers\Api\PageController',
      'songs' => 'App\Http\Controllers\Api\SongController',
      'stories' => 'App\Http\Controllers\Api\StoryController',
      'themes' => 'App\Http\Controllers\Api\ThemeController',
      'timeline' => 'App\Http\Controllers\Api\TimelineController',
    ], ['only' => ['index', 'show']]);
  });
});
