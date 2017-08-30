<div class="form-group col-md-6">
    {{ Form::select('', $companies, null, ['id' => 'facturation-emit-input', 'class' => 'form-control', 'placeholder' => 'Dispersora...']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('', null, ['id' => 'facturation-bank-emit-input', 'class' => 'form-control', 'placeholder' => 'Banco / Cuenta Dispersora']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::select('', $companies, null, ['id' => 'facturation-to-input', 'class' => 'form-control', 'placeholder' => 'Recibe...']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('', null, ['id' => 'facturation-bank-destiny-input', 'class' => 'form-control', 'placeholder' => 'Banco / Cuenta Recibe']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('', null, ['id' => 'facturation-quantity-input', 'class' => 'form-control money-input', 'placeholder' => 'Monto']) }}
</div>
<div class="checkbox col-md-6">
    <label>
        {{ Form::checkbox('', 1, false, ['id' => 'facturation-final-account']) }} Cuenta Final
    </label>
</div>
<div class="form-group text-right">
    {{ Form::button('Agregar', ['id' => 'add-facturation', 'class' => 'btn btn-primary']) }}
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed" id="facturation-table">
        <thead>
            <tr>
                <th class="text-center">Dispersora</th>
                <th class="text-center">Banco / Cuenta Dispersora</th>
                <th class="text-center">Recibe</th>
                <th class="text-center">Banco / Cuenta Recibe</th>
                <th class="text-center">Monto</th>
                <th class="text-center">Cuenta Final</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="4">Total</th>
                <th class="text-right"><input type="hidden" name="facturation_total" id="facturation_total" value="0" /><span id="facturation-table-total">$0.00</span></th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    </table>
</div>
<hr>
