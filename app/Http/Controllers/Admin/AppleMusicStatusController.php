<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\Controller;
use App\Models\AppleMusicCheck;
use Laravel\Horizon\Contracts\JobRepository;

class AppleMusicStatusController extends Controller
{
  public function show()
  {
    $invalidResources = AppleMusicCheck::where('is_song_valid', 0)->orWhere('is_music_video_valid', 0)->get();
    $isJobRunning = (bool) app(JobRepository::class)->countPending();
    return view('admin.appleMusicStatus.index', ['appleMusicChecks' => $invalidResources, 'isJobRunning' => $isJobRunning]);
  }
}
