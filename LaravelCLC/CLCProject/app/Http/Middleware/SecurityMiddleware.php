<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->has('ID')){
            abort(403, "Forbidden");
        }

        return $next($request);
    }
}
