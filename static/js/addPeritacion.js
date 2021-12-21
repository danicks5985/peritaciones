// add peritacion
$("#addPeritacionForm").submit(function(e) {

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
                $('#tbPeritaciones').DataTable().ajax.reload();
                $('#addPeritacionForm').trigger("reset");
            }
        }
    });

    $("#nameTaller").focus();
});
