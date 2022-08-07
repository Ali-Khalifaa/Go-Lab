<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Mandob as Middleware;

class Mandob extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('mandob/signin');
        }
    }
}
