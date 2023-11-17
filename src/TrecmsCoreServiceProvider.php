<?php

namespace Cuonggt\Trecms;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TrecmsCoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/trecms.php', 'trecms'
        );
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->register(TrecmsServiceProvider::class);
        }

        $this->registerResources();
    }

    /**
     * Register the package resources such as routes, templates, etc.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'trecms');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerRoutes();

        // Volt::mount([
        //     __DIR__.'/../resources/views/livewire',
        // ]);
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        });
    }

    /**
     * Get the Trecms admin route group configuration array.
     *
     * @return array{namespace: string, prefix: string, as: string}
     */
    protected function routeConfiguration()
    {
        return [
            'namespace' => 'Cuonggt\Trecms\Http\Controllers',
            'prefix' => Trecms::path(),
            'as' => 'admin.',
        ];
    }
}
