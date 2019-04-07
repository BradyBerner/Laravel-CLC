<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class IsAdmin
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
        if(Session::has('ROLE')){
            
            if(!session('ROLE')){
                abort(403, "Forbidden");
            }
        
            return $next($request);
        }

        abort(403, "Forbidden");
    }
}
