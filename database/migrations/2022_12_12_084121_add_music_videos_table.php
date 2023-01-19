<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('music_videos', function (Blueprint $table) {
      $table->increments('id');
      $table->softDeletes();
      $table->timestamps();
      $table->boolean('published')->default(false);
      $table->string('title')->nullable();
      $table->unsignedInteger('notable_performer_id')->nullable()->index('songs_notable_performer_id_foreign');
      $table->string('apple_music_video_id')->nullable();
      $table->json('apple_music_video_payload')->nullable();
      $table->dateTime('apple_music_video_data_updated_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('music_videos');
  }
};
