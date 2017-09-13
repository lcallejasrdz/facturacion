@extends('layout.master')

@section('title')
    Dashboard
@endsection

@section('styles')
    {{ Html::style('https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css') }}
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard <small>Movimientos Pendientes</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-text fa-fw"></i> Lista de Movimientos Directos</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="directs-table">
                            <thead>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Creado</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-text fa-fw"></i> Lista de Movimientos Simples</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="simples-table">
                            <thead>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Creado</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-text fa-fw"></i> Lista de Movimientos Nóminas</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="payrolls-table">
                            <thead>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Usuario</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Creado</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-text fa-fw"></i> Lista de Préstamos</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="lendings-table">
                            <thead>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Empresa</th>
                                <th>Monto</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Creado</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    {{ Html::script('https://code.jquery.com/jquery-1.10.2.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js') }}
    {{ Html::script('assets/js/dashboard/tables.js') }}
@endsection
