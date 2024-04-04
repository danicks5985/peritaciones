var dataTablePeritaciones;
var searchColumnsValues = {};

$(function () {

    // Autocomplete talleres
    $.ajax({
        url: "Php/getTalleres.php",
        type: 'post',
        dataType: "json",
        success: function (data) {
            $talleresArr = [];
            $.each( data, function( key, value ) {
                $talleresArr.push({ label: value.nombre, id: value.id},);
            });

            // Formulario crear taller
            $("#addPeritacionForm #nameTaller").autocomplete({
                autoFocus: true,
                minLength: 3,
                delay: 500,
                source: function(request, response) {
                    var filteredArray = $.map($talleresArr, function(item) {
                        if( item.label.toUpperCase().startsWith(request.term.toUpperCase())){
                            return item;
                        }
                        else{
                            return null;
                        }
                    });
                    response(filteredArray);
                },
                select: function (event, ui) {
                    // Set selection
                    $('#addPeritacionForm #nameTaller').val(ui.item.label); // display the selected text
                    $('#addPeritacionForm #tallerId').val(ui.item.id); // save selected id to input
                    return false;
                },
                focus: function (event, ui) {
                    $("#addPeritacionForm #nameTaller").val(ui.item.label);
                    $("#addPeritacionForm #tallerId").val(ui.item.id);
                    return false;
                },
            });

            // Formulario editar taller
            $("#savePeritacionForm #nameTaller").autocomplete({
                autoFocus: true,
                minLength: 3,
                delay: 500,
                source: function(request, response) {
                    var filteredArray = $.map($talleresArr, function(item) {
                        if( item.label.toUpperCase().startsWith(request.term.toUpperCase())){
                            return item;
                        }
                        else{
                            return null;
                        }
                    });
                    response(filteredArray);
                },
                select: function (event, ui) {
                    // Set selection
                    $('#savePeritacionForm #nameTaller').val(ui.item.label); // display the selected text
                    $('#savePeritacionForm #tallerId').val(ui.item.id); // save selected id to input
                    return false;
                },
                focus: function (event, ui) {
                    $("#savePeritacionForm #nameTaller").val(ui.item.label);
                    $("#savePeritacionForm #tallerId").val(ui.item.id);
                    return false;
                },
            });


            $('.ui-autocomplete').addClass('vertical dropdown menu autoComplEstilos');
        }
    });

    
    // Autocomplete companias
    $.ajax({
        url: "Php/getCompanias.php",
        type: 'post',
        dataType: "json",
        success: function (data) {
            companiasArr = [];
            $.each( data, function( key, value ) {
                companiasArr.push({ label: value.nombre, id: value.id},);
            });

            // Formulario crear compañia
            $("#addPeritacionForm #nameCompania").autocomplete({
                autoFocus: true,
                minLength: 1,
                source: function(request, response) {
                    var filteredArray = $.map(companiasArr, function(item) {
                        if( item.label.toUpperCase().startsWith(request.term.toUpperCase())){
                            return item;
                        }
                        else{
                            return null;
                        }
                    });
                    response(filteredArray);
                },
                select: function (event, ui) {
                    // Set selection
                    $('#addPeritacionForm #nameCompania').val(ui.item.label); // display the selected text
                    $('#addPeritacionForm #companiaId').val(ui.item.id); // save selected id to input
                    return false;
                },
                focus: function (event, ui) {
                    $("#addPeritacionForm #nameCompania").val(ui.item.label);
                    $("#addPeritacionForm #companiaId").val(ui.item.id);
                    return false;
                },
            });

            // Formulario editar compañia
            $("#savePeritacionForm #nameCompania").autocomplete({
                autoFocus: true,
                minLength: 1,
                source: function(request, response) {
                    var filteredArray = $.map(companiasArr, function(item) {
                        if( item.label.toUpperCase().startsWith(request.term.toUpperCase())){
                            return item;
                        }
                        else{
                            return null;
                        }
                    });
                    response(filteredArray);
                },
                select: function (event, ui) {
                    // Set selection
                    $('#savePeritacionForm #nameCompania').val(ui.item.label); // display the selected text
                    $('#savePeritacionForm #companiaId').val(ui.item.id); // save selected id to input
                    return false;
                },
                focus: function (event, ui) {
                    $("#savePeritacionForm #nameCompania").val(ui.item.label);
                    $("#savePeritacionForm #companiaId").val(ui.item.id);
                    return false;
                },
            });

            $('.ui-autocomplete').addClass('vertical dropdown menu autoComplEstilos');
        }
    });

    
    $('#tbPeritaciones thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tbPeritaciones thead');

    var columns_export = [ 
        'nombre_taller:name', 'matricula:name', 'f_peritacion:name',
        'nombre_compania:name', 'nombre_perito:name', 'estado:name',
        'importe_kms:name','total_peritacion:name'
    ]

    dataTablePeritaciones = $('#tbPeritaciones').DataTable({
        dom: 'Blfrtip',
        autoWidth: false,
        orderCellsTop: true,
        fixedHeader: true,
        stateSave: true,
        pageLength: 100,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"]],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
        },
        buttons: [
            'colvis',
            {
                extend:    'copyHtml5',
                text:      '<i class="far fa-copy"></i> Copiar',
                titleAttr: 'Copiar'
            }, 
            {
                extend:    'excelHtml5',
                text:      '<i class="far fa-file-excel"></i> Excel',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: columns_export
                }
            }, 
            {
                extend:    'print',
                text:      '<i class="fas fa-print"></i> Imprimir',
                titleAttr: 'Imprimir',
                exportOptions: {
                    columns: columns_export
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="far fa-file-pdf"></i> PDF',
                title: 'Listado peritaciones',
                /* customize: function(doc) {
                    doc.styles.title = {
                        color: 'red',
                        fontSize: '40',
                        background: 'blue',
                        alignment: 'center'
                    }   
                },  */ 
                /* messageTop: function(){
                    return "Listado peritaciones";
                }, */
                footer: true,
                exportOptions: {
                    columns: columns_export
                }
            }, 
            {
                text: '<i class="far fa-trash-alt"></i> Resetear filtros',
                className:'button alert btnResetHeaders',
                header: true,
                action: function ( e, dt, node, config ) {
            
                    $("#resetFilter").trigger("click");

                    $("input[type='text']").each(function () { 
                        $(this).val(''); 
                    })
            
                    dt.columns().every( function () {
                        var column = this;
                        column
                                .search( '' );
                    } );
            
                    dt.search('').draw();

            
                }
            }
            
        ],
        ajax: {
            url: "Php/getPeritaciones.php",
        },
        rowId: 'id',
        order: [[0, "desc"]],
        columns: [
            { name: 'id', data: 'id', className: "tdRight", visible: false },
            { 
                name: 'nombre_taller', 
                data: 'nombre_taller', 
                className: "tdLeft", 
                render: function (data, type, row, meta) {
                    if (type === 'display'){
                        
                        return data + ` (${row.taller_id})`;
                    }
                    return data;
                } 
            },
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
            { name: 'create_at', data: 'create_at', className: "tdLeft", visible: false },
            { name: 'update_at', data: 'update_at', className: "tdLeft", visible: false },
            {
                name: 'acciones',
                data: 'acciones',
                className: "tdCenter",
                render: function (data, type, row, meta) {
                    return `<button class='button tiny success btnAction btnVerPeritacion'><i class='fas fa-eye'></i> Ver</button>
                            <button class='button tiny alert btnAction btnDelPeritacion'><i class='fas fa-trash'></i> Eliminar</button>`;
                }
            },
        ],
        createdRow: function( row, data, dataIndex){
            var api = this.api();
            var estado_id_col = api.column('estado:name').index() - 1;
            
            if( data['perito_id'] == '1') $(row).addClass('perito_kike_row');
            if( data['perito_id'] == '2') $(row).addClass('perito_edu_row');
            if( data['perito_id'] == '3') $(row).addClass('perito_alicia_row');
            if( data['perito_id'] == '4') $(row).addClass('perito_teles_row');

            if( data['estado_id'] == '1'){
                $(row).find(`td:eq(${estado_id_col})`).addClass('avance_cell');
            }

            if( data['estado_id'] == '5' || data['estado_id'] == '10'){
                $(row).find(`td:eq(${estado_id_col})`).addClass('abierta_cell');
            }

            if( data['estado_id'] == '7' || data['estado_id'] == '8' || data['estado_id'] == '9'){
                $(row).find(`td:eq(${estado_id_col})`).addClass('pdte_cell');
            }

        },
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
            var importeTotal = api
                .column('total_peritacion:name', { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Obteniendo el total de registros filtrados en la tabla
            // Obteniendo el total de registros filtrados
            var info = api.page.info();
            var totalRegistrosFiltrados = info.recordsDisplay;

            // Update footer by showing the total with the reference of the column index
            $(api.column('importe_kms:name').footer()).html('Total peritaciones: ' + totalRegistrosFiltrados);
            // $(api.column('importe_kms:name').footer()).html('Importe total');
            $(api.column('total_peritacion:name').footer()).html('Importe total: ' + importeTotal + '€');
            $(api.column('acciones:name').footer()).html('(KIKE +250€)');
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


    $(document).on("click", ".btnVerPeritacion", function(event){
        showPeritacion(this);
    });

    $(document).on("click", ".btnDelPeritacion", function(event){
        deletePeritacion(this);
    });

    $(document).on({
        mouseenter: function () {
            $(this).focus();
        },
        mouseleave: function () {
            //stuff to do on mouse leave
        }
    }, ".btnVerPeritacion"); //pass the element as an argument to .on

    $(document).foundation();
});