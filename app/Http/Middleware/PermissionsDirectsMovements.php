<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Redirect;
use Route;
use App\DirectsMovements;
use App\DirectsMovementsEntries;
use Illuminate\Support\Facades\DB;

class PermissionsDirectsMovements
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
            if($routename == 'index'){
                return $next($request);
            }else if($routename == 'dataindex'){
                return $next($request);
            }else if($routename == 'showFinished'){
                return $next($request);
            }else if($routename == 'datafinished'){
                return $next($request);
            }else if($routename == 'show'){
                $id = Route::current()->getParameter('directs_movements');
                $entries = DirectsMovementsEntries::where('movement', $id)
                            ->whereExists(function ($query) {
                                $query->select(DB::raw(1))
                                    ->from('administrator_companies')
                                    ->where('administrator_companies.user', Auth::user()->id)
                                    ->whereRaw('administrator_companies.company = directs_movements_entries.company')
                                    ->whereNull('deleted_at');
                            })
                            ->count();
                if($entries == 0){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'showAdministratorFacturation'){
                $id = Route::current()->getParameter('id');
                $movement = DirectsMovements::find($id);
                if($movement->status == 5){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'storeAdministrationFacturation'){
                $id = $request->movement_id;
                $movement = DirectsMovements::find($id);
                if($movement->status == 5){
                    return Redirect::back();
                }
            }else{
                return Redirect::back();
            }
        }else if($permission == 4){
            return $next($request);
        }else if($permission == 5){
            if($routename == 'index'){
                return $next($request);
            }else if($routename == 'dataindex'){
                return $next($request);
            }else if($routename == 'showFinished'){
                return $next($request);
            }else if($routename == 'datafinished'){
                return $next($request);
            }else if($routename == 'create'){
                return $next($request);
            }else if($routename == 'store'){
                return $next($request);
            }else if($routename == 'show'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else if($permission == 7){
            if($routename == 'index'){
                return $next($request);
            }else if($routename == 'dataindex'){
                return $next($request);
            }else if($routename == 'show'){
                return $next($request);
            }else if($routename == 'createFacturations'){
                return $next($request);
            }else if($routename == 'storeFacturation'){
                return $next($request);
            }else if($routename == 'createFacturationsInvoices'){
                return $next($request);
            }else if($routename == 'storeFacturationInvoices'){
                return $next($request);
            }else{
                return Redirect::back();
            }
        }else if($permission == 9){
            if($routename == 'index'){
                return $next($request);
            }else if($routename == 'dataindex'){
                return $next($request);
            }else if($routename == 'show'){
                return $next($request);
            }else if($routename == 'showBanksPayment'){
                $id = Route::current()->getParameter('id');
                $movement = DirectsMovements::find($id);
                if($movement->status == 4){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'storeBanksPayment'){
                $id = $request->movement_id;
                $movement = DirectsMovements::find($id);
                if($movement->status == 4){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'showFacturationsPayment'){
                $id = Route::current()->getParameter('id');
                $movement = DirectsMovements::find($id);
                if($movement->status == 2){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'storeFacturationsPayment'){
                $id = $request->movement_id;
                $movement = DirectsMovements::find($id);
                if($movement->status == 2){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'showOutputsReceipts'){
                $id = Route::current()->getParameter('id');
                $movement = DirectsMovements::find($id);
                if($movement->status == 2){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'storeOutputsReceipts'){
                $id = $request->movement_id;
                $movement = DirectsMovements::find($id);
                if($movement->status == 2){
                    return Redirect::back();
                }
                return $next($request);
            }else if($routename == 'facturationsRollback'){
                $id = Route::current()->getParameter('id');
                $movement = DirectsMovements::find($id);
                if($movement->status == 4){
                    return $next($request);
                }
                return Redirect::back();
            }else{
                return Redirect::back();
            }
        }else if($permission == 10){
            if($routename == 'index'){
                return $next($request);
            }else if($routename == 'dataindex'){
                return $next($request);
            }else if($routename == 'showFinished'){
                return $next($request);
            }else if($routename == 'datafinished'){
                return $next($request);
            }else if($routename == 'show'){
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
