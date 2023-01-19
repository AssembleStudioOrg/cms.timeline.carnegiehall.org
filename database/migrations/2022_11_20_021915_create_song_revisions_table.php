<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSongRevisionsTable extends Migration
{
  public function up()
  {
    Schema::create('song_revisions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer("song_id")->unsigned();
      $table->bigInteger('user_id')->unsigned()->nullable();

      $table->timestamps();
      $table->json('payload');
      $table->foreign("song_id")->references('id')->on("songs")->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on(config('twill.users_table', 'twill_users'))->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::dropIfExists('song_revisions');
  }
}
