<?php

namespace Vati\SMS;

use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/sms.php';
        $this->mergeConfigFrom($configPath, 'sms');
        $this->publishes([
            $configPath => config_path('sms.php'),
        ],'sms');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sms', function () {
            return $this->app->make('Vati\SMS\SMS');
        });
    }
}
