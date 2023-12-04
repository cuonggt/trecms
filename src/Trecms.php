<?php

namespace Cuonggt\Trecms;

use Illuminate\Database\Eloquent\Model;

final class Trecms
{
    use Concerns\AuthorizesRequests;

    /**
     * The user model that should be used by Trecms.
     */
    public static string $userModel = 'App\\Models\\User';

    /**
     * The post model that should be used by Trecms.
     */
    public static string $postModel = 'App\\Models\\Post';

    /**
     * Get the current Trecms version.
     */
    public static function version(): string
    {
        return 'v0.1.0';
    }

    /**
     * Get the app name utilized by Trecms.
     */
    public static function name(): string
    {
        return config('trecms.name', 'TreCMS');
    }

    /**
     * Get the URI path prefix utilized by Trecms.
     */
    public static function path(): string
    {
        return config('trecms.path', '/admin');
    }

    /**
     * Get the name of the user model used by the application.
     */
    public static function userModel(): string
    {
        return static::$userModel;
    }

    /**
     * Get a new instance of the user model.
     */
    public static function newUserModel(): Model
    {
        $model = static::userModel();

        return new $model;
    }

    /**
     * Specify the user model that should be used by Trecms.
     */
    public static function useUserModel(string $model): static
    {
        static::$userModel = $model;

        return new static;
    }

    /**
     * Get the name of the post model used by the application.
     */
    public static function postModel(): string
    {
        return static::$postModel;
    }

    /**
     * Get a new instance of the post model.
     */
    public static function newPostModel(): Model
    {
        $model = static::postModel();

        return new $model;
    }

    /**
     * Specify the post model that should be used by Trecms.
     */
    public static function usePostModel(string $model): static
    {
        static::$postModel = $model;

        return new static;
    }
}
