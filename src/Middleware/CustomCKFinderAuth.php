<?php

namespace Quyenvkbn\System\Middleware;

use Closure;
use Auth;

class CustomCKFinderAuth
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
        if (session_id() == '') {
            @session_start();
        }
        config(['ckfinder.authentication' => function() {
            return true;
        }]);
        return $next($request);
        
    }
}
