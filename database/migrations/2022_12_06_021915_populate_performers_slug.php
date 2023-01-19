<?php

use App\Models\NotablePerformer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class PopulatePerformersSlug extends Migration
{
  public function up()
  {
    $performers = NotablePerformer::all();

    foreach ($performers as $performer) {
      if (!$performer->getSlug()) {
        $performer->setSlugs();
      }
    }
  }

  public function down()
  {
  }
}
