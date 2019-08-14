<?php

namespace App\Http\Middleware;

use Closure;

class DownloadControl
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
        dd($request);
        if(startsWith($request->requestUri, "/storage")) {
            if(Auth::user()) {
                dd("Autorizar acceso");
            } else {
                dd("Denegar acceso");
            }
        }
        //return $next($request);
    }
}
