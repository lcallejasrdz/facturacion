<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/images/favicon.ico') }}" />
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>R-Net Systems | Login</title>

    <!-- Latest compiled and minified CSS -->
    {{ Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}

    {{ Html::style('assets/css/login.css') }}
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
          @include('alerts.ajax')
          @include('alerts.errors')
          @include('alerts.error')
          @include('alerts.success')
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4 login-container">
          <div class="jumbotron">
            {{ Form::open(['url' => 'login', 'method' => 'post']) }}
              <div class="text-center logo-container">
                <img src="{{ URL::to('assets/images/logo.png') }}" alt="">
              </div>
              <div class="form-group">
                {{ Form::text('user', null, ['id' => 'user', 'class' => 'form-control', 'placeholder' => 'Usuario']) }}
              </div>
              <div class="form-group">
                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña']) }}
              </div>
              <div class="form-group text-right">
                {{ Form::submit('Entrar', ['id' => 'submit', 'class' => 'btn btn-primary']) }}
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}
    <!-- Latest compiled and minified JavaScript -->
    {{ Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}
  </body>
</html>