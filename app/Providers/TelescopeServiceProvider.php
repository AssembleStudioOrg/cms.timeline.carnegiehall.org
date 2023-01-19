<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    // Telescope::night();

    $this->hideSensitiveRequestDetails();

    Telescope::filter(function (IncomingEntry $entry) {
      if ($this->app->environment('local')) {
        return true;
      }

      return $entry->isReportableException() ||
        $entry->isFailedRequest() ||
        $entry->isFailedJob() ||
        $entry->isScheduledTask() ||
        $entry->hasMonitoredTag();
    });
  }

  /**
   * Prevent sensitive request details from being logged by Telescope.
   *
   * @return void
   */
  protected function hideSensitiveRequestDetails()
  {
    if ($this->app->environment('local')) {
      return;
    }

    Telescope::hideRequestParameters(['_token']);

    Telescope::hideRequestHeaders([
      'cookie',
      'x-csrf-token',
      'x-xsrf-token',
    ]);
  }

  /**
   * Configure the Telescope authorization services.
   *
   * @return void
   */
  protected function authorization()
  {
    $this->gate();

    Telescope::auth(function ($request) {
      $result = collect(config('auth.guards'))->keys()->reduce(function ($auth, $guard) use ($request) {
        if ($auth) {
          return $auth;
        }

        app('auth')->shouldUse($guard);

        return Gate::check('viewTelescope', [$request->user()]);
      }, app()->environment('local'));

      app('auth')->shouldUse(config('auth.defaults.guard'));

      return $result;
    });
  }

  /**
   * Register the Telescope gate.
   *
   * This gate determines who can access Telescope in non-local environments.
   *
   * @return void
   */
  protected function gate()
  {
    Gate::define('viewTelescope', function ($user) {
      // Just in case if you want to make sure if there's a user. Store that data in laravel.log to check later.
      Log::info($user);
      return in_array($user->email, [
        'simon@generalstudios.com'
      ]);
    });
  }
}
