<?php

namespace App\Providers;

use Cuonggt\Trecms\TrecmsApplicationServiceProvider;
use Illuminate\Support\Facades\Gate;

class TrecmsServiceProvider extends TrecmsApplicationServiceProvider
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
        parent::boot();
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
}
