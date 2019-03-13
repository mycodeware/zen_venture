<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->route()->parameter('locale');
        if (!array_key_exists($locale, config('languages'))) {
            abort(404);
        }
        session()->put('locale', $locale);

        return $next($request);
    }
}
