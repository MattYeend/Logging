<?php

namespace MattYeend\Logging;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class LoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Models/Log.php' => app_path('Models/Log.php'),
        ], 'logging-model');

        $this->afterPublishing(function () {
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

        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
    }
}