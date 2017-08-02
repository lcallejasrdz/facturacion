@extends('layout.master')

@section('title')
    Empresas Eliminadas
@endsection

@section('styles')
    {{ Html::style('https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css') }}
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
                    <a href="{{ URL::to('companies') }}">
                        <i class="fa fa-building"></i> Empresas
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-trash"></i> Empresas Eliminadas
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-building fa-fw"></i> Lista de Empresas Eliminadas</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="table">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dispersora</th>
                                <th>Creado</th>
                                <th>Eliminado</th>
                                <th>Acciones</th>
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
    {{ Html::script('assets/js/companies/deleted.js') }}
@endsection
