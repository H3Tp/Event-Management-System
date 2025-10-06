<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {

        View::composer('organizer.*', function ($view) {
            $view->with('organizerView', true);
        });
          View::composer('organizer1.*', function ($view) {
            $view->with('organizer1View', true);
        });


        if ($this->app->environment('production')) {
            $this->app['request']->server->set('HTTPS','on');
            URL::forceScheme('https');
        }
    }
}
