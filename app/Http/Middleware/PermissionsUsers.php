<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Redirect;
use Route;

class PermissionsUsers
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

        $user_id = Auth::user()->id;
        $permission = Auth::user()->permission;

        if($permission == 1){
            return $next($request);
        }else if($permission == 2){
            if($routename == 'index'){
                return $next($request);
            }else if($routename == 'dataindex'){
                return $next($request);
            }else if($routename == 'create'){
                return $next($request);
            }else if($routename == 'store'){
                return $next($request);
            }else if($routename == 'show'){
                $id = Route::current()->getParameter('users');
                if($id == 1){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else if($routename == 'edit'){
                $id = Route::current()->getParameter('users');
                if($id == 1){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else if($routename == 'update'){
                $id = Route::current()->getParameter('users');
                if($id == 1){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else if($routename == 'destroy'){
                $id = Route::current()->getParameter('users');
                if($id == 1){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else if($routename == 'deleted'){
                return $next($request);
            }else if($routename == 'datadeleted'){
                return $next($request);
            }else if($routename == 'restore'){
                $id = Route::current()->getParameter('users');
                if($id == 1){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else{
                return Redirect::back();
            }
        }else if($permission == 3){
            if($routename == 'show'){
                $id = Route::current()->getParameter('users');
                if($id != $user_id){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else{
                return Redirect::back();
            }
        }else if($permission == 4){
            return Redirect::back();
        }else if($permission == 5){
            if($routename == 'show'){
                $id = Route::current()->getParameter('users');
                if($id != $user_id){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else{
                return Redirect::back();
            }
        }else if($permission == 7){
            if($routename == 'show'){
                $id = Route::current()->getParameter('users');
                if($id != $user_id){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else{
                return Redirect::back();
            }
        }else if($permission == 9){
            if($routename == 'show'){
                $id = Route::current()->getParameter('users');
                if($id != $user_id){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else{
                return Redirect::back();
            }
        }else{
            if($routename == 'show'){
                $id = Route::current()->getParameter('users');
                if($id != $user_id){
                    return Redirect::back();
                }else{
                    return $next($request);
                }
            }else{
                return Redirect::back();
            }
        }

        return $next($request);
    }
}
