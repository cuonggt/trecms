<?php

namespace Cuonggt\Trecms;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Folio\Folio;
use Livewire\Volt\Volt;

class TrecmsApplicationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->installVolt();
        $this->installFolio();
        $this->gate();
        $this->authorization();
    }

    protected function installVolt(): void
    {
        Volt::mount([
            base_path('vendor/cuonggt/trecms/resources/views/livewire'),
            resource_path('views/livewire'),
            resource_path('views/pages'),
        ]);
    }

    protected function installFolio(): void
    {
        Folio::path(resource_path('views/pages'))->middleware([
            '*' => [
                //
            ],
        ]);
    }

    /**
     * Register the Trecms gate.
     *
     * This gate determines who can access Trecms in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTrecms', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Configure the Trecms authorization services.
     */
    protected function authorization(): void
    {
        Trecms::auth(function ($request) {
            return app()->environment('local') ||
                   Gate::check('viewTrecms', [$request->user()]);
        });
    }
}
