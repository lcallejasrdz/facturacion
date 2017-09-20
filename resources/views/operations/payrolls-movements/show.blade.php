@extends('layout.master')

@section('title')
    Movimiento Nómina
@endsection

@section('styles')
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ URL::to('dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('payrolls-movements') }}">
                        <i class="fa fa-file-text"></i> Movimientos Nóminas
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-file-text"></i> {{ $movement->id }} - {{ $movement->customer }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-text fa-fw"></i> {{ $movement->id }} - {{ $movement->customer }}</h3>
                </div>
                <div class="panel-body">
                    @if($movement->status != 'Finalizado' && (Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4))
                        <div class="row">
                            <div class="col-md-12 text-right">
                                @if($movement->status == 'Administrador - Facturación')
                                    {{ Form::button('Eliminar Movimiento', ['id' => 'rollback-btn-modal', 'class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modalRollback']) }}
                                @else
                                    @if($movement->status == 'Bancos - Recepción de Pagos')
                                        {{ Form::button('Eliminar Pagos', ['id' => 'rollback-payment-btn-modal', 'class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modalRollbackPayment']) }}
                                    @endif
                                    {{ Form::button('Regresar Movimiento', ['id' => 'rollback-btn-modal', 'class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modalRollback']) }}
                                @endif
                            </div>
                        </div>

                        <br>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>Cliente</th>
                                    <td>{{ $movement->customer }}</td>
                                </tr>
                                <tr>
                                    <th>Estatus</th>
                                    <td>{{ $movement->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="panel-title">Entradas</h3><br>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-center">Empresa</th>
                                    <th class="text-center">Monto</th>
                                    <th class="text-center">Banco</th>
                                    <th class="text-center">Cuenta</th>
                                    @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4)
                                        <th class="text-center">Facturado</th>
                                    @endif
                                    @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 3 || Auth::user()->permission == 5 || Auth::user()->permission == 7)
                                        <th class="text-center">Factura</th>
                                    @endif
                                    <th class="text-center">Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>{{ $entry->company }}</td>
                                        <td class="text-right">${{ $entry->quantity }}</td>
                                        <td>{{ $entry->bank }}</td>
                                        <td>{{ $entry->account }}</td>
                                        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4)
                                            <td class="text-center">
                                                @if($entry->invoice != '' && $entry->invoice != null)
                                                    <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                                                @endif
                                            </td>
                                        @endif
                                        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 3 || Auth::user()->permission == 5 || Auth::user()->permission == 7)
                                            <td class="text-center">
                                                @if($entry->invoice != '' && $entry->invoice != null)
                                                    {{ link_to(URL('/uploads/entries-invoices/'. $entry->invoice), 'Factura', ['class' => 'btn btn-info', 'target' => '_blank']) }}
                                                @endif
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            @if($entry->status == 3)
                                                <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right">Total</td>
                                    <td class="text-right">${{ $total_entries }}</td>
                                    @if(Auth::user()->permission == 7)
                                        <td colspan="4"></td>
                                    @elseif(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 3)
                                        <td colspan="3"></td>
                                    @else
                                        <td colspan="2"></td>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <h3 class="panel-title">Dispersiones</h3><br>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-center">Dispersora</th>
                                    <th class="text-center">Banco / Cuenta Dispersora</th>
                                    <th class="text-center">Recibe</th>
                                    <th class="text-center">Banco / Cuenta Recibe</th>
                                    <th class="text-center">Monto</th>
                                    <th class="text-center">Cuenta Final</th>
                                    @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 3 || Auth::user()->permission == 5)
                                        <th class="text-center">Factura</th>
                                    @endif
                                    @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 5)
                                        <th class="text-center">Pago</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facturations as $facturation)
                                    <tr>
                                        <td>{{ $facturation->company_emit }}</td>
                                        <td>{{ $facturation->bank_emit }}</td>
                                        <td>{{ $facturation->company_to }}</td>
                                        <td>{{ $facturation->bank_destiny }}</td>
                                        <td class="text-right">${{ $facturation->quantity }}</td>
                                        @if($facturation->final_account == 1)
                                            <td class="text-center">
                                                <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                                            </td>
                                        @else
                                            <td class="text-center">
                                            </td>
                                        @endif
                                        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 3 || Auth::user()->permission == 5)
                                            <td class="text-center">
                                                @if($facturation->invoice != '' && $facturation->invoice != null)
                                                    {{ link_to(URL('/uploads/facturations-invoices/'. $facturation->invoice), 'Factura', ['class' => 'btn btn-info', 'target' => '_blank']) }}
                                                @endif
                                            </td>
                                        @endif
                                        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 5)
                                            <td>
                                                @if($facturation->receipt != 0)
                                                    <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="4">Total</td>
                                    <td class="text-right">${{ $total_facturations }}</td>
                                    @if(Auth::user()->permission == 3)
                                        <td colspan="2"></td>
                                    @elseif(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 4 || Auth::user()->permission == 5)
                                        <td colspan="3"></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Modal -->
    <div class="modal fade" id="modalRollback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Regresar Movimiento</h4>
                </div>
                <div class="modal-body">
                    @if($movement->status == 'Administrador - Facturación')
                        ¿Seguro que deseas eliminar este movimiento?
                    @else
                        ¿Seguro que deseas regresar este movimiento a un paso anterior?
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    @if($movement->status == 'Administrador - Facturación')
                        {{ link_to('payrolls-movements/'. $movement->id .'/movement-rollback', 'Eliminar Movimiento', ['id' => 'rollback-btn', 'class' => 'btn btn-primary']) }}
                    @else
                        {{ link_to('payrolls-movements/'. $movement->id .'/movement-rollback', 'Regresar Movimiento', ['id' => 'rollback-btn', 'class' => 'btn btn-primary']) }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRollbackPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Regresar Movimiento</h4>
                </div>
                <div class="modal-body">
                    ¿Seguro que deseas eliminar los pagos?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    {{ link_to('payrolls-movements/'. $movement->id .'/delete-payment-entry', 'Eliminar Pagos', ['id' => 'rollback-btn-payment', 'class' => 'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
