<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PayrollsMovements;
use App\PayrollsMovementsEntries;
use App\PayrollsMovementsFacturations;
use App\Companies;
use App\User;
use Carbon\Carbon;
use Datatables;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;

class PayrollsMovementsController extends Controller
{
    public function __construct(){
        $this->middleware('permissionsPayrollsMovements');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operations.payrolls-movements.index');
    }

    public function dataindex()
    {
        Carbon::setLocale('es');

        $permission = Auth::user()->permission;

        if($permission == 1 || $permission == 2 || $permission == 5){
            $payrollsmovements = PayrollsMovements::where('status', '!=', 5)->get(['id', 'customer', 'status', 'facturation_payments', 'user', 'created_at']);
        }else if($permission == 3){
            $payrollsmovements = PayrollsMovements::whereExists(function ($query) {
                                    $query->select(DB::raw(1))
                                        ->from('payrolls_movements_entries')
                                        ->whereRaw('payrolls_movements_entries.movement = payrolls_movements.id')
                                        ->whereNull('payrolls_movements_entries.deleted_at')
                                        ->whereExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                ->from('administrator_companies')
                                                ->where('administrator_companies.user', Auth::user()->id)
                                                ->whereRaw('administrator_companies.company = payrolls_movements_entries.company')
                                                ->whereNull('administrator_companies.deleted_at');
                                        });
                                })
                                ->whereIn('status', [1, 4])
                                ->get(['id', 'customer', 'status', 'facturation_payments', 'user', 'created_at']);
        }else if($permission == 7){
            $payrollsmovements = PayrollsMovements::where('status', 3)->orWhere('facturation_invoices', 1)->get(['id', 'customer', 'status', 'facturation_payments', 'user', 'created_at']);
        }else if($permission == 9){
            $payrollsmovements = PayrollsMovements::where('status', 2)->orWhere('status', 4)->get(['id', 'customer', 'status', 'facturation_payments', 'user', 'created_at']);
        }else{

        }

        foreach($payrollsmovements as $payrollmovement){
            $payrollmovement->status = $this->movementStatus($payrollmovement->status);
            $payrollmovement->user = User::find($payrollmovement->user)->name;
        }

        return Datatables::of($payrollsmovements)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->add_column('date','{!! $created_at !!}')
            ->add_column('actions', function($payrollmovement) use($permission) {
                $actions = '<a href='. route('payrolls-movements.show', $payrollmovement->id) .' class="text-info"><i class="fa fa-fw fa-info-circle"></i></a>';
                if($permission == 3 && $payrollmovement->status == 'Administrador - Facturación'){
                    $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/administrator-facturation') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                }
                if($permission == 9 && $payrollmovement->status == 'Bancos - Recepción de Pagos'){
                    $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/banks-payment') .' class="text-success"><i class="fa fa-fw fa-usd"></i></a>';
                }
                if($permission == 7){
                    if($payrollmovement->status == 'Bancos - Comprobantes de Pagos'){
                        $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/create-facturations-invoices') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                    }else{
                        $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/create-facturations') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                    }
                }
                if($permission == 9 && $payrollmovement->status == 'Bancos - Comprobantes de Pagos'){
                    if($payrollmovement->facturation_payments == 0){
                        $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/facturations-payment') .' class="text-success"><i class="fa fa-fw fa-usd"></i></a>';
                    }else{
                        $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/outputs-receipts') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                    }
                }

                return $actions;
            })
            ->make(true);
    }

    public function showFinished()
    {
        return view('operations.payrolls-movements.show-finished');
    }

    public function datafinished()
    {
        Carbon::setLocale('es');

        $permission = Auth::user()->permission;

        if($permission == 1 || $permission == 2 || $permission == 5){
            $payrollsmovements = PayrollsMovements::where('status', 5)->get(['id', 'customer', 'status', 'user', 'created_at']);
        }else if($permission == 3){
            $payrollsmovements = PayrollsMovements::whereExists(function ($query) {
                                    $query->select(DB::raw(1))
                                        ->from('payrolls_movements_entries')
                                        ->whereRaw('payrolls_movements_entries.movement = payrolls_movements.id')
                                        ->whereNull('payrolls_movements_entries.deleted_at')
                                        ->whereExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                ->from('administrator_companies')
                                                ->where('administrator_companies.user', Auth::user()->id)
                                                ->whereRaw('administrator_companies.company = payrolls_movements_entries.company')
                                                ->whereNull('administrator_companies.deleted_at');
                                        });
                                })
                                ->where('status',5)
                                ->get(['id', 'customer', 'status', 'user', 'created_at']);
        }else{

        }

        foreach($payrollsmovements as $payrollmovement){
            $payrollmovement->status = $this->movementStatus($payrollmovement->status);
            $payrollmovement->user = User::find($payrollmovement->user)->name;
        }

        return Datatables::of($payrollsmovements)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->add_column('date','{!! $created_at !!}')
            ->add_column('actions', function($payrollmovement) use($permission) {
                $actions = '<a href='. route('payrolls-movements.show', $payrollmovement->id) .' class="text-info"><i class="fa fa-fw fa-info-circle"></i></a>';
                if($permission == 3 && $payrollmovement->status == 'Administrador - Facturación'){
                    $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/administrator-facturation') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                }
                if($permission == 9 && $payrollmovement->status == 'Bancos - Recepción de Pagos'){
                    $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/banks-payment') .' class="text-success"><i class="fa fa-fw fa-usd"></i></a>';
                }
                if($permission == 7){
                    $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/create-facturations') .' class="text-success"><i class="fa fa-fw fa-file-text-o"></i></a>';
                }
                if($permission == 9 && $payrollmovement->status == 'Bancos - Comprobantes de Pagos'){
                    $actions .= '<a href='. url('payrolls-movements/'. $payrollmovement->id .'/facturations-payment') .' class="text-success"><i class="fa fa-fw fa-usd"></i></a>';
                }

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
        return view('operations.payrolls-movements.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payrollmovement = PayrollsMovements::create([
            'customer' => $request->customer,
            'user' => Auth::user()->id,
            'status' => 1,
            'facturation_invoices' => 0,
            'facturation_payments' => 0
        ]);

        // Agregar Entradas
        for($i = 0; $i < count($request->entry_company); $i++){
            PayrollsMovementsEntries::create([
                'movement' => $payrollmovement->id,
                'company' => $request->entry_company[$i],
                'quantity' => $request->entry_quantity[$i],
                'bank' => $request->entry_bank[$i],
                'account' => $request->entry_account[$i],
                'status' => 1
            ]);
        }

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);

        $entries = PayrollsMovementsEntries::where('movement', $id);
        if(Auth::user()->permission == 3){
            $entries = $entries->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('administrator_companies')
                            ->where('administrator_companies.user', Auth::user()->id)
                            ->whereRaw('administrator_companies.company = payrolls_movements_entries.company')
                            ->whereNull('deleted_at');
                    });
        }
        $entries = $entries->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollsMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');
        
        $facturations = PayrollsMovementsFacturations::where('movement', $id)->get();
        foreach($facturations as $facturation){
            $facturation->company_emit = Companies::find($facturation->company_emit)->name;
            $facturation->company_to = Companies::find($facturation->company_to)->name;
            $facturation->quantity = number_format($facturation->quantity, 2, '.', ',');
        }
        $total_facturations = PayrollsMovementsFacturations::where('movement', $id)->where('final_account', 1)->sum('quantity');
        $total_facturations = number_format($total_facturations, 2, '.', ',');

        return view('operations.payrolls-movements.show', compact('movement', 'entries', 'total_entries', 'facturations', 'total_facturations'));
    }

    /**
    * Estatus 1 - Pasa a los Administradores para que suban sus facturas
    **/

    public function showAdministratorFacturation($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);

        $entries = PayrollsMovementsEntries::where('movement', $id);
        if(Auth::user()->permission == 3){
            $entries = $entries->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('administrator_companies')
                            ->where('administrator_companies.user', Auth::user()->id)
                            ->whereRaw('administrator_companies.company = payrolls_movements_entries.company')
                            ->whereNull('deleted_at');
                    });
        }
        $entries = $entries->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollsMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');

        return view('operations.payrolls-movements.show-administrator-facturation', compact('movement', 'entries', 'total_entries'));
    }

    public function storeAdministrationFacturation(Request $request)
    {
        for($i=0; $i<count($request->entries_id); $i++){
            $destinationPath = public_path() . '/uploads/entries-invoices/';

            $file_temp = $request->file('invoices')[$i];
            $extension = $file_temp->getClientOriginalExtension() ?: 'pdf';
            $safeName = str_random(40).'.'.$extension;

            $entry = PayrollsMovementsEntries::find($request->entries_id[$i]);
            $entry->invoice = $safeName;
            $entry->status = 2;
            $entry->save();

            $file_temp->move($destinationPath, $safeName);
        }

        $entries = PayrollsMovementsEntries::where('movement', $request->movement_id)->where('status', 1)->count();
        if($entries == 0){
            $movement = PayrollsMovements::find($request->movement_id);
            $movement->status = 2;
            $movement->save();
        }

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento facturado exitosamente');
    }

    /**
    * Estatus 2 - Pasa a Bancos para que verifiquen los pagos
    **/

    public function showBanksPayment($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);
        
        $entries = PayrollsMovementsEntries::where('movement', $id)->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollsMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');

        return view('operations.payrolls-movements.show-banks-payment', compact('movement', 'entries', 'total_entries'));
    }

    public function storeBanksPayment(Request $request)
    {
        for($i=0; $i<count($request->paymeny_check); $i++){
            $entry = PayrollsMovementsEntries::find($request->paymeny_check[$i]);
            $entry->status = 3;
            $entry->save();
        }

        $entries = PayrollsMovementsEntries::where('movement', $request->movement_id)->where('status', 2)->count();

        if($entries == 0){
            $movement = PayrollsMovements::find($request->movement_id);
            $movement->status = 3;
            $movement->save();
        }

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento pagado exitosamente');
    }

    /**
    * Estatus 3 - Pasa a Facturación para que hagan sus transferencias
    **/

    public function createFacturations($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);
        
        $entries = PayrollsMovementsEntries::where('movement', $id)->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollsMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');

        $companies = Companies::lists('name', 'id');

        return view('operations.payrolls-movements.create-facturations', compact('movement', 'entries', 'total_entries', 'companies'));
    }

    public function storeFacturation(Request $request)
    {
        for($i=0; $i<count($request->facturation_company_emit); $i++){
            PayrollsMovementsFacturations::create([
                'movement' => $request->movement_id,
                'company_emit' => $request->facturation_company_emit[$i],
                'bank_emit' => $request->facturation_bank_emit[$i],
                'company_to' => $request->facturation_company_to[$i],
                'bank_destiny' => $request->facturation_bank_destiny[$i],
                'quantity' => $request->facturation_quantity[$i],
                'final_account' => $request->facturation_final_account[$i],
                'invoice' => '',
                'receipt' => 0,
                'status' => 1
            ]);
        }

        $movement = PayrollsMovements::find($request->movement_id);
        $movement->status = 4;
        $movement->facturation_invoices = 1;
        $movement->save();

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento facturado exitosamente');
    }

    public function createFacturationsInvoices($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);
        
        $entries = PayrollsMovementsEntries::where('movement', $id)->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollsMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');
        
        $facturations = PayrollsMovementsFacturations::where('movement', $id)->get();
        foreach($facturations as $facturation){
            $facturation->company_emit = Companies::find($facturation->company_emit)->name;
            $facturation->company_to = Companies::find($facturation->company_to)->name;
            $facturation->quantity = number_format($facturation->quantity, 2, '.', ',');
        }
        $total_facturations = PayrollsMovementsFacturations::where('movement', $id)->where('final_account', 1)->sum('quantity');
        $total_facturations = number_format($total_facturations, 2, '.', ',');

        return view('operations.payrolls-movements.create-facturations-invoices', compact('movement', 'entries', 'total_entries', 'facturations', 'total_facturations'));
    }

    public function storeFacturationInvoices(Request $request)
    {
        for($i=0; $i<count($request->facturation_id); $i++){
            $destinationPath = public_path() . '/uploads/facturations-invoices/';

            $file_temp = $request->file('facturation_invoices')[$i];
            $extension = $file_temp->getClientOriginalExtension() ?: 'pdf';
            $safeName = str_random(40).'.'.$extension;

            $entry = PayrollsMovementsFacturations::find($request->facturation_id[$i]);
            $entry->invoice = $safeName;
            $entry->save();

            $file_temp->move($destinationPath, $safeName);
        }

        $count = PayrollsMovementsFacturations::where('movement', $request->movement_id)->where('invoice', '')->count();
        if($count == 0){
            $movement = PayrollsMovements::find($request->movement_id);
            $movement->facturation_invoices = 2;
            $movement->save();
        }

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento facturado exitosamente');
    }

    /**
    * Estatus 4 - Pasa a Bancos para que suban los comprobantes de los pagos
    **/

    public function showFacturationsPayment($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);
        
        $entries = PayrollsMovementsEntries::where('movement', $id)->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollsMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');
        
        $facturations = PayrollsMovementsFacturations::where('movement', $id)->get();
        foreach($facturations as $facturation){
            $facturation->company_emit = Companies::find($facturation->company_emit)->name;
            $facturation->company_to = Companies::find($facturation->company_to)->name;
            $facturation->quantity = number_format($facturation->quantity, 2, '.', ',');
        }
        $total_facturations = PayrollsMovementsFacturations::where('movement', $id)->where('final_account', 1)->sum('quantity');
        $total_facturations = number_format($total_facturations, 2, '.', ',');

        $facturations_receipts = PayrollsMovementsFacturations::where('movement', $id)->where('status', 2)->count();

        return view('operations.payrolls-movements.show-facturations-payment', compact('movement', 'entries', 'total_entries', 'facturations', 'total_facturations', 'facturations_receipts'));
    }

    public function storeFacturationsPayment(Request $request)
    {
        for($i=0; $i<count($request->paymeny_check); $i++){
            $movement = PayrollsMovementsFacturations::find($request->paymeny_check[$i]);
            $movement->receipt = 1;
            $movement->save();
        }

        $movements = PayrollsMovementsFacturations::where('movement', $request->movement_id)->where('receipt', 0)->count();

        if($movements == 0){
            $movement = PayrollsMovements::find($request->movement_id);
            $movement->status = 5;
            $movement->facturation_payments = 1;
            $movement->save();
        }

        return Redirect::to('directs-movements')->with('success', 'Movimiento terminado exitosamente');
    }

    public function showOutputsReceipts($id)
    {
        $movement = PayrollssMovements::find($id);
        $movement->status = $this->movementStatus($movement->status);
        
        $entries = PayrollssMovementsEntries::where('movement', $id)->get();
        foreach($entries as $entry){
            $entry->company = Companies::find($entry->company)->name;
            $entry->quantity = number_format($entry->quantity, 2, '.', ',');
        }
        $total_entries = PayrollssMovementsEntries::where('movement', $id)->sum('quantity');
        $total_entries = number_format($total_entries, 2, '.', ',');
        
        $outputs = PayrollssMovementsOutputs::where('movement', $id)->get();
        foreach($outputs as $output){
            $output->quantity = number_format($output->quantity, 2, '.', ',');
        }
        $total_outputs = PayrollssMovementsOutputs::where('movement', $id)->sum('quantity');
        $total_outputs = number_format($total_outputs, 2, '.', ',');
        
        $facturations = PayrollssMovementsFacturations::where('movement', $id)->get();
        foreach($facturations as $facturation){
            $facturation->company_emit = Companies::find($facturation->company_emit)->name;
            $facturation->company_to = Companies::find($facturation->company_to)->name;
            $facturation->quantity = number_format($facturation->quantity, 2, '.', ',');
        }
        $total_facturations = PayrollssMovementsFacturations::where('movement', $id)->where('final_account', 1)->sum('quantity');
        $total_facturations = number_format($total_facturations, 2, '.', ',');

        $facturations_receipts = PayrollssMovementsFacturations::where('movement', $id)->where('receipt', '>', 0)->count();

        return view('operations.payrolls-movements.show-outputs-receipts', compact('movement', 'entries', 'total_entries', 'outputs', 'total_outputs', 'facturations', 'total_facturations', 'facturations_receipts'));
    }

    public function storeOutputsReceipts(Request $request)
    {
        for($i=0; $i<count($request->outputs_id); $i++){
            if($file_temp = $request->file('receipts')[$i]){
                $destinationPath = public_path() . '/uploads/outputs-receipts/';

                $extension = $file_temp->getClientOriginalExtension() ?: 'pdf';
                $safeName = str_random(40).'.'.$extension;

                $output = PayrollssMovementsOutputs::find($request->outputs_id[$i]);
                $output->receipt = $safeName;
                $output->save();

                $file_temp->move($destinationPath, $safeName);
            }
        }

        $count = PayrollssMovementsOutputs::where('movement', $request->movement_id)->where('receipt', '')->count();
        if($count == 0){
            $movement = PayrollssMovements::find($request->movement_id);
            $movement->status = 5;
            $movement->save();
        }

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento facturado exitosamente');
    }

    public function facturationsRollback($id)
    {
        $movement = PayrollsMovements::find($id);
        $movement->status = 3;
        $movement->save();

        $facturations = PayrollsMovementsFacturations::where('movement', $id)->get();
        foreach($facturations as $facturation){
            if($facturation->invoice != '' || $facturation->invoice != null){
                unlink(public_path() . '/uploads/facturations-invoices/' . $facturation->invoice);
            }
            $facturation->delete();
        }

        return Redirect::to('payrolls-movements')->with('success', 'Movimiento regresado exitosamente');
    }

    public function movementRollback($id)
    {
        $movement = PayrollsMovements::find($id);

        $message = 'Movimiento regresado exitosamente';

        if($movement->status == 4){
            $movement->status = 3;
            $movement->facturation_invoices = 0;
            $movement->facturation_payments = 0;
            $movement->save();

            $facturations = PayrollsMovementsFacturations::where('movement', $id)->get();
            foreach($facturations as $facturation){
                if($facturation->invoice != '' && $facturation->invoice != null){
                    unlink(public_path() . '/uploads/facturations-invoices/' . $facturation->invoice);
                }
                $facturation->delete();
            }
        }else if($movement->status == 3){
            $movement->status = 2;
            $movement->save();

            $entries = PayrollsMovementsEntries::where('movement', $id)->get();
            foreach($entries as $entry){
                $entry->status = 2;
                $entry->save();
            }
        }else if($movement->status == 2){
            $movement->status = 1;
            $movement->save();

            $entries = PayrollsMovementsEntries::where('movement', $id)->get();
            foreach($entries as $entry){
                if($entry->invoice != '' && $entry->invoice != null){
                    unlink(public_path() . '/uploads/entries-invoices/' . $entry->invoice);
                    $entry->invoice = '';
                }
                $entry->status = 1;
                $entry->save();
            }
        }else if($movement->status == 1){
            $movement->delete();

            $entries = PayrollsMovementsEntries::where('movement', $id)->get();
            foreach($entries as $entry){
                $entry->delete();
            }

            $message = 'Movimiento eliminado exitosamente';
        }

        return Redirect::to('payrolls-movements')->with('success', $message);
    }

    /**
    * Estatus 5 - Finaliza el proceso
    **/

    public function deletePaymentEntry($id)
    {
        $message = 'Pagos eliminados exitosamente';

        $entries = PayrollsMovementsEntries::where('movement', $id)->get();
        foreach($entries as $entry){
            $entry->status = 2;
            $entry->save();
        }

        return Redirect::to('payrolls-movements')->with('success', $message);
    }
}
