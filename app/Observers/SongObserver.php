<?php

namespace App\Observers;

use App\Models\Song;
use Illuminate\Support\Facades\Log;
use PouleR\AppleMusicAPI\APIClient;
use PouleR\AppleMusicAPI\AppleMusicAPI;
use Symfony\Component\HttpClient\CurlHttpClient;

class SongObserver
{
  /**
   * Handle events after all transactions are committed.
   *
   * @var bool
   */
  public $afterCommit = true;

  /**
   * Handle the Song "created" event.
   *
   * @param  \App\Models\Song  $song
   * @return void
   */
  public function created(Song $song)
  {
    $this->storeAppleMusicSongData($song);
  }

  /**
   * Handle the Song "updated" event.
   *
   * @param  \App\Models\Song  $song
   * @return void
   */
  public function updated(Song $song)
  {
    $this->storeAppleMusicSongData($song);
  }

  private function storeAppleMusicSongData(Song $song)
  {
    if (!isset($song->apple_music_song_id)) return $song;

    try {
      $curl = new CurlHttpClient(['max_duration' => 5]);
      $client = new APIClient($curl);
      $client->setDeveloperToken(config('apple-music.developer_token'));
      $api = new AppleMusicAPI($client);
      $result = $api->getCatalogSong('us', $song->apple_music_song_id);

      $song->apple_music_payload = $result;
      $song->apple_music_data_updated_at = now();
      $song->saveQuietly(); // because we don't want to get into an update loop

      return $song;
    } catch (\Throwable $th) {
      report($th);
      Log::warning('SongObserver.storeAppleMusicSongData: Song failed to be fetched from Apple Music', ['song' => $song]);
      return $song;
    }
  }
}
