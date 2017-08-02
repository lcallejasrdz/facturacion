@extends('layout.master')

@section('title')
    Editar Empresa
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
                    <i class="fa fa-pencil-square"></i> Editar Empresa
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil-square fa-fw"></i> Editar Empresa</h3>
                </div>
                <div class="panel-body">
                    {!! Form::model($company, ['route' => ['companies.update', $company], 'method' => 'put']) !!}
                        {{ Form::token() }}
                        @include('companies.forms.company')
                        <div class="form-group text-right">
                            {{ Form::submit('Actualizar', ['id' => 'submit', 'class' => 'btn btn-success']) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
@endsection
