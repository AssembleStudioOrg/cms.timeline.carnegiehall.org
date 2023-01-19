<?php

namespace App\Observers;

use App\Models\MusicVideo;
use Illuminate\Support\Facades\Log;
use PouleR\AppleMusicAPI\APIClient;
use Symfony\Component\HttpClient\CurlHttpClient;

class MusicVideoObserver
{
  /**
   * Handle events after all transactions are committed.
   *
   * @var bool
   */
  public $afterCommit = true;

  /**
   * Handle the MusicVideo "created" event.
   *
   * @param  \App\Models\MusicVideo  $musicVideo
   * @return void
   */
  public function created(MusicVideo $musicVideo)
  {
    $this->storeAppleMusicVideoData($musicVideo);
  }

  /**
   * Handle the MusicVideo "updated" event.
   *
   * @param  \App\Models\MusicVideo  $musicVideo
   * @return void
   */
  public function updated(MusicVideo $musicVideo)
  {
    $this->storeAppleMusicVideoData($musicVideo);
  }

  private function storeAppleMusicVideoData(MusicVideo $musicVideo)
  {
    if (!isset($musicVideo->apple_music_video_id)) return $musicVideo;

    try {
      $curl = new CurlHttpClient(['max_duration' => 5]);
      $client = new APIClient($curl);
      $client->setDeveloperToken(config('apple-music.developer_token'));
      $requestUrl = sprintf(
        'catalog/%s/music-videos/%s',
        'us',
        $musicVideo->apple_music_video_id,
      );
      $result = $client->apiRequest('GET', $requestUrl);

      $musicVideo->apple_music_video_payload = $result;
      $musicVideo->apple_music_video_data_updated_at = now();
      $musicVideo->saveQuietly(); // because we don't want to get into an update loop

      return $musicVideo;
    } catch (\Throwable $th) {
      report($th);
      Log::warning('MusicVideoObserver.storeAppleMusicVideoData: Music video failed to be fetched from Apple Music', ['musicVideo' => $musicVideo]);
      return $musicVideo;
    }
  }
}
