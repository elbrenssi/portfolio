<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleFromCookie
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->cookie('locale', config('app.fallback_locale', 'en'));
        if (! in_array($locale, ['en', 'fr', 'ar'], true)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
