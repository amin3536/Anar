<?php

namespace amin3520\Anar;

use Illuminate\Support\ServiceProvider;

class AnarServiceProvider extends ServiceProvider
{
    protected $commands = [
        'amin3520\Anar\Commands\MakeBaseRepository',
        'amin3520\Anar\Commands\MakeBaseRepositoryImp',
        'amin3520\Anar\Commands\MakeRepositoryProvider',
        'amin3520\Anar\Commands\MakeRepositoryCommand',
        'amin3520\Anar\Commands\MakeRepositoryImpCommand',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'amin3520');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'amin3520');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
        $this->commands($this->commands);
        $this->mergeConfigFrom(__DIR__.'/../config/anar.php', 'anar');

        // Register the service the package provides.
        $this->app->singleton('anar', function ($app) {
            return new Anar;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['anar'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/anar.php' => config_path('anar.php'),
        ], 'anar.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/amin3520'),
        ], 'anar.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/amin3520'),
        ], 'anar.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/amin3520'),
        ], 'anar.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
