<?php

namespace App\Console\Commands;

use App\Mail\SendInvalidAppleMusicResource;
use App\Models\AppleMusicCheck;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyInvalidAppleMusicResources extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'ch:notify-invalid-resources';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Notify configured users of invalid Apple Music resource urls';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $notify_email_addresses = [];

    try {
      if (app(SettingRepository::class)->byKey('apple_music_checker_notify_email_address_list')) {
        $notify_email_addresses = array_filter(explode(",", app(SettingRepository::class)->byKey('apple_music_checker_notify_email_address_list')), function ($s) {
          return filter_var($s, FILTER_VALIDATE_EMAIL);
        });
      }
    } catch (\Throwable $th) {
      report($th);
      Log::error('NotifyInvalidAppleMusicResources.handle: An error compiling email address list');
    }

    try {
      $invalidResources = AppleMusicCheck::where('is_song_valid', 0)->orWhere('is_music_video_valid', 0)->get();
      if (count($invalidResources) > 0) {
        Mail::to($notify_email_addresses)->send(new SendInvalidAppleMusicResource($invalidResources));
      } else {
        Log::info('NotifyInvalidAppleMusicResources.handle: No failed checks to notify.');
      }
      return Command::SUCCESS;
    } catch (\Throwable $th) {
      report($th);
      Log::error('NotifyInvalidAppleMusicResources.handle: An error occurred sending email');
    }
  }
}
