<?php

namespace Cuonggt\Trecms;

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
     * @return static
     */
    public static function auth($callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the Trecms dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }
}
