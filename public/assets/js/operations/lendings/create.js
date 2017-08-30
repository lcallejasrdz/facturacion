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
	var company_emit = $('#company_emit').val();
	var bank_emit = $('#bank_emit').val();
	var company_to = $('#company_to').val();
	var bank_destiny = $('#bank_destiny').val();
	var quantity = $('#quantity').val();

	if(company_emit == '' || bank_emit == '' || company_to == '' || bank_destiny == '' || quantity == '')
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(company_emit == ''){
						alert+= '<li>El campo cliente es obligatorio</li>';
					}

					if(bank_emit == ''){
						alert+= '<li>El campo banco / cuenta cliente es obligatorio</li>';
					}

					if(company_to == ''){
						alert+= '<li>El campo empresa es obligatorio</li>';
					}

					if(bank_destiny == ''){
						alert+= '<li>El campo banco / cuenta empresa es obligatorio</li>';
					}

					if(quantity == ''){
						alert+= '<li>El campo monto es obligatorio</li>';
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