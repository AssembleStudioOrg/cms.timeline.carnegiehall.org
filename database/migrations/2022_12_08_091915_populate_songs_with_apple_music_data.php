<?php

use App\Models\Song;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  public function up()
  {
    $songs = Song::all();

    foreach ($songs as $song) {
      if (!isset($song->apple_music_payload) && isset($song->apple_music_song_id)) {
        $song->touch();
        $song->update();
      }
    }
  }

  public function down()
  {
  }
};
