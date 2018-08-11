<?php

namespace Touge\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Touge\Modules\Console\Generators\MakeListenersCommand;
use Touge\Modules\Console\Generators\MakeRepositoryCommand;
use Touge\Modules\Console\Generators\MakeJobCommand;
use Touge\Modules\Console\Generators\MakeEventCommand;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $generators = [
            "command.make.module.repository" => MakeRepositoryCommand::class,
            "command.make.module.job" => MakeJobCommand::class,
            "command.make.module.event" => MakeEventCommand::class,
            "command.make.module.listener" => MakeListenersCommand::class,
        ];

        foreach ($generators as $slug => $class) {
            $this->app->singleton($slug, function ($app) use ($slug, $class) {
                return $app[$class];
            });

            $this->commands($slug);
        }
    }
}
