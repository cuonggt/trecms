<?php

use Cuonggt\Trecms\Http\Middleware\Authenticate;
use Cuonggt\Trecms\Http\Middleware\Authorize;

return [
    'path' => '/admin',

    'middleware' => ['web'],

    'auth_middleware' => [
        Authenticate::class,
        Authorize::class,
    ],
];
