$(document).ready(function() {
    $('#datatable').DataTable({
        dom: '<lf<t>ip>',
        responsive: true,
        columnDefs: [ {
            "targets"  : 'no-sort',
            "orderable": false,
        }],
        language: {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });

    $('.dataTables_filter input').attr('placeholder','Filtrar');

    $('.panel-datatable-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label");
    $('.panel-datatable-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label");

    $('.panel-footer .row .col-sm-6:eq(0)').append($(".dataTables_info"));
    $('.panel-footer .row .col-sm-6:eq(1)').append($(".dataTables_paginate"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right m0");

    $('.table-responsive-datatable').html($('#datatable').detach());

    $('[mask]').each(function () {
        $(this).mask($(this).attr('mask'));
    });
});