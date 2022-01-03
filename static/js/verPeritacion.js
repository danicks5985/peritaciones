var $modal = $('#verPeritacionModal');

function showPeritacion(button){
    var id = $(button).parents("tr").attr("id");

    $("#verPeritacionModal .concesionario_cell").css("display", "none");
    $("#verPeritacionModal .concertado_cell").css("display", "none");

    $.ajax('../../peritaciones/Php/getPeritacion.php?id=' + id)
    .done(function(resp){
        var data = JSON.parse(resp).data;
        //console.log(data);
        var $id = $("#verPeritacionModal #id");
        var $nameTaller = $("#verPeritacionModal #nameTaller");
        var $tallerId = $("#verPeritacionModal #tallerId");
        var $matricula = $("#verPeritacionModal #matricula");
        var $f_peritacion = $("#verPeritacionModal #f_peritacion");
        var $f_cierre = $("#verPeritacionModal #f_cierre");
        var $nameCompania = $("#verPeritacionModal #nameCompania");
        var $companiaId = $("#verPeritacionModal #companiaId");
        var $perito = $("#verPeritacionModal #perito");
        var $cmbEstado = $("#verPeritacionModal #estadoId");
        var $kms = $("#verPeritacionModal #kms");
        var $total = $("#verPeritacionModal #total");
        var $comentarios = $("#verPeritacionModal #comentarios");
        
        $id.val(data.id);
        $nameTaller.val(data.nombre_taller);
        $tallerId.val(data.taller_id);
        $matricula.val(data.matricula);
        $f_peritacion.val(data.f_peritacion);
        $f_cierre.val(data.f_cierre);
        $nameCompania.val(data.nombre_compania);
        $companiaId.val(data.compania_id);
        $perito.val(data.perito_id);
        $cmbEstado.val(data.estado_id);
        $kms.val(data.kms);
        $total.val(data.total_peritacion);
        $comentarios.val(data.comentarios);
        
        $.ajax({
            method: "POST",
            url: "../../peritaciones/Php/getManoObra.php",
            data: { taller_id: data.taller_id, compania_id: data.compania_id }
        })
        .done(function( resp ) {
            var data = JSON.parse(resp).data;
            if (data != null){
                console.log(data);
                $("#verPeritacionModal .manoObra_cell").text(data.mano_obra);
                if (data.concesionario == "1"){
                    $("#verPeritacionModal .concesionario_cell").css("display", "block");
                }
                if (data.concertado == "1"){
                    $("#verPeritacionModal .concertado_cell").css("display", "block");
                }
            }
            $modal.foundation('open');
        });
    });
}

function deletePeritacion(button){

    Swal.fire({
        title: 'Confirmar borrar la peritación?',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
            var id = $(button).parents("tr").attr("id");
            console.log(id);
            $.ajax('../../peritaciones/Php/deletePeritacion.php?id=' + id)
            .done(function(resp){
                var data = JSON.parse(resp);
                console.log(data);
                if (data.ok){
                    $('#tbPeritaciones').DataTable().ajax.reload();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Peritación eliminada!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
      })

    
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
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Peritación modificada ok',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    });
});

$("#verPeritacionModal #estadoId").change(function(){
    if ($(this).val() == '2' || $(this).val() == '3'){
        $("#verPeritacionModal #f_cierre").val(new Date().toISOString().slice(0, 10));
    }
});
