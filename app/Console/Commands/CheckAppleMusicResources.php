<?php

namespace App\Console\Commands;

use App\Jobs\CheckAppleMusicMusicVideoStatus;
use App\Jobs\CheckAppleMusicSongStatus;
use App\Models\AppleMusicCheck;
use App\Models\MusicVideo;
use App\Models\Song;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckAppleMusicResources extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'ch:check-resource-urls';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Checks the published Apple Music resource URLs for songs and music videos';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    try {
      AppleMusicCheck::where('is_archived', 0)->update(['is_archived' => 1]);
    } catch (\Throwable $th) {
      report($th);
      Log::error('CheckAppleMusicResources.handle: An error occurred archiving previous Apple Music checks');
    }

    try {
      $songs = Song::published()->get();
      $musicVideos = MusicVideo::published()->get();

      foreach ($songs as $song) {
        CheckAppleMusicSongStatus::dispatch($song);
      }

      foreach ($musicVideos as $musicVideo) {
        CheckAppleMusicMusicVideoStatus::dispatch($musicVideo);
      }

      return Command::SUCCESS;
    } catch (\Throwable $th) {
      report($th);
      Log::error('CheckAppleMusicResources.handle: An error occurred dispatching Apple Music checks');
    }
  }
}
