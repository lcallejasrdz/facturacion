$('#submit-btn').click(function(){
	var values = $("input[name='receipts[]']").map(function(){
		return $(this).val();
	}).get();

	var control = 0;

	for(i=0; i<values.length; i++){
		if(values[i] != '' && values[i] != null){
			control = 1;
		}
	}

	if(control == 0)
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					alert+= '<li>Al menos un comprobante debe estar cargado para subir.</li>';
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}else{
		$('#form-facturation').submit();
	}
});