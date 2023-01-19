<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('apple_music_checks', function (Blueprint $table) {
      $table->increments('id');
      $table->boolean('is_song_valid')->nullable();
      $table->boolean('is_music_video_valid')->nullable();
      $table->integer("song_id")->unsigned();
      $table->foreign("song_id")->references('id')->on("songs")->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('apple_music_checks');
  }
};
