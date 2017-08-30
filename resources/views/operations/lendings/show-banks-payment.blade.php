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
                    {{ Form::open(['url' => 'lendings/banks-payment', 'method' => 'post', 'id' => 'form-payments']) }}
                        {{ Form::token() }}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <tbody>
                                    <tr>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Banco / Cuenta Cliente</th>
                                        <th class="text-center">Empresa</th>
                                        <th class="text-center">Banco / Cuenta Empresa</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Comentario</th>
                                        <th class="text-center">Pago</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $movement->company_emit }}</td>
                                        <td>{{ $movement->bank_emit }}</td>
                                        <td>{{ $movement->company_to }}</td>
                                        <td>{{ $movement->bank_destiny }}</td>
                                        <td class="text-right">${{ $movement->quantity }}</td>
                                        <td>{{ $movement->comment }}</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    {{ Form::checkbox('paymeny_check[]', $movement->id, false) }} Pago
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
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
    {{ Html::script('assets/js/operations/lendings/banks-payment.js') }}
@endsection
