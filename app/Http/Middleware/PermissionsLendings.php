<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Redirect;
use Route;
use App\Lendings;
use Illuminate\Support\Facades\DB;

class PermissionsLendings
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
        $route = Route::current()->getActionName();
        $route = explode('@', $route);
        $routename = $route[1];

        $permission = Auth::user()->permission;

        if($permission == 1){
            return $next($request);
        }else if($permission == 2){
            return $next($request);
        }else if($permission == 3){
            return $next($request);
        }else if($permission == 5){
            return $next($request);
        }else if($permission == 7){
            return $next($request);
        }else if($permission == 9){
            return $next($request);
        }else{
            return Redirect::back();
        }

        return $next($request);
    }
}
