<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Redirect;
use Route;

class PermissionsCompanies
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
            if($routename == 'isFacturation'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else if($permission == 4){
            if($routename == 'isFacturation'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else if($permission == 5){
            if($routename == 'isFacturation'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else if($permission == 7){
            if($routename == 'isFacturation'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else if($permission == 9){
            if($routename == 'isFacturation'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else{
            return Redirect::back();
        }

        return $next($request);
    }
}
