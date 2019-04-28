<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

/**
 * Class IsAdmin
 * @package App\Http\Middleware
 */
class IsAdmin
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
        if($request->session()->has('ROLE') && $request->session() != null){
            
            if(!session('ROLE')){
                abort(403, "Forbidden");
            }
        
            return $next($request);
        }

        abort(403, "Forbidden");
    }
}
