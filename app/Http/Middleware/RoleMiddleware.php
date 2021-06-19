<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null, $permission = null)
    {
        $permission =  $request->path();

        if(auth()->user() != null) {

            if(!auth()->user()->hasRole($role)) {
                return redirect()->route('error404');
            }
            if($permission !== null && !auth()->user()->can($permission)) {
                return redirect()->route('error404');
            }
        }
        else {

            return redirect()->route('login');
        }

        return $next($request);
    }
}
