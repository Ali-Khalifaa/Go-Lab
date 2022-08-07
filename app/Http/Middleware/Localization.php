<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    protected const ALLOWED_LOCALIZATIONS = ['en', 'ar'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $localization = $request->header('lang');
        $localization = in_array($localization, self::ALLOWED_LOCALIZATIONS, true) ? $localization : 'en';
        app()->setLocale($localization);

        return $next($request);    }
}
