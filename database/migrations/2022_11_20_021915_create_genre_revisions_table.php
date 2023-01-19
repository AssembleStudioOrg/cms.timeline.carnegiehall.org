<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenreRevisionsTable extends Migration
{
  public function up()
  {

    Schema::create('genre_revisions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer("genre_id")->unsigned();
      $table->bigInteger('user_id')->unsigned()->nullable();

      $table->timestamps();
      $table->json('payload');
      $table->foreign("genre_id")->references('id')->on("genres")->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on(config('twill.users_table', 'twill_users'))->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::dropIfExists('genre_revisions');
  }
}
