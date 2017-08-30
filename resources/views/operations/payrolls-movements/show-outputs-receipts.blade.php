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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>Cliente</th>
                                    <td>{{ $movement->customer }}</td>
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
                                    <th class="text-center">Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $entry)
                                    <tr>
                                        <td>{{ $entry->company }}</td>
                                        <td class="text-right">${{ $entry->quantity }}</td>
                                        <td>{{ $entry->bank }}</td>
                                        <td>{{ $entry->account }}</td>
                                        <td class="text-center">
                                            {{ link_to(URL('/uploads/entries-invoices/'. $entry->invoice), 'Factura', ['class' => 'btn btn-info', 'target' => '_blank']) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right">Total</td>
                                    <td class="text-right">${{ $total_entries }}</td>
                                    <td colspan="3"></td>
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
                                    <th class="text-center">Factura</th>
                                    <th class="text-center">Pago</th>
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
                                        <td class="text-center">
                                            @if($facturation->invoice != '' || $facturation->invoice != null)
                                                {{ link_to(URL('/uploads/facturations-invoices/'. $facturation->invoice), 'Factura', ['class' => 'btn btn-info', 'target' => '_blank']) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($facturation->receipt == 1)
                                                <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="4">Total</td>
                                    <td class="text-right">${{ $total_facturations }}</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <h3 class="panel-title">Salidas</h3><br>

                    {{ Form::open(['url' => 'payrolls-movements/outputs-receipts', 'method' => 'post', 'id' => 'form-facturation', 'files' => true]) }}
                        {{ Form::token() }}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-center">Dispersora</th>
                                        <th class="text-center">Banco / Cuenta Dispersora</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Recibe</th>
                                        <th class="text-center">Banco / Cuenta Recibe</th>
                                        <th class="text-center">Comentario</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($outputs as $output)
                                        <tr>
                                            <td>{{ $output->disperser }}</td>
                                            <td>{{ $output->bank_origen }}</td>
                                            <td>{{ $output->type }}</td>
                                            <td class="text-right">${{ $output->quantity }}</td>
                                            <td>{{ $output->company }}</td>
                                            <td>{{ $output->bank_destiny }}</td>
                                            <td>{{ $output->comment }}</td>
                                            @if($output->receipt == '' || $output->receipt == null)
                                                <td>
                                                    <div class="form-group">
                                                        {{ Form::hidden('outputs_id[]', $output->id) }}
                                                        {{ Form::file('receipts[]') }}
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    {{ link_to(URL('/uploads/outputs-receipts/'. $output->receipt), 'Factura', ['class' => 'btn btn-info', 'target' => '_blank']) }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td class="text-right">${{ $total_outputs }}</td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                {{ Form::button('Guardar', ['id' => 'submit-btn', 'class' => 'btn btn-success']) }}
                            </div>
                        </div>
                        {{ Form::hidden('movement_id', $movement->id) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    {{ Html::script('assets/js/operations/payrolls-movements/outputs-receipts.js') }}
@endsection
