<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
  public function up()
  {
    Schema::table('twill_users', function (Blueprint $table) {
      $table->bigInteger('id')->unsigned()->change();
    });
  }

  public function down()
  {
  }
};
