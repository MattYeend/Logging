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

        // Automatically update namespace of published file
        $this->registerNamespaceUpdate();

        // Load package migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
    }

    /**
     * Automatically update namespace of the published file
     */
    protected function registerNamespaceUpdate()
    {
        $this->app->terminating(function () {
            $publishedModel = app_path('Models/Log.php');
            if (file_exists($publishedModel)) {
                $contents = file_get_contents($publishedModel);
                $updatedContents = Str::replaceFirst(
                    'namespace MattYeend\\Logging\\Models;',
                    'namespace App\\Models;',
                    $contents
                );
                file_put_contents($publishedModel, $updatedContents);
            }
        });
    }
}
