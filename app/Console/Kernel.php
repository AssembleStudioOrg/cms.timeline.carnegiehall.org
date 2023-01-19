<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;

class Kernel extends ConsoleKernel
{
  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');
    require base_path('routes/console.php');
  }

  /**
   * Define the application's command schedule.
   *
   * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    $schedule->command('telescope:prune --hours=168')->weekly();
    $schedule->command('ch:check-resource-urls')->everyFourHours();
    $schedule->command('ch:notify-invalid-resources')->twiceDaily();
    $schedule->command('ch:prune-apple-music-checks')->weekly();
    $schedule->command('horizon:snapshot')->everyFiveMinutes();
  }
}
