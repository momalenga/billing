<?php

namespace Shengamo\Billing;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shengamo');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'shengamo');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//         $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/shengamo-billing.php', 'shengamo-billing');

        // Register the service the package provides.
        $this->app->singleton('billing', function ($app) {
            return new Billing;
        });
    }

    public function provides(): array
    {
        return ['billing'];
    }

    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/shengamo-billing.php' => config_path('shengamo-billing.php'),
        ], 'shengamo-billing.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/shengamo'),
        ], 'shengamo-billing.views');

        if (empty(glob(database_path('migrations/*_create_team_subscriptions_table.php')))) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_team_subscriptions_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_team_subscriptions_table.php'),
            ], 'migrations');
        }

        if (empty(glob(database_path('migrations/*_create_feature_plan_table.php')))) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_feature_plan_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_feature_plan_table.php'),
            ], 'migrations');
        }

        if (empty(glob(database_path('migrations/*_create_feature_table.php')))) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_feature_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_feature_table.php'),
            ], 'migrations');
        }

        if (empty(glob(database_path('migrations/*_create_plan_table.php')))) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_plan_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_plan_table.php'),
            ], 'migrations');
        }
        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/shengamo'),
        ], 'billing.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/shengamo'),
        ], 'billing.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
