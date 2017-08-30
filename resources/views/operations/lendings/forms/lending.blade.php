<div class="form-group col-md-6">
    {{ Form::text('company_emit', old('company_emit'), ['id' => 'company_emit', 'class' => 'form-control', 'placeholder' => 'Cliente']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('bank_emit', old('bank_emit'), ['id' => 'bank_emit', 'class' => 'form-control', 'placeholder' => 'Banco / Cuenta Cliente']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::select('company_to', $companies, old('company_to'), ['id' => 'company_to', 'class' => 'form-control', 'placeholder' => 'Empresa receptora...']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('bank_destiny', old('bank_destiny'), ['id' => 'bank_destiny', 'class' => 'form-control', 'placeholder' => 'Banco / Cuenta Empresa']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('quantity', null, ['id' => 'quantity', 'class' => 'form-control money-input', 'placeholder' => 'Monto']) }}
</div>
<div class="form-group col-md-12">
    {{ Form::textarea('comment', null, ['id' => 'comment', 'class' => 'form-control', 'placeholder' => 'Comentario']) }}
</div>
<hr>
