$(function() {

    // Establecer configuraciones
    if (localStorage.getItem("showAddPeritacionForm")) {
        var showForm = localStorage.getItem("showAddPeritacionForm");
        if(showForm == 'show'){
            $("#ckeckShowAddForm").prop('checked', true);
            $("#addPeritacionForm").css("display", "block");
        }else{
            $("#ckeckShowAddForm").prop('checked', false);
            $("#addPeritacionForm").css("display", "none");
        }
    }

    if (localStorage.getItem("showFiltrosForm")) {
        var showForm = localStorage.getItem("showFiltrosForm");
        if(showForm == 'show'){
            $("#ckeckShowFiltersForm").prop('checked', true);
            $("#filtrosAvanzadosForm").css("display", "block");
        }else{
            $("#ckeckShowFiltersForm").prop('checked', false);
            $("#filtrosAvanzadosForm").css("display", "none");
        }
    }
});


