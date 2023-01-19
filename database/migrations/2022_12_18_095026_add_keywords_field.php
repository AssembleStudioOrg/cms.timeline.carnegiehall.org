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
    Schema::table('stories', function (Blueprint $table) {
      $table->text('seo_keywords')->nullable();
    });

    Schema::table('pages', function (Blueprint $table) {
      $table->text('seo_keywords')->nullable();
    });

    Schema::table('genres', function (Blueprint $table) {
      $table->text('seo_keywords')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('stories', function (Blueprint $table) {
      $table->dropColumn(['seo_keywords']);
    });

    Schema::table('pages', function (Blueprint $table) {
      $table->dropColumn(['seo_keywords']);
    });

    Schema::table('genres', function (Blueprint $table) {
      $table->dropColumn(['seo_keywords']);
    });
  }
};
