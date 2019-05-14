<?php

namespace leolegends\ModelEncryptable;

use Illuminate\Support\ServiceProvider;

class ModelEncryptableServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'corebiz');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'corebiz');
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
        $this->mergeConfigFrom(__DIR__.'/../config/modelencryptable.php', 'modelencryptable');

        // Register the service the package provides.
        $this->app->singleton('modelencryptable', function ($app) {
            return new ModelEncryptable;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['modelencryptable'];
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
            __DIR__.'/../config/modelencryptable.php' => config_path('modelencryptable.php'),
        ], 'modelencryptable.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/corebiz'),
        ], 'modelencryptable.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/corebiz'),
        ], 'modelencryptable.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/corebiz'),
        ], 'modelencryptable.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
