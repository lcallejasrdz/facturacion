$(function() {
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: direction+'/lendings/dataindex',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'company_emit', name: 'company_emit' },
            { data: 'company_to', name: 'company_to' },
            { data: 'quantity', name: 'quantity' },
            { data: 'status', name: 'status' },
            { data: 'date', name:'date', searchable: false },
            { data: 'created_at', name:'created_at', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
