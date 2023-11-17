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
        $this->commands([
            Console\InstallCommand::class,
            Console\PublishCommand::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
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
}
