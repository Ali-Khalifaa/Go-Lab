<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuardSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


  /*   public function handle($request, \Closure $next, $defaultGuard = null) {
        if (in_array($defaultGuard, array_keys(config("auth.guards")))) {
           config(["auth.defaults.guard" => $defaultGuard]);
        }
        return $next($request);
    } */

    public function handle($request, Closure $next)
    {
        if (auth()->getDefaultDriver() == 'web') {

            auth()->setDefaultDriver('api');
        }

        return $next($request);
    }


    /* public function handle(Request $request, Closure $next)
    {
        return $next($request);
    } */
}
