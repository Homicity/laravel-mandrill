<?php

namespace Homicity\MandrillMailable\Providers;

use Homicity\MandrillMailable\MandrillMailer;
use Illuminate\Mail\Mailer;
use Illuminate\Support\ServiceProvider;

class MandrillMailableServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/mandrill.php', 'mandrill');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Offer publishing of the config file.
        if ($this->app->runningInConsole()) {
            $this->offerPublishing();
        }

        $this->bindMandrillMessagesFacade();

        $this->registerMailerMandrillMacro();
    }

    /**
     * Setup the resource publishing groups.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../../config/mandrill.php' => config_path('mandrill.php'),
        ], 'mandrill');
    }

    /**
     * Register the mailer mandrill macro
     *
     * @return void
     */
    private function registerMailerMandrillMacro()
    {
        Mailer::macro('mandrill', function () {
            return new MandrillMailer();
        });
    }

    /**
     * Bind the mandrill messages facade
     *
     * @return void
     */
    protected function bindMandrillMessagesFacade()
    {
        $this->app->bind('mandrill.message', function ($app) {
            $mandrill = new \Mandrill(config('mandrill.api_secret'));

            return $mandrill->messages;
        });
    }
}
