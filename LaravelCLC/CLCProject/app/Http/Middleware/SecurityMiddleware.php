<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class SecurityMiddleware
 * @package App\Http\Middleware
 */
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
        if(!$request->session()->has('ID') || $request->session() == null){
            abort(403, "Please login before viewing this page");
        }

        return $next($request);
    }
}
