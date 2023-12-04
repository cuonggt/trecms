<?php

use Cuonggt\Trecms\Http\Middleware\Authenticate;
use Cuonggt\Trecms\Http\Middleware\Authorize;

return [
    'path' => env('TRECMS_PATH', '/admin'),

    'middleware'  => [
        Authenticate::class,
        Authorize::class,
    ],
];
