<div class="form-group">
    {{ Form::text('username', old('username'), ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'Usuario']) }}
</div>
<div class="form-group">
    {{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nombre']) }}
</div>
<div class="form-group">
    {{ Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Correo Electrónico']) }}
</div>
<div class="form-group">
    {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña']) }}
    @if(!Request::is('users/create'))
    	<p class="help-block">Si no quieres cambiar la contraseña deja en blanco este campo.</p>
    @endif
</div>
<div class="form-group">
    {{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Confirmación de Contraseña']) }}
    @if(!Request::is('users/create'))
        <p class="help-block">Si no quieres cambiar la contraseña deja en blanco este campo.</p>
    @endif
</div>
@if(Auth::user()->permission == 1 || Auth::user()->permission == 2)
    @if(!isset($user) || (isset($user) && Auth::user()->id != $user->id))
        <div class="form-group">
            {{ Form::select('permission', $permissions, old('permission'), ['id' => 'permission', 'class' => 'form-control', 'placeholder' => 'Selecciona un Permiso...']) }}
        </div>
        <div id="companies-container">
        	<hr>
        	<div class="form-group">
                {{ Form::label('companies', 'Selecciona las empresas del administrador...') }}
        		{{ Form::select('companies[]', $companies, old('companies[]', $companiesselected), ['id' => 'companies', 'class' => 'form-control', 'multiple' => true]) }}
        	</div>
        </div>
    @endif
@else
    {{ Form::hidden('permission', old('permission')) }}
    @foreach($companiesselected as $company)
        {{ Form::hidden('companies[]', $company) }}
    @endforeach
@endif
