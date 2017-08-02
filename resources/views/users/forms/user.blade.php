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
    	<p class="help-block">Si no quieres cambiar la contraseña deja en blanco la contraseña.</p>
    @endif
</div>
<div class="form-group">
    {{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Confirmación de Contraseña']) }}
</div>
<div class="form-group">
    {{ Form::select('permission', $permissions, old('permission'), ['id' => 'permission', 'class' => 'form-control', 'placeholder' => 'Selecciona un Permiso...']) }}
</div>
