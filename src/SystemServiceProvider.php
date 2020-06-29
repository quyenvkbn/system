<?php

namespace Quyenvkbn\System;

use Illuminate\Support\ServiceProvider;
use Quyenvkbn\System\RouteServiceProvider;

class SystemServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'quyenvkbn');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'quyenvkbn');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/system.php', 'system');

        // Register the service the package provides.
        $this->app->singleton('system', function ($app) {
            return new System;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['system'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing default
        $this->publishes([
            __DIR__.'/../config/system.php' => config_path('system.php'),
            __DIR__.'/../config/ckfinder.php' => config_path('ckfinder.php'),
            __DIR__.'/../config/adminlte.php' => config_path('adminlte.php'),
            __DIR__.'/../resources/assets' => public_path('js'),
            __DIR__.'/../database/seeds' => base_path('database/seeds'),
            __DIR__.'/../resources/views/layout' => base_path('resources/views'),
            __DIR__.'/../middleware' => base_path('app/Http/Middleware'),
        ], 'system.default');

        // Publishing the configuration file.
        /*$this->publishes([
            __DIR__.'/../config/system.php' => config_path('system.php'),
        ], 'system.config');*/

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/quyenvkbn'),
        ], 'system.views');*/

        // Publishing seeds.
        /*$this->publishes([
            __DIR__.'/../database/seeds' => base_path('database/seeds'),
        ], 'system.seeds');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/quyenvkbn'),
        ], 'system.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
