<?php

namespace Cuonggt\Trecms;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TrecmsCoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/trecms.php', 'trecms'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->app->register(TrecmsServiceProvider::class);
        }

        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
    }

    /**
     * Register the package routes.
     */
    protected function registerRoutes(): void
    {
        Route::group([
            'namespace' => \Cuonggt\Trecms\Http\Controllers::class,
            'prefix' => Trecms::path(),
            'as' => 'admin.',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        });
    }

    /**
     * Register the package resources such as routes, templates, etc.
     */
    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'trecms');
    }

    /**
     * Register the package's migrations.
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
