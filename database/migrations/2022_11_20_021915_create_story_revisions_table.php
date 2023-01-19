<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoryRevisionsTable extends Migration
{
  public function up()
  {
    Schema::create('story_revisions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer("story_id")->unsigned();
      $table->bigInteger('user_id')->unsigned()->nullable();

      $table->timestamps();
      $table->json('payload');
      $table->foreign("story_id")->references('id')->on("stories")->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on(config('twill.users_table', 'twill_users'))->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::dropIfExists('story_revisions');
  }
}
