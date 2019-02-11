<?php

namespace VoyagerThemes\Middleware;

use Closure;
use Cookie;
use Crypt;

class PostDisplayMiddleware
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
        $post_display = Cookie::get('post_display') ? Crypt::decrypt(Cookie::get('post_display')) : null;

        if(!isset($post_display)){
            $post_display = theme('post_display');
        }

        if(!isset($post_display)){
            $post_display = 'list';
        }

        view()->share('post_display', $post_display);

        return $next($request);
    }
}
