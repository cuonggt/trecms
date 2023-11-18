<?php

namespace Cuonggt\Trecms;

use Illuminate\Http\Request;

trait AuthorizesRequests
{
    /**
     * The callback that should be used to authenticate Trecms users.
     *
     * @var (\Closure(\Illuminate\Http\Request):(bool))|null
     */
    public static $authUsing;

    /**
     * Register the Trecms authentication callback.
     *
     * @param  \Closure(\Illuminate\Http\Request):bool  $callback
     */
    public static function auth($callback): static
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the Trecms dashboard.
     */
    public static function check(Request $request): bool
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }
}
