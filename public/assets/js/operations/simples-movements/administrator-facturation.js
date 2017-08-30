$('#submit-btn').click(function(){
	var values = $("input[name='invoices[]']").map(function(){
		return $(this).val();
	}).get();

	var control = 1;

	for(i=0; i<values.length; i++){
		if(values[i] == '' || values[i] == null){
			control = 0;
		}
	}

	if(control == 0)
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					alert+= '<li>Todas las facturas son obligatorias</li>';
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}else{
		$('#form-facturation').submit();
	}
});