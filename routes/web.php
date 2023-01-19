<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect()->route('admin.dashboard');
});

Route::get('/', fn () => print(''))->name('front.home');
Route::get('/story', fn () => print(''))->name('front.story');
Route::get('/author', fn () => print(''))->name('front.author');
Route::get('/song', fn () => print(''))->name('front.song');
Route::get('/notable-performer', fn () => print(''))->name('front.notablePerformer');
