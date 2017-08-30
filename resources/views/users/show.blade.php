@extends('layout.master')

@section('title')
    Usuario
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
                    <a href="{{ URL::to('users') }}">
                        <i class="fa fa-user"></i> Usuarios
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-user"></i> {{ $user->name }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> {{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>Usuario</th>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Correo Electrónico</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Permisos</th>
                                    <td>{{ $user->permissionname }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($user->permission == 3)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Empresas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>{{ $company->company }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
@endsection
