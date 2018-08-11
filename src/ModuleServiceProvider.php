<?php

namespace Nick\Modules;

use Caffeinated\Modules\Support\ServiceProvider;
use Nick\Modules\Providers\GeneratorServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(GeneratorServiceProvider::class);
    }
}
