@extends('layout.master')

@section('title')
    Préstamo
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
                    <a href="{{ URL::to('lendings') }}">
                        <i class="fa fa-file-text"></i> Préstamos
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-file-text"></i> {{ $movement->id }} - {{ $movement->company_emit }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-text fa-fw"></i> {{ $movement->id }} - {{ $movement->company_emit }}</h3>
                </div>
                <div class="panel-body">
                    @if($movement->status != 'Finalizado' && (Auth::user()->permission == 1 || Auth::user()->permission == 2))
                        <div class="row">
                            <div class="col-md-12 text-right">
                                @if($movement->status == 'Bancos - Pago')
                                    {{ Form::button('Eliminar Movimiento', ['id' => 'rollback-btn-modal', 'class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modalRollback']) }}
                                @else
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
                                    <td>{{ $movement->company_emit }}</td>
                                </tr>
                                <tr>
                                    <th>Banco / Cuenta Cliente</th>
                                    <td>{{ $movement->bank_emit }}</td>
                                </tr>
                                <tr>
                                    <th>Empresa</th>
                                    <td>{{ $movement->company_to }}</td>
                                </tr>
                                <tr>
                                    <th>Banco / Cuenta Empresa</th>
                                    <td>{{ $movement->bank_destiny }}</td>
                                </tr>
                                <tr>
                                    <th>Monto</th>
                                    <td>${{ $movement->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Comentario</th>
                                    <td>{{ $movement->comment }}</td>
                                </tr>
                                <tr>
                                    <th>Pago</th>
                                    <td>
                                        @if($movement->status == 'Bancos - Comprobante' || $movement->status == 'Finalizado')
                                            <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Comprobante</th>
                                    <td>
                                        @if($movement->receipt != '' && $movement->receipt != null)
                                            {{ link_to(URL('/uploads/lendings-receipts/'. $movement->receipt), 'Comprobante', ['class' => 'btn btn-info', 'target' => '_blank']) }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
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
                    @if($movement->status == 'Bancos - Pago')
                        ¿Seguro que deseas eliminar este movimiento?
                    @else
                        ¿Seguro que deseas regresar este movimiento a un paso anterior?
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    @if($movement->status == 'Bancos - Pago')
                        {{ link_to('lendings/'. $movement->id .'/movement-rollback', 'Eliminar Movimiento', ['id' => 'rollback-btn', 'class' => 'btn btn-primary']) }}
                    @else
                        {{ link_to('lendings/'. $movement->id .'/movement-rollback', 'Regresar Movimiento', ['id' => 'rollback-btn', 'class' => 'btn btn-primary']) }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
