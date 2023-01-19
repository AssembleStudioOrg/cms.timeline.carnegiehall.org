<?php

namespace App\Console\Commands;

use App\Models\AppleMusicCheck;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PruneAppleMusicResourceChecks extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'ch:prune-apple-music-checks';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Prune old Apple Music resource checks';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    try {
      // Prune archived Apple Music checks that are older than 30 days
      $date = \Carbon\Carbon::today()->subDays(30);
      AppleMusicCheck::isArchived()->where('created_at', '>=', $date)->delete();

      return Command::SUCCESS;
    } catch (\Throwable $th) {
      report($th);
      Log::error('CheckAppleMusicResources.handle: An error occurred while pruning archive');
    }
  }
}
