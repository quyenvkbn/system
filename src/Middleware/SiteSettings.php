<?php

namespace Quyenvkbn\System\Middleware;

use Closure;
use View;
use Quyenvkbn\System\Models\System;

class SiteSettings
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
        $site_settings = System::get()->pluck('content_'.session('locale'),'keyword');
        View::share('site_settings', $site_settings);
        return $next($request);
    }
}
