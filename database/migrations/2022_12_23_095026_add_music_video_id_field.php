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
    Schema::table('apple_music_checks', function (Blueprint $table) {
      $table->integer("song_id")->unsigned()->nullable()->change();
      $table->integer("music_video_id")->unsigned()->nullable();
      $table->foreign("music_video_id")->references('id')->on("music_videos")->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('apple_music_checks', function (Blueprint $table) {
      $table->dropForeign(['music_video_id']);
      $table->dropColumn(['music_video_id']);
    });
  }
};
