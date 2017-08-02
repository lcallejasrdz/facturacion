<div class="form-group">
    {{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nombre']) }}
</div>
<div class="form-group">
    {{ Form::select('disperser', ['Si' => 'Si Factura', 'No' => 'No Factura'], old('disperser'), ['id' => 'disperser', 'class' => 'form-control', 'placeholder' => 'Selecciona una opción...']) }}
</div>
