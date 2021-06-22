<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
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
    public function handle(Request $request, Closure $next, $permission = null)
    {
        $role = auth()->user()->roles[0]['role_name'];
        $rolecheck = Role::with('permissions')->where('role_name', $role)->get();

        if(auth()->user() != null) {
            // dd(auth()->user()->can($permission));
            if($permission !== null && !auth()->user()->can($permission)) {

                foreach($rolecheck[0]['permissions'] as $perm) {
                    if($perm->permission_name == $permission) {

                        return redirect()->route('error404');
                    }
                }

                return redirect()->route('error404');
            }
        }
        else {

            return redirect()->route('login');
        }

        return $next($request);
    }
}
