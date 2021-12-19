$(function() {

    // Resetar filtros avanzados
    $("#resetFilter").click(function(){
        $.fn.dataTable.ext.search = [];
        $(".inputFilter").val("");
        $(".filterCheck").prop('checked', false);
    });
    
    // Aplicar filtros avanzados
    $("#filtrosAvanzadosForm").submit(function(e) {
        $.fn.dataTable.ext.search = [];
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var data = form.serializeArray();

        
        var companiasList = variablesJs['companias'];
        var companiasFilter = [];
        var peritosList = variablesJs['peritos'];
        var peritosFilter = [];
        var f_creac_desde = false;
        var f_creac_hasta = false;
        var f_cierr_desde = false;
        var f_cierr_hasta = false;

        $.each( data, function( key, value ) {

            // Obtenemos las compañías para filtro
            if (value.name.search("checkCompania") != -1){
                var companiaId = parseInt(value.name.split("_")[1]);
                companiasFilter.push(companiasList[companiaId]);
            }

            // Obtenemos los peritos para filtro
            if (value.name.search("checkPerito") != -1){
                var peritoId = parseInt(value.name.split("_")[1]);
                peritosFilter.push(peritosList[peritoId]);
            }

            // Obtenemos rango de fecha de creación para filtro
            if (value.name.search("f_creac_desde") != -1){
                if (value.value != '') f_creac_desde = value.value;
            }
            if (value.name.search("f_creac_hasta") != -1){
                if (value.value != '') f_creac_hasta = value.value;
            }


            // Obtenemos rango de fecha de cierre para filtro
            if (value.name.search("f_cierr_desde") != -1){
                if (value.value != '') f_cierr_desde = value.value;
            }
            if (value.name.search("f_cierr_hasta") != -1){
                if (value.value != '') f_cierr_hasta = value.value;
            }
        });


        if (f_creac_desde){
            if (!f_creac_hasta) return alert("Rellene las dos fechas del rango de fecha creación");

            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var columnIndex = dataTablePeritaciones.column( 'f_peritacion:name' ).index();
                    var val = data[columnIndex];
                    var min = moment(f_creac_desde, 'YYYY-MM-DD').toDate();
                    var max = moment(f_creac_hasta, 'YYYY-MM-DD').toDate();
                    var date = moment(val, 'DD/MM/YYYY').toDate();
                    if (
                        min <= date && date <= max
                    ) {
                        return true;
                    }
                    return false;
                }
            );
        }

        if (f_cierr_desde){
            if (!f_cierr_hasta) return alert("Rellene las dos fechas del rango de fecha cierre");

            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var columnIndex = dataTablePeritaciones.column( 'f_cierre:name' ).index();
                    var val = data[columnIndex];
                    var min = moment(f_cierr_desde, 'YYYY-MM-DD').toDate();
                    var max = moment(f_cierr_hasta, 'YYYY-MM-DD').toDate();
                    var date = moment(val, 'DD/MM/YYYY').toDate();
                    if (
                        min <= date && date <= max
                    ) {
                        return true;
                    }
                    return false;
                }
            );
        }


        
        if (companiasFilter.length > 0){
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var columnIndex = dataTablePeritaciones.column( 'nombre_compania:name' ).index();
                    var val =  data[columnIndex];
                    if (
                        $.inArray(val, companiasFilter) !== -1
                    ) {
                        return true;
                    }
                    return false;
                }
            );
        }

        if (peritosFilter.length > 0){
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var columnIndex = dataTablePeritaciones.column( 'nombre_perito:name' ).index();
                    var val =  data[columnIndex];
                    if (
                        $.inArray(val, peritosFilter) !== -1
                    ) {
                        return true;
                    }
                    return false;
                }
            );
        }


        dataTablePeritaciones.draw();
        
    });
    
});


