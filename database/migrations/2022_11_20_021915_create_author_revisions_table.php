<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthorRevisionsTable extends Migration
{
  public function up()
  {
    Schema::create('author_revisions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger("author_id")->unsigned();
      $table->bigInteger('user_id')->unsigned()->nullable();

      $table->timestamps();
      $table->json('payload');
      $table->foreign("author_id")->references('id')->on("authors")->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on(config('twill.users_table', 'twill_users'))->onDelete('set null');
    });
  }

  public function down()
  {
    Schema::dropIfExists('author_revisions');
  }
}
