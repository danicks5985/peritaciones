var dataTablePeritaciones;

$(function () {

    // Nombre taller
    $("#nameTaller").autocomplete({
        source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "Php/getTalleres.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#nameTaller').val(ui.item.label); // display the selected text
            $('#tallerId').val(ui.item.value); // save selected id to input
            return false;
        },
        focus: function (event, ui) {
            $("#nameTaller").val(ui.item.label);
            $("#tallerId").val(ui.item.value);
            return false;
        },
    });

    $("#nameCompania").autocomplete({
        source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "Php/getCompanias.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#nameCompania').val(ui.item.label); // display the selected text
            $('#companiaId').val(ui.item.value); // save selected id to input
            return false;
        },
        focus: function (event, ui) {
            $("#nameCompania").val(ui.item.label);
            $("#companiaId").val(ui.item.value);
            return false;
        },
    });

    $('.ui-autocomplete').addClass('vertical dropdown menu autoComplEstilos');


    $('#tbPeritaciones thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tbPeritaciones thead');

    dataTablePeritaciones = $('#tbPeritaciones').DataTable({
        dom: 'Blfrtip',
        autoWidth: false,
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
        },
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: "Php/getPeritaciones.php",
        },
        rowId: 'id',
        columns: [
            { name: 'nombre_taller', data: 'nombre_taller', className: "tdLeft" },
            { name: 'matricula', data: 'matricula', className: "tdLeft" },
            {
                name: 'f_peritacion',
                data: 'f_peritacion',
                className: "tdLeft",
                render: function (data, type, row, meta) {
                    if (type === 'sort') return data;
                    var fecha = data.split("-").reverse().join("-").replaceAll("-", "/")
                    return fecha;
                }
            },
            { name: 'nombre_compania', data: 'nombre_compania', className: "tdLeft" },
            { name: 'nombre_perito', data: 'nombre_perito', className: "tdLeft" },
            { name: 'estado', data: 'estado', className: "tdLeft" },
            {
                name: 'f_cierre',
                data: 'f_cierre',
                className: "tdLeft",
                render: function (data, type, row, meta) {
                    if (type === 'sort') return data;
                    
                    if (data !== null) {
                        var fecha = data.split("-").reverse().join("-").replaceAll("-", "/")
                        return fecha;
                    } else {
                        return data;
                    }
                }
            },
            { name: 'localidad', data: 'localidad', className: "tdLeft" },
            { name: 'kms', data: 'kms', className: "tdRight" },
            { name: 'importe_kms', data: 'importe_kms', className: "tdRight" },
            { name: 'total_peritacion', data: 'total_peritacion', className: "tdRight" },
            {
                name: 'acciones',
                data: 'acciones',
                className: "tdCenter",
                render: function (data, type, row, meta) {
                    return "<button class='button tiny success btnVer'><i class='fas fa-eye'></i> Ver</button>";
                }
            }
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api(), data;

            // converting to interger to find total
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // computing column Total of the complete result 
            var Total = api
                .column(10, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer by showing the total with the reference of the column index 
            $(api.column(9).footer()).html('Total');
            $(api.column(10).footer()).html(Total);
        },
        drawCallback: function (settings) {
            
        },
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    if (title == 'Acciones') $(cell).html("");
                    else $(cell).html('<input type="text" placeholder="' + title + '" />');

                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();

                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();

                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });

    // Checks
    $("#ckeckShowAddForm").change(function () {
        if ($(this).is(":checked")) {
            $("#addPeritacionForm").css("display", "block");
            localStorage.setItem("showAddPeritacionForm", 'show');

        } else {
            $("#addPeritacionForm").css("display", "none");
            localStorage.setItem("showAddPeritacionForm", 'hide');
        }
    });

    $("#ckeckShowFiltersForm").change(function () {
        if ($(this).is(":checked")) {
            $("#filtrosAvanzadosForm").css("display", "block");
            localStorage.setItem("showFiltrosForm", 'show');

        } else {
            $("#filtrosAvanzadosForm").css("display", "none");
            localStorage.setItem("showFiltrosForm", 'hide');
        }
    });


    $(document).on("click", ".btnVer", function(event){
        showPeritacion(this);
    });

    $(document).on({
        mouseenter: function () {
            $(this).focus();
        },
        mouseleave: function () {
            //stuff to do on mouse leave
        }
    }, ".btnVer"); //pass the element as an argument to .on

    $(document).foundation();
});