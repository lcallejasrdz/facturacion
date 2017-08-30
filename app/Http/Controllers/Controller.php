<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function movementStatus($status)
    {
    	if($status == 1){
    		return "Administrador - Facturación";
    	}else if($status == 2){
    		return "Bancos - Recepción de Pagos";
    	}else if($status == 3){
    		return "Dispersiones - Transferencias";
    	}else if($status == 4){
            return "Bancos - Comprobantes de Pagos";
        }else if($status == 5){
            return "Finalizado";
        }
    }

    public function lendingStatus($status)
    {
        if($status == 1){
            return "Bancos - Pago";
        }else if($status == 2){
            return "Bancos - Comprobante";
        }else if($status == 3){
            return "Finalizado";
        }
    }
}
