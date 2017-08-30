$('#submit-btn').click(function(){
	var total_inputs_checked = $( "input[name='paymeny_check[]']:checked" ).length;

	if(total_inputs_checked <= 0)
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					alert+= '<li>Al menos un pago debe ser seleccionado</li>';
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}else{
		$('#form-payments').submit();
	}
});