$('#submit-btn').click(function(){
	var facturation_invoices = 1;
	$("input[name='facturation_invoices[]']").each(function(){
	   	if($(this).val() == '' || $(this).val() == null){
	   		facturation_invoices = 0;
	   	}
	});

	if(facturation_invoices == 0)
	{
		var alert = '<div class="alert alert-danger alert-dismissible" role="alert">';
				alert += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					alert+= '<span aria-hidden="true">&times;</span>';
				alert+= '</button>';
				alert+= '<ul>';
					if(facturation_invoices == 0){
						alert+= '<li>Todas las facturas son obligatorias</li>';
					}
				alert+= '</ul>';
			alert+= '</div>';

		$('#ajax-alert').html(alert);
		$("html, body").animate({ scrollTop: 0 }, "slow");
	}else{
		$('#form-create').submit();
	}
});