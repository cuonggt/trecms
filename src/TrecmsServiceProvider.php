<?php

namespace Cuonggt\Trecms;

use Illuminate\Support\ServiceProvider;

class TrecmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->registerPublishing();
        $this->registerCommands();
    }

    /**
     * Register the package's publishable resources.
     */
    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/trecms.php' => config_path('trecms.php'),
        ], 'trecms-config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/trecms'),
        ], ['trecms-assets', 'laravel-assets']);

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'trecms-migrations');
    }

    /**
     * Register the package's commands.
     */
    protected function registerCommands(): void
    {
        $this->commands([
            Console\InstallCommand::class,
            Console\PublishCommand::class,
        ]);
    }
}
