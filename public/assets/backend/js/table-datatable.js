$(function () {
    "use strict";

    $(document).ready(function () {
        $('#example').DataTable({
            lengthMenu: [
                [30, 60, 90, -1],
                [30, 60, 90, 'All'],
            ],
            scrollX: true,
            ordering: false,
        });
    });


    $(document).ready(function () {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });


});
