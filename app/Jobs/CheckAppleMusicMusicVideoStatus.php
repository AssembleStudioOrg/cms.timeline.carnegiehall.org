<?php

namespace App\Jobs;

use App\Models\AppleMusicCheck;
use App\Models\MusicVideo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckAppleMusicMusicVideoStatus implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * The music video instance.
   *
   * @var \App\Models\MusicVideo
   */
  public $musicVideo;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(MusicVideo $musicVideo)
  {
    $this->musicVideo = $musicVideo;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    if (!isset($this->musicVideo->apple_music_preview_video_url)) {
      return;
    }

    $appleMusicCheck = new AppleMusicCheck();
    $appleMusicCheck->music_video_id = $this->musicVideo->id;
    $appleMusicCheck->is_music_video_valid = boolval($this->urlExists($this->musicVideo->apple_music_preview_video_url));
    $appleMusicCheck->save();
  }

  private function urlExists($url)
  {
    try {
      return (bool) in_array("HTTP/1.1 200 OK", @get_headers($url));
    } catch (\Throwable $th) {
      report($th);
      Log::error('CheckAppleMusicMusicVideoStatus.urlExists: Error getting headers of resource', ['url' => $url]);
      return false;
    }
  }
}
