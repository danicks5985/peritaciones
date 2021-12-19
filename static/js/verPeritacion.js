var $modal = $('#verPeritacionModal');

function showPeritacion(button){
    var id = $(button).parents("tr").attr("id");
    $.ajax('../../peritaciones/Php/getPeritacion.php?id=' + id)
    .done(function(resp){
        var data = JSON.parse(resp).data;
        //console.log(data);
        var $id = $("#verPeritacionModal #id");
        var $f_cierre = $("#verPeritacionModal #f_cierre");
        var $cmbEstado = $("#verPeritacionModal #estado");
        var $kms = $("#verPeritacionModal #kms");
        var $total = $("#verPeritacionModal #total");
        var $comentarios = $("#verPeritacionModal #comentarios");
        
        $id.val(data.id);
        $f_cierre.val(data.f_cierre);
        $cmbEstado.val(data.estado);
        $kms.val(data.kms);
        $total.val(data.total_peritacion);
        $comentarios.val(data.comentarios);
        
        $modal.foundation('open');
    });
} 

// Save peritacion
$("#savePeritacionForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data){
            res = JSON.parse(data);
            if (res.ok){
                $modal.foundation('close');
                $('#tbPeritaciones').DataTable().ajax.reload();
            }
        }
    });
});

$("#verPeritacionModal #estado").change(function(){
    if ($(this).val() == variablesJs.constantes.STE_CERRADA){
        $("#verPeritacionModal #f_cierre").val(new Date().toISOString().slice(0, 10));
    }
});
