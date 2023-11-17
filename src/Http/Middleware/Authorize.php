<?php

namespace Cuonggt\Trecms\Http\Middleware;

use Closure;
use Cuonggt\Trecms\Trecms;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return Trecms::check($request) ? $next($request) : abort(403);
    }
}
