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
    Schema::table('notable_performers', function (Blueprint $table) {
      $table->string('seo_title')->nullable();
      $table->string('seo_description')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('notable_performers', function (Blueprint $table) {
      $table->dropColumns(['seo_title', 'seo_title']);
    });
  }
};
