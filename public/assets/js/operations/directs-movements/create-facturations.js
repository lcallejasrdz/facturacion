$('#add-facturation').click(function(){
	var facturation_emit_input = $('#facturation-emit-input').val();
	var facturation_emit_input_text = $('#facturation-emit-input option:selected').text();
	var facturation_bank_emit_input = $('#facturation-bank-emit-input').val();
	var facturation_to_input = $('#facturation-to-input').val();
	var facturation_to_input_text = $('#facturation-to-input option:selected').text();
	var facturation_bank_destiny_input = $('#facturation-bank-destiny-input').val();
	var facturation_quantity_input = $('#facturation-quantity-input').val();
	facturation_quantity_input = number_format_rollback(facturation_quantity_input);
	var facturation_final_account = $('#facturation-final-account:checked').length;

	var facturation_table_total = $('#facturation-table-total').html();
	facturation_table_total = number_format_rollback(facturation_table_total);

	if(facturation_emit_input == '' || facturation_bank_emit_input == '' || facturation_to_input == '' || facturation_bank_destiny_input == '' || (facturation_quantity_input == '' || isNumber(facturation_quantity_input) == false))
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(facturation_emit_input == ''){
						alert+= '<li>El campo emite es obligatorio</li>';
					}

					if(facturation_bank_emit_input == ''){
						alert+= '<li>El campo banco / cuenta emite es obligatorio</li>';
					}

					if(facturation_to_input == ''){
						alert+= '<li>El campo recibe es obligatorio</li>';
					}

					if(facturation_bank_destiny_input == ''){
						alert+= '<li>El campo banco / cuenta recibe es obligatorio</li>';
					}

					if(facturation_quantity_input == ''){
						alert+= '<li>El campo monto es obligatorio</li>';
					}else if(isNumber(facturation_quantity_input) == false){
						alert+= '<li>El campo monto debe ser numérico</li>';
					}
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	else
	{
		$.get(direction+"/is-facturation/"+facturation_to_input, function(response, company){
			if(response == 1){
				facturation_final_account = response;
			}

			$('#ajax-alert').html('');
			$('#facturation-emit-input').val('');
			$('#facturation-bank-emit-input').val('');
			$('#facturation-to-input').val('');
			$('#facturation-bank-destiny-input').val('');
			$('#facturation-quantity-input').val('');
			$('#facturation-final-account').prop( "checked", false );

			//pasar los valores a la tabla
			var rows = $('#facturation-table tbody').html();

			rows += '<tr>';
				rows += '<td>';
					rows += '<input type="hidden" name="facturation_company_emit[]" value="'+ facturation_emit_input +'" />';
					rows += facturation_emit_input_text;
				rows += '</td>';
				rows += '<td>';
					rows += '<input type="hidden" name="facturation_bank_emit[]" value="'+ facturation_bank_emit_input +'" />';
					rows += facturation_bank_emit_input;
				rows += '</td>';
				rows += '<td>';
					rows += '<input type="hidden" name="facturation_company_to[]" value="'+ facturation_to_input +'" />';
					rows += facturation_to_input_text;
				rows += '</td>';
				rows += '<td>';
					rows += '<input type="hidden" name="facturation_bank_destiny[]" value="'+ facturation_bank_destiny_input +'" />';
					rows += facturation_bank_destiny_input;
				rows += '</td>';
				rows += '<td class="text-right">';
					rows += '<input type="hidden" name="facturation_quantity[]" value="'+ facturation_quantity_input +'" />';
					rows += number_format(facturation_quantity_input, 2);
				rows += '</td>';
				rows += '<td class="text-center">';
					rows += '<input type="hidden" name="facturation_final_account[]" value="'+ facturation_final_account +'" />';
					if(facturation_final_account == 1){
						rows += '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>';
					}
				rows += '</td>';
				rows += '<td>';
					rows += '<button type="button" class="btn btn-danger" onClick="deleteRowFacturation(this, '+ facturation_quantity_input +', '+ facturation_final_account +')">Eliminar</button>';
				rows += '</td>';
			rows += '</tr>';

			$('#facturation-table tbody').html(rows);
			if(facturation_final_account == 1){
				var total = parseFloat(facturation_table_total) + parseFloat(facturation_quantity_input);
				$('#facturation_total').val(total);
			}else{
				var total = parseFloat(facturation_table_total);
			}
			$('#facturation-table-total').html(number_format(total, 2));
	    });
	}
});

function deleteRowFacturation(btn, amount, disperser){
	var facturation_table_total = $('#facturation-table-total').html();
	facturation_table_total = number_format_rollback(facturation_table_total);

	if(disperser == 1){
		var total = parseFloat(facturation_table_total) - parseFloat(amount);
	}else{
		var total = parseFloat(facturation_table_total);
	}

	$('#facturation_total').val(total);
	$('#facturation-table-total').html(number_format(total, 2));

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
	var amount_total = $('#amount_total').val();
	amount_total = number_format_rollback(amount_total);
	var facturation_total = $('#facturation_total').val();

	if(parseFloat(facturation_total) != parseFloat(amount_total))
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(parseFloat(facturation_total) != parseFloat(amount_total)){
						alert+= '<li>El monto total facturado no puede ser diferente al monto total de entrada</li>';
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