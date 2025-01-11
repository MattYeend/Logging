<?php

namespace MattYeend\Logging;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LoggingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the Log.php model
        $this->publishes([
            __DIR__ . '/Models/Log.php' => app_path('Models/Log.php'),
        ], 'logging-model');

        // Load package migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        // Optional: Provide a clear message about namespace update
        $this->registerPublishingInstructions();
    }

    /**
     * Display instructions for namespace update after publishing.
     */
    protected function registerPublishingInstructions()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([]);
            $this->app->terminating(function () {
                $publishedModel = app_path('Models/Log.php');
                if (file_exists($publishedModel)) {
                    echo "\nNote: Update the namespace in `Models/Log.php` from `MattYeend\\Logging\\Models` to `App\\Models`.\n";
                }
            });
        }
    }
}
