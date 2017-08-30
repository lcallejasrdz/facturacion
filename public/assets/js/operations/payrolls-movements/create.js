$('#add-entry').click(function(){
	var entry_to_input = $('#entry-to-input').val();
	var entry_to_input_text = $('#entry-to-input option:selected').text();
	var entry_quantity_input = $('#entry-quantity-input').val();
	entry_quantity_input = number_format_rollback(entry_quantity_input);
	var entry_bank_input = $('#entry-bank-input').val();
	var entry_account_input = $('#entry-account-input').val();

	var entry_table_total = $('#entry-table-total').html();
	entry_table_total = number_format_rollback(entry_table_total);

	if(entry_to_input == '' || (entry_quantity_input == '' || isNumber(entry_quantity_input) == false) || entry_bank_input == '')
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(entry_to_input == ''){
						alert+= '<li>El campo empresa receptora es obligatorio</li>';
					}

					if(entry_quantity_input == ''){
						alert+= '<li>El campo monto es obligatorio</li>';
					}else if(isNumber(entry_quantity_input) == false){
						alert+= '<li>El campo monto debe ser numérico</li>';
					}

					if(entry_bank_input == ''){
						alert+= '<li>El campo banco es obligatorio</li>';
					}
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	else
	{
		$('#ajax-alert').html('');
		$('#entry-to-input').val('');
		$('#entry-quantity-input').val('');
		$('#entry-bank-input').val('');
		$('#entry-account-input').val('');

		//pasar los valores a la tabla
		var rows = $('#entry-table tbody').html();

		rows += '<tr>';
			rows += '<td>';
				rows += '<input type="hidden" name="entry_company[]" value="'+ entry_to_input +'" />';
				rows += entry_to_input_text;
			rows += '</td>';
			rows += '<td class="text-right">';
				rows += '<input type="hidden" name="entry_quantity[]" value="'+ entry_quantity_input +'" />';
				rows += number_format(entry_quantity_input, 2);
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="entry_bank[]" value="'+ entry_bank_input +'" />';
				rows += entry_bank_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="entry_account[]" value="'+ entry_account_input +'" />';
				rows += entry_account_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<button type="button" class="btn btn-danger" onClick="deleteRowEntry(this, '+ entry_quantity_input +')">Eliminar</button>';
			rows += '</td>';
		rows += '</tr>';

		$('#entry-table tbody').html(rows);
		var total = parseFloat(entry_table_total) + parseFloat(entry_quantity_input);
		$('#entry_total').val(total);
		$('#entry-table-total').html(number_format(total, 2));
	}
});

function deleteRowEntry(btn, amount){
	var entry_table_total = $('#entry-table-total').html();
	entry_table_total = number_format_rollback(entry_table_total);

	var total = parseFloat(entry_table_total) - parseFloat(amount);
	$('#entry_total').val(total);
	$('#entry-table-total').html(number_format(total, 2));

	btn.closest('tr').remove();
}

$(".money-input").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

$('#submit-btn').click(function(){
	var customer = $('#customer').val();
	var entry_total = $('#entry_total').val();

	if(customer == '' || (entry_total == 0 || entry_total == ''))
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(customer == ''){
						alert+= '<li>El campo cliente es obligatorio</li>';
					}

					if(entry_total == 0 || entry_total == ''){
						alert+= '<li>El monto total de entrada no puede ser 0</li>';
					}
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}else{
		$('#form-create').submit();
	}
});

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return '$'+parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    amount = amount_parts.join('.');
    return '$'+amount;
}

function number_format_rollback(amount) {
	amount = amount.replace(",", "");
	amount = amount.replace("$", "");

	return amount;
}