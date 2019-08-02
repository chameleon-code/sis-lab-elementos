<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::guard($guard)->user()->role_id;
            if($role==4){
                return $next($request);
            }else{
                return redirect('/home');
            }
        }
        return redirect('/login');
    }
}
