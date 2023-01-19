<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'more'], function () {
  Route::module('authors');
  Route::module('genres');
  Route::module('instruments');
  Route::module('menus');
  Route::module('musicVideos');
  Route::module('musicalFeatures');
  Route::module('notablePerformers');
  Route::module('pages');
  Route::module('songs');
  Route::module('stories');
  Route::module('themes');

  Route::module('globalFooters');
  Route::get('/globalFooter', 'GlobalFooterController@landing')->name('more.globalFooters.landing');

  Route::module('siteSettings');
  Route::get('/GlobalSettings', 'SiteSettingController@landing')->name('more.siteSettings.landing');
});

Route::module('authors');
Route::module('genres');
Route::module('instruments');
Route::module('menus');
Route::module('musicVideos');
Route::module('musicalFeatures');
Route::module('notablePerformers');
Route::module('pages');
Route::module('songs');
Route::module('stories');
Route::module('themes');

Route::get('deploy', 'DeployController@deploy')->name('deploy');

Route::name('appleMusicStatus')->get('/apple-music-status', 'AppleMusicStatusController@show');

Route::get('run-check-resource-urls', function () {
  Artisan::call('ch:check-resource-urls', []);
  session()->flash('status', 'Periodically reload this page to check for changes');
  return redirect()->route('admin.appleMusicStatus');
});
