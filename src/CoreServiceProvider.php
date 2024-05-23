<?php

namespace Logia\Core;

use Illuminate\Support\ServiceProvider;
use Logia\Core\Console\LogiaParserMakeCommand;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LogiaParserMakeCommand::class
            ]);
        }

        $this->publishes([
            __DIR__.'/../stubs/parser.stub' => base_path('stubs/parser.stub'),
            __DIR__.'/../stubs/request.stub' => base_path('stubs/request.stub'),
            __DIR__ . '/../config/http-status.php' => config_path('http-status.php'),
        ],'logia-core');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/http-status.php', 'http-status');
    }
}
