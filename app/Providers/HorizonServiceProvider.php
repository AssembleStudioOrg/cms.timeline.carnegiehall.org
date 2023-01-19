<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    // Horizon::routeSmsNotificationsTo('15556667777');
    Horizon::routeMailNotificationsTo('simonabetton@gmail.com');
    // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');

    // Horizon::night();
  }

  /**
   * Configure the Telescope authorization services.
   *
   * @return void
   */
  protected function authorization()
  {
    $this->gate();

    Horizon::auth(function ($request) {
      $result = collect(config('auth.guards'))->keys()->reduce(function ($auth, $guard) use ($request) {
        if ($auth) {
          return $auth;
        }

        app('auth')->shouldUse($guard);

        return Gate::check('viewHorizon', [$request->user()]);
      }, app()->environment('local'));

      app('auth')->shouldUse(config('auth.defaults.guard'));

      return $result;
    });
  }

  /**
   * Register the Horizon gate.
   *
   * This gate determines who can access Horizon in non-local environments.
   *
   * @return void
   */
  protected function gate()
  {
    Gate::define('viewHorizon', function ($user) {
      return in_array($user->email, [
        'simon@generalstudios.com'
      ]);
    });
  }
}
