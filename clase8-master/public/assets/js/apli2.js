var fb = {
    
    meGusta : function(id){
        //alert('me gusta'+id);
        $.ajax({
                url: baseUrl + '/publicacion/megusta',
                type: 'POST',
                async: true,
                data: {
                        publicacion : id
                        },
                success: function(response){
                    console.log(response);
                    $("#n-me-gusta-"+id).text(response.nlikes);
                    $("#t-me-gusta-"+id).text(response.type==-1?"Me gusta":"Ya no me gusta");
                }              
            });
    },
    
    comentar: function(id) {
        var comentario = $("#comentario-" + id);
        if (comentario.val() != "") {
            $.ajax({
                url: '/publicacion/comentar',
                type: 'POST',
                async: true,
                data: {
                        usuario:1,
                        comentario:comentario.val()
                        },
                success: function(response){
                    alert("Se ejecuto correctamente");
                }
                //error: muestraError
            });
        } else {
            alert('Este campo es obligatorio');
        }
    }
};
