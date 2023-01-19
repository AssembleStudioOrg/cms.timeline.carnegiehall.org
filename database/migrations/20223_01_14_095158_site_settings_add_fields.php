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
    Schema::table('site_settings', function (Blueprint $table) {
      $table->text('missing_content')->nullable();
      $table->string('missing_link_href', 255)->nullable();
      $table->string('missing_link_label', 255)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('site_settings', function (Blueprint $table) {
      $table->dropColumn(['missing_content', 'missing_link_href', 'missing_link_label']);
    });
  }
};
