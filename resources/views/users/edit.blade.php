@extends('layout.master')

@section('title')
    Editar Usuario
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
                    <i class="fa fa-pencil-square"></i> Editar Usuario
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil-square fa-fw"></i> Editar Usuario</h3>
                </div>
                <div class="panel-body">
                    {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}
                        {{ Form::token() }}
                        @include('users.forms.user')
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
    {{ Html::script('assets/js/users/form.js') }}
@endsection
