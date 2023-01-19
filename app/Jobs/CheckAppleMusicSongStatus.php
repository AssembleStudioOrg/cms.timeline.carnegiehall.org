<?php

namespace App\Jobs;

use App\Models\AppleMusicCheck;
use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckAppleMusicSongStatus implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * The song instance.
   *
   * @var \App\Models\Song
   */
  public $song;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(Song $song)
  {
    $this->song = $song;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    if (!isset($this->song->apple_music_preview_song_url)) {
      return;
    }

    $appleMusicCheck = new AppleMusicCheck();
    $appleMusicCheck->song_id = $this->song->id;
    $appleMusicCheck->is_song_valid = boolval($this->urlExists($this->song->apple_music_preview_song_url));
    $appleMusicCheck->save();
  }

  private function urlExists($url)
  {
    try {
      return (bool) in_array("HTTP/1.1 200 OK", @get_headers($url));
    } catch (\Throwable $th) {
      report($th);
      Log::error('CheckAppleMusicSongStatus.urlExists: Error getting headers of resource', ['url' => $url]);
      return false;
    }
  }
}
