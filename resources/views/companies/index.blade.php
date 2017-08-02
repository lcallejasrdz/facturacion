@extends('layout.master')

@section('title')
    Empresas
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
                <li class="active">
                    <i class="fa fa-building"></i> Empresas
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-building fa-fw"></i> Lista de Empresas</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="table">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dispersora</th>
                                <th>Creado</th>
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
    @include('modals.delete')
@endsection

@section('scripts')
    {{ Html::script('https://code.jquery.com/jquery-1.10.2.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js') }}
    {{ Html::script('assets/js/delete.js') }}
    {{ Html::script('assets/js/companies/index.js') }}
@endsection
