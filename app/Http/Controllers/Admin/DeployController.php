<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Repositories\SettingRepository;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DeployController extends Controller
{
  public function deploy()
  {
    if (app(SettingRepository::class)->byKey('vercel_webhook_url')) {
      $webhook_url = app(SettingRepository::class)->byKey('vercel_webhook_url');
    } else if (!empty(config('deployment.webhook_url'))) {
      $webhook_url = config('deployment.webhook_url');
    }

    if (!isset($webhook_url)) {
      session()->flash('status', 'Vercel webhook not configured');
      return redirect()->route('admin.dashboard');
    }

    try {
      $client = new Client();
      $client->post(app(SettingRepository::class)->byKey('vercel_webhook_url') ?? config('deployment.webhook_url'));
      session()->flash('status', 'Successfully started build and deployment on Vercel');
      return redirect()->route('admin.dashboard');
    } catch (\Throwable $th) {
      report($th);
      Log::error('Error triggering Vercel build and deployment', [
        'webhook_url' => $webhook_url
      ]);

      session()->flash('status', '!! Error triggering Vercel build and deployment !!');
      return redirect()->route('admin.dashboard');
    }
  }
}
