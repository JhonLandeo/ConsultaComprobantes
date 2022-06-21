

$('#btnConsultar').click(function (e) {
    e.preventDefault();
    var ruc = $('#numeroRuc').val();
    var tipo = $('#tipoDoc').val();
    $.ajax({
        type: "GET",
        url: "/total/"+ruc+"/"+tipo,
        data: "data",
        dataType: "JSON",
        success: function (data) {
            $('#total').val(data);
        }
    });
});



$('#btnConsultarDoc').click(function (e) {
    e.preventDefault();
    /* var fecha_emision = $('#fecha').val(); */
    var ruc = $('#numeroRucDoc').val();
    var tipo = $('#tipoDocumento').val();
    /* var monto = $('#monto').val(); */
    var serie = $('#numeroSerie').val();
    var numero = $('#numero').val();
    var aceptado ="El documento se encuentra aceptado";
    var pendiente ="El documento se encuentra pendiente";
    var rechazado = "El documento se encuentra rechazado";
    var noValido = "El documento que esta buscando no es válido";
    $.ajax({
        type: "GET",
        url: "/doc/"+ruc+"/"+tipo+"/"+serie+"/"+numero,
        data: "data",
        dataType: "JSON",
        success: function (data) {
            let tam = data.length;
            if (tam == 0) {
                $('#resultado').val(noValido);
            }
            for (const key in data) {
                let obj = data[key];

                for (const key in obj) {
                    if (obj[key] === 1) {
                        $('#resultado').val(aceptado);
                    } else if(obj[key] === 0){
                        $('#resultado').val(pendiente);
                    } else if(obj[key] === 2){
                        $('#resultado').val(rechazado);
                    }else{
                        $('#resultado').val(noValido);
                    }
                }
            }
        }
    });
});


/* Tabla de pendiente procesado */

$("#btnConsultarFecha").click(function (e) { 
    e.preventDefault();
    var created_at = $(".filtro").val();
    console.log(created_at);
    
    $.ajax({
        type: "GET",
        url: "/proceso/"+created_at,
        data: "data",
        dataType: "JSON",
        success: function (response) {
            for (const key in response) {
                
                if (key === "pendientes") {
                    $(".totalPendientes").text(response[key]);
                }
                if (key === "pendienteF") {
                    $(".fp").text(response[key]);
                }
                if (key === "pendienteB") {
                    $(".bp").text(response[key]);
                }
                if (key === "pendienteNC") {
                    $(".ncp").text(response[key]);
                }
                /* if (key === "pendientesND") {
                    $(".ndp").text(response[key]);
                } */
                if (key === "rechazados") {
                    $(".totalRechazados").text(response[key]);
                }
                if (key === "rechazadosF") {
                    $(".fr").text(response[key]);
                }
                if (key === "rechazadosB") {
                    $(".br").text(response[key]);
                }
                if (key === "rechazadosNC") {
                    $(".ncr").text(response[key]);
                }
                /* if (key === "rechazadosND") {
                    $(".ndr").text(response[key]);
                } */
                if (key === "bajasp") {
                    $(".bap").text(response[key]);
                }
                if (key === "bajasr") {
                    $(".bar").text(response[key]);
                }
                if (key === "bajaspr") {
                    $(".bapr").text(response[key]);
                }
    
            }
        }
    });
});




$(".form-item").submit(function(e){ //user clicks form submit button
    e.preventDefault();
    var id = $(this).serialize(); //prepare form data for Ajax post
    var button_content = $(this).find('button[type=submit]'); //get clicked button info
    button_content.html('Adding...'); //Loading button text //change button text
    $.ajax({ //make ajax request to cart_process.php
        url: "/producto/"+id,
        type: "GET",
        dataType:"json", //expect json value from server
        data: "data",
    }).done(function(data){ //on Ajax success
        $(".pro").removeClass("d-none");
        
       
        
        for (const key in data) {
            if (key=="description") {
                var des = data[key];
            }
            if (key=="price") {
                var pri = data[key];
                var cant = 1;
                var nrows = 0; 
                $("table tr").each(function() {
                    nrows++;
                })
               console.log(nrows);
               
              let html = '<tr id="fila'+nrows+'" class="fila"><td>'+des+'</td><td>'+pri+'</td><td><input class="col-10 cant" value="'+cant+'"></td><td class="importe">'+pri*cant+'</td><td><input type="button" onclick="eliminarFila('+nrows+')" class="btn btn-danger" value="X" /></td></tr>';
                $(".pro").append(html);

               
                $(".cant").change(function (e) {
                    e.preventDefault();
                    var cantidadMo = $(".cant").val();
                    $(".importe").text(pri*cantidadMo);
                });
            }

        }
        function eliminarFila(index) {
            $("#fila" + index).remove();
          }

    })
    e.preventDefault();
});






