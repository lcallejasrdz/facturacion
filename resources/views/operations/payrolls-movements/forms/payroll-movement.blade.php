<div class="form-group">
    {{ Form::text('customer', old('customer'), ['id' => 'customer', 'class' => 'form-control', 'placeholder' => 'Cliente']) }}
</div>
<hr>
<div class="form-group col-md-6">
    {{ Form::select('', $companies, null, ['id' => 'entry-to-input', 'class' => 'form-control', 'placeholder' => 'Empresa receptora...']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('', null, ['id' => 'entry-quantity-input', 'class' => 'form-control money-input', 'placeholder' => 'Monto']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('', null, ['id' => 'entry-bank-input', 'class' => 'form-control', 'placeholder' => 'Banco']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::text('', null, ['id' => 'entry-account-input', 'class' => 'form-control', 'placeholder' => 'Cuenta']) }}
</div>
<div class="form-group text-right">
    {{ Form::button('Agregar', ['id' => 'add-entry', 'class' => 'btn btn-primary']) }}
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed" id="entry-table">
        <thead>
            <tr>
                <th class="text-center">Empresa</th>
                <th class="text-center">Monto</th>
                <th class="text-center">Banco</th>
                <th class="text-center">Cuenta</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total</th>
                <th class="text-right"><input type="hidden" name="entry_total" id="entry_total" value="0" /><span id="entry-table-total">$0.00</span></th>
                <th colspan="3"></th>
            </tr>
        </tfoot>
    </table>
</div>
<hr>
