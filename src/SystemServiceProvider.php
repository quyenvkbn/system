<?php

namespace Quyenvkbn\System;

use Illuminate\Support\ServiceProvider;
use Quyenvkbn\System\RouteServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class SystemServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add([
                'key' => 'language',
                'text' => __('quyenvkbn::system.language').' - '.app()->getLocale(), 
                'topnav_right' => true,
                'submenu' => [
                    [
                        'text' => 'Vietnam',
                        'url'  => 'set-language/vi',
                    ],
                    [
                        'text' => 'English',
                        'url'  => 'set-language/en',
                    ],
                ]
            ]);

            $event->menu->add([
                'key' => 'modules',
                'header' => 'Modules',
            ]);
            $event->menu->add([
                'key' => 'system_settings',
                'header' => __('quyenvkbn::system.system'),
            ]);

            $event->menu->addAfter('system_settings', [
                'text'       => __('quyenvkbn::system.user_management'),
                'icon_color' => 'fas fa-fw fa-user ',
                'can'  => ['role-list','user-list'],
                'submenu' => [
                    [
                        'text' => __('quyenvkbn::system.role'),
                        'url'  => 'admin/role',
                        'can'  => 'role-list'
                    ],
                    [
                        'text' => __('quyenvkbn::system.member'),
                        'url'  => 'admin/user',
                        'can'  => 'user-list'
                    ],
                ]
            ]);
            $event->menu->addAfter('system_settings', [
                'text'       => __('quyenvkbn::system.system'),
                'icon_color' => 'nav-icon fas fa-th',
                'url' => 'admin/system/1/edit',
                'can'  => 'system-edit'
            ]);
        });

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'quyenvkbn');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'quyenvkbn');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if(!class_exists('Quyenvkbn\System\Models\User')){
            class_alias(config("auth.providers.users.model"), 'Quyenvkbn\System\Models\User');
        }

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
            __DIR__.'/../config/router.php' => config_path('router.php'),
            __DIR__.'/../resources/assets/js' => public_path('js'),
            __DIR__.'/../resources/assets/css' => public_path('css'),
            __DIR__.'/../database/seeds' => base_path('database/seeds'),
            __DIR__.'/../resources/views/publishes' => base_path('resources/views'),
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/quyenvkbn'),
        ], 'system.default');
        
        $this->publishes([
            __DIR__.'/../middleware' => base_path('app/Http/Middleware'),
        ], 'customer.default');
    }
}
