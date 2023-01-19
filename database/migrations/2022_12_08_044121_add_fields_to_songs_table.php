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
    Schema::table('songs', function (Blueprint $table) {
      $table->json('apple_music_payload')->nullable();
      $table->dateTime('apple_music_data_updated_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('songs', function (Blueprint $table) {
      $table->dropColumn(['apple_music_payload', 'apple_music_data_updated_at']);
    });
  }
};
