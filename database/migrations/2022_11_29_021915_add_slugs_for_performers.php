<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSlugsForPerformers extends Migration
{
  public function up()
  {
    Schema::create('notable_performers_slugs', function (Blueprint $table) {
      $tableNameSingular = 'notable_performer';
      $tableNamePlural = 'notable_performers';

      $table->increments('id');
      $table->integer("{$tableNameSingular}_id")->unsigned();

      $table->softDeletes();
      $table->timestamps();
      $table->string('slug');
      $table->string('locale', 7)->index();
      $table->boolean('active');
      $table->foreign("{$tableNameSingular}_id", "fk_{$tableNameSingular}_slugs_{$tableNameSingular}_id")->references('id')->on($tableNamePlural)->onDelete('CASCADE')->onUpdate('NO ACTION');
    });
  }

  public function down()
  {
    Schema::dropIfExists('notable_performers_slugs');
  }
}
