<?php

namespace VoyagerThemes\Middleware;

use Closure;
use Cookie;
use Crypt;

class SidebarMiddleware
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
        $sidebar = Cookie::get('sidebar') ? Crypt::decrypt(Cookie::get('sidebar')) : null;

        if(!isset($sidebar)){
            $sidebar = theme('sidebar');
        }

        if(!isset($sidebar)){
            $sidebar = 1;
        }

        view()->share('sidebar', $sidebar);

        return $next($request);
    }
}
