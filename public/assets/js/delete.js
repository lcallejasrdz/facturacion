function DeleteShow(id, name, title, url){
    $('#modalTitle').text(title);
    $('#modalUrl').val(url);
    $('#modalName').text(name);
    $('#modalDelete').val(id);
    $('#modalId').val(id);
}

function DeleteAction(btn){
    var modal_url = $('#modalUrl').val();
    var route = "/"+modal_url+"/"+btn.value;
    var token = $('#token').val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(){
            document.location.href="/"+modal_url;
        }
    });
}