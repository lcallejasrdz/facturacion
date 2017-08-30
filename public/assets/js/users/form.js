$( document ).ready(function() {
	companiesContainer();
});

$('#permission').change(function(){
	companiesContainer();
});

function companiesContainer(){
	var permission = $('#permission').val();
    if(permission == 3){
    	$('#companies-container').show();
    }else{
    	$('#companies-container').hide();
    }
}