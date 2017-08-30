<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Lendings;
use App\Companies;
use App\User;
use Carbon\Carbon;
use Datatables;
use Auth;
use Redirect;

class LendingsController extends Controller
{
    public function __construct(){
        $this->middleware('permissionsLendings');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operations.lendings.index');
    }

    public function dataindex()
    {
        Carbon::setLocale('es');

        $permission = Auth::user()->permission;

        $lendings = Lendings::where('status', '!=', 3)->get(['id', 'user', 'company_emit', 'company_to', 'quantity', 'status', 'created_at']);

        foreach($lendings as $lending){
            $lending->status = $this->lendingStatus($lending->status);
        	$lending->quantity = number_format($lending->quantity, 2, '.', ',');
            $lending->user = User::find($lending->user)->name;
            $lending->company_to = Companies::find($lending->company_to)->name;
        }

        return Datatables::of($lendings)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->add_column('date','{!! $created_at !!}')
            ->add_column('actions', function($lending) use($permission) {
                $actions = '<a href='. route('lendings.show', $lending->id) .' class="text-info"><i class="fa fa-fw fa-info-circle"></i></a>';
                if($permission == 9){
                	if($lending->status == 'Bancos - Pago'){
                		$actions .= '<a href='. url('lendings/'. $lending->id .'/banks-payment') .' class="text-success"><i class="fa fa-fw fa-usd"></i></a>';
                	}else if($lending->status == 'Bancos - Comprobante'){
                		$actions .= '<a href='. url('lendings/'. $lending->id .'/banks-receipt') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                	}
                }

                return $actions;
            })
            ->make(true);
    }

    public function showFinished()
    {
        return view('operations.lendings.show-finished');
    }

    public function datafinished()
    {
        Carbon::setLocale('es');

        $lendings = Lendings::where('status', 3)->get(['id', 'user', 'company_emit', 'company_to', 'quantity', 'status', 'created_at']);

        foreach($lendings as $lending){
            $lending->status = $this->lendingStatus($lending->status);
        	$lending->quantity = number_format($lending->quantity, 2, '.', ',');
            $lending->user = User::find($lending->user)->name;
            $lending->company_to = Companies::find($lending->company_to)->name;
        }

        return Datatables::of($lendings)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->add_column('date','{!! $created_at !!}')
            ->add_column('actions', function($lendings) {
                $actions = '<a href='. route('lendings.show', $lendings->id) .' class="text-info"><i class="fa fa-fw fa-info-circle"></i></a>';

                return $actions;
            })
            ->make(true);
    }

    /**
    * Inicio de Proceso
    **/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::lists('name', 'id');
        return view('operations.lendings.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->quantity = str_replace(',', '', $request->quantity);
        $lending = Lendings::create([
	        'user' => Auth::user()->id,
	        'company_emit' => $request->company_emit,
	        'bank_emit' => $request->bank_emit,
	        'company_to' => $request->company_to,
	        'bank_destiny' => $request->bank_destiny,
	        'quantity' => $request->quantity,
	        'comment' => $request->comment,
	        'receipt' => '',
	        'status' => 1
        ]);

        return Redirect::to('lendings')->with('success', 'Movimiento creado exitosamente');
    }

    public function show($id)
    {
        $movement = Lendings::find($id);
        $movement->status = $this->lendingStatus($movement->status);
        $movement->company_to = Companies::find($movement->company_to)->name;
        $movement->quantity = number_format($movement->quantity, 2, '.', ',');

        return view('operations.lendings.show', compact('movement'));
    }

    /**
    * Estatus 1 - Pasa a los Administradores para que suban sus facturas
    **/

    public function showBanksPayment($id)
    {
        $movement = Lendings::find($id);
        $movement->status = $this->lendingStatus($movement->status);
        $movement->company_to = Companies::find($movement->company_to)->name;
        $movement->quantity = number_format($movement->quantity, 2, '.', ',');

        return view('operations.lendings.show-banks-payment', compact('movement'));
    }

    public function storeBanksPayment(Request $request)
    {
    	$movement = Lendings::find($request->movement_id);
    	$movement->status = 2;
    	$movement->save();

        return Redirect::to('lendings')->with('success', 'Movimiento pagado exitosamente');
    }

    /**
    * Estatus 2 - Pasa a los Administradores para que suban sus facturas
    **/

    public function showBanksReceipt($id)
    {
        $movement = Lendings::find($id);
        $movement->status = $this->lendingStatus($movement->status);
        $movement->company_to = Companies::find($movement->company_to)->name;
        $movement->quantity = number_format($movement->quantity, 2, '.', ',');

        return view('operations.lendings.show-banks-receipt', compact('movement'));
    }

    public function storeBanksReceipt(Request $request)
    {
        $destinationPath = public_path() . '/uploads/lendings-receipts/';

        $file_temp = $request->file('receipt');
        $extension = $file_temp->getClientOriginalExtension() ?: 'pdf';
        $safeName = str_random(40).'.'.$extension;

        $lending = Lendings::find($request->movement_id);
        $lending->receipt = $safeName;
        $lending->status = 3;
        $lending->save();

        $file_temp->move($destinationPath, $safeName);

        return Redirect::to('lendings')->with('success', 'Movimiento finalizado exitosamente');
    }

    public function movementRollback($id){
    	$lending = Lendings::find($id);

    	if($lending->status == 2){
    		$lending->status = 1;
    		$lending->save();

        	$message = 'Movimiento regresado exitosamente';
    	}else if($lending->status == 1){
    		$lending->delete();

            $message = 'Movimiento eliminado exitosamente';
    	}

    	return Redirect::to('lendings')->with('success', $message);
    }
}
