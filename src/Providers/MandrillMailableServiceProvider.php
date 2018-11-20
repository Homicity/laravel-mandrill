<?php

namespace Homicity\MandrillMailable\Providers;

use Homicity\MandrillMailable\MandrillMailer;
use Illuminate\Mail\Mailer;
use Illuminate\Support\ServiceProvider;

class MandrillMailableServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/mandrill.php', 'mandrill');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->offerPublishing();
        }

        $this->app->bind('mandrill.message', function ($app) {
            $mandrill = new \Mandrill(config('mandrill.api_secret'));

            return $mandrill->messages;
        });

        Mailer::macro('mandrill', function () {
           return new MandrillMailer();
        });
    }

    /**
     * Setup the resource publishing groups.
     */
    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../../config/mandrill.php' => config_path('mandrill.php'),
        ], 'mandrill');
    }
}
