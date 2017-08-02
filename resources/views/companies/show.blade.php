@extends('layout.master')

@section('title')
    Empresa
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
                    <a href="{{ URL::to('companies') }}">
                        <i class="fa fa-building"></i> Empresas
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-building"></i> {{ $company->name }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-building fa-fw"></i> {{ $company->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed" id="table">
                            <tbody>
                                <tr>
                                    <th>Empresa</th>
                                    <td>{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <th>Dispersora</th>
                                    <td>{{ $company->disperser }}</td>
                                </tr>
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
@endsection
