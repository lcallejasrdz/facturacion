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

$('#add-output').click(function(){
	var output_company_input = $('#output-company-input').val();
	var output_bank_destiny_input = $('#output-bank-destiny-input').val();
	var output_type_input = $('#output-type-input option:selected').val();
	var output_type_input_text = $('#output-type-input option:selected').text();
	var output_quantity_input = $('#output-quantity-input').val();
	output_quantity_input = number_format_rollback(output_quantity_input);
	var output_disperser_input = $('#output-disperser-input').val();
	var output_bank_origen_input = $('#output-bank-origen-input').val();
	var output_comment_input = $('#output-comment-input').val();

	var output_table_total = $('#output-table-total').html();
	output_table_total = number_format_rollback(output_table_total);

	if(output_company_input == '' || output_bank_destiny_input == '' || output_type_input == '' || (output_quantity_input == '' || isNumber(output_quantity_input) == false) || output_disperser_input == '' || output_bank_origen_input == '')
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(output_company_input == ''){
						alert+= '<li>El campo recibe es obligatorio</li>';
					}
					if(output_bank_destiny_input == ''){
						alert+= '<li>El campo banco / cuenta recibe es obligatorio</li>';
					}
					if(output_type_input == ''){
						alert+= '<li>El campo tipo es obligatorio</li>';
					}

					if(output_quantity_input == ''){
						alert+= '<li>El campo monto es obligatorio</li>';
					}else if(isNumber(output_quantity_input) == false){
						alert+= '<li>El campo monto debe ser numérico</li>';
					}

					if(output_disperser_input == ''){
						alert+= '<li>El campo factura es obligatorio</li>';
					}
					if(output_bank_origen_input == ''){
						alert+= '<li>El campo banco / cuenta factura es obligatorio</li>';
					}
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	else
	{
		$('#ajax-alert').html('');
		$('#output-company-input').val('');
		$('#output-bank-destiny-input').val('');
		$('#output-type-input').val('');
		$('#output-quantity-input').val('');
		$('#output-disperser-input').val('');
		$('#output-bank-origen-input').val('');
		$('#output-comment-input').val('');

		//pasar los valores a la tabla
		var rows = $('#output-table tbody').html();

		rows += '<tr>';
			rows += '<td>';
				rows += '<input type="hidden" name="output_disperser[]" value="'+ output_disperser_input +'" />';
				rows += output_disperser_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="output_bank_origen[]" value="'+ output_bank_origen_input +'" />';
				rows += output_bank_origen_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="output_type[]" value="'+ output_type_input +'" />';
				rows += output_type_input_text;
			rows += '</td>';
			rows += '<td class="text-right">';
				rows += '<input type="hidden" name="output_quantity[]" value="'+ output_quantity_input +'" />';
				rows += number_format(output_quantity_input, 2);
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="output_company[]" value="'+ output_company_input +'" />';
				rows += output_company_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="output_bank_destiny[]" value="'+ output_bank_destiny_input +'" />';
				rows += output_bank_destiny_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<input type="hidden" name="output_comment[]" value="'+ output_comment_input +'" />';
				rows += output_comment_input;
			rows += '</td>';
			rows += '<td>';
				rows += '<button type="button" class="btn btn-danger" onClick="deleteRowOutput(this, '+ output_quantity_input +')">Eliminar</button>';
			rows += '</td>';
		rows += '</tr>';

		$('#output-table tbody').html(rows);
		var total = parseFloat(output_table_total) + parseFloat(output_quantity_input);
		$('#output_total').val(total);
		$('#output-table-total').html(number_format(total, 2));
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

function deleteRowOutput(btn, amount){
	var output_table_total = $('#output-table-total').html();
	output_table_total = number_format_rollback(output_table_total);

	var total = parseFloat(output_table_total) - parseFloat(amount);
	$('#output_total').val(total);
	$('#output-table-total').html(number_format(total, 2));

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
	var output_total = $('#output_total').val();

	if(customer == '' || ((entry_total == 0 || entry_total == '') && (output_total == 0 || output_total == '')))
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(customer == ''){
						alert+= '<li>El campo cliente es obligatorio</li>';
					}

					if((entry_total == 0 || entry_total == '') && (output_total == 0 || output_total == '')){
						alert+= '<li>El monto de entrada o el monto de salida debe ser diferente de $0.00</li>';
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