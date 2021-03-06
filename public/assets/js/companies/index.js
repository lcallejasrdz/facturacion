$(function() {
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: direction+'/companies/dataindex',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'disperser', name: 'disperser' },
            { data: 'created_at', name:'created_at', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
