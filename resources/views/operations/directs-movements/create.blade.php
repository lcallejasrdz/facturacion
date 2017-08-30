@extends('layout.master')

@section('title')
    Crear Movimiento Directo
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
                    <a href="{{ URL::to('directs-movements') }}">
                        <i class="fa fa-file-text"></i> Movimientos Directos
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-plus"></i> Crear Movimiento Directo
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-plus fa-fw"></i> Crear Movimiento Directo</h3>
                </div>
                <div class="panel-body">
                    {{ Form::open(['url' => 'directs-movements', 'method' => 'post', 'id' => 'form-create']) }}
                        {{ Form::token() }}
                        @include('operations.directs-movements.forms.direct-movement')
                        <div class="form-group text-right">
                            {{ Form::button('Registrar', ['id' => 'submit-btn', 'class' => 'btn btn-success']) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    {{ Html::script('assets/js/operations/directs-movements/create.js') }}
@endsection
