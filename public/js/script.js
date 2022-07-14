


$('#btnConsultar').click(function (e) {
    e.preventDefault();
    var ruc = $('#numeroRuc').val();
    var tipo = $('#tipoDoc').val();
    var month = $('#month').val();
    var year = $('#year').val();
    if (tipo == 01 || tipo == 03 || tipo == 00 || tipo == 07 || tipo == 08)  {
        $.ajax({
            type: "GET",
            url: "/total/"+ruc+"/"+tipo+"/"+month+"/"+year,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                $('#total').val(data);
            }
        });
    }
    
    if (tipo == 09) {
        $.ajax({
            type: "GET",
            url: "/totalGuias/"+ruc+"/"+tipo+"/"+month+"/"+year,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                $('#total').val(data);
            }
        });
    }
    if (tipo == 'OV') {
        $.ajax({
            type: "GET",
            url: "/totalOrdenVenta/"+ruc+"/"+tipo+"/"+month+"/"+year,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                $('#total').val(data);
            }
        });
    }
    if (tipo == 'CT') {
        $.ajax({
            type: "GET",
            url: "/totalCotizacion/"+ruc+"/"+tipo+"/"+month+"/"+year,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                $('#total').val(data);
            }
        });   
    }
    if (tipo == 04) {
        $.ajax({
            type: "GET",
            url: "/totalLiquidacion/"+ruc+"/"+tipo+"/"+month+"/"+year,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                $('#total').val(data);
            }
        });
    }
    if (tipo == 'OC') {
        $.ajax({
            type: "GET",
            url: "/totalPurchase/"+ruc+"/"+tipo+"/"+month+"/"+year,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                $('#total').val(data);
            }
        });
    }
    
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



let montoTotal=[];
$('#btnConsultarMes').click(function (e) {
    e.preventDefault();
    var month = $('#monthTotal').val();
    var year = $('#yearTotal').val();
    $.ajax({
        type: "GET",
        url: "/totalMes/"+year+"/"+month,
        data: "data",
        dataType: "JSON",
        success: function (data) {
            $("#totalMes").val(data);
            montoTotal.push
        }
    });
});


$.ajax({
    type: "GET",
    url: "/totalMesDash",
    data: "data",
    dataType: "JSON",
    success: function (response) {
        const ctx = $('#myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febr', 'Mar', 'Abril', 'Mayo', 'Junio','Julio'],
                datasets: [{
                    data: response,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 3,
                fill: 'start',
                hidden: false
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
                
            
        },
        plugins: {
            legend: {
                display: false,
                
            },
            title:{
                display: true,
                text: "Cantidad de folios emitidos por mes del 2022"
            }
            
        },
        
    }
});
    }
});


$.ajax({
    type: "GET",
    url: "/cantidadCliente",
    data: "data",
    dataType: "JSON",
    success: function (response) {
        const ctx = $('#chartEnterprise');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febr', 'Mar', 'Abril', 'Mayo', 'Junio','Julio'],
                datasets: [{
                    data: response,
                    backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
        
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 3,
                fill: 'start',
                hidden: false
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false,
                
            },
            title:{
                display: true,
                text: "Cantidad de clientes por mes(2022)"
            }
            
        },
        
    }
});
    }
});


$.ajax({
    type: "GET",
    url: "/topCliente",
    data: "data",
    dataType: "JSON",
    success: function (response) {
        var arrayClient= [];
        for (const key in response) {
            var data = response[key];
            for (const k in data) {
                arrayClient.push(data[k]);
            }

        }
        console.log(arrayClient);
        
        const ctx = $('#chartClient');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: arrayClient.map( i => i.business_name),
                datasets: [{
                    data: arrayClient.map( i => i.cantidad),
                    backgroundColor: [
                    
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 3,
                    fill: 'start',
                    hidden: false
                },
            ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false,
                
            },
            title:{
                display: true,
                text: "Cliente con más folios emitidos por mes(2022)"
            },
            /* tooltip: {
                callbacks: {
                  footer: footer,
                }
              } */
            
        },
        
        
        
    }
});
    }
});

$(document).ready( function () {
    $('#table_id').DataTable( {
        ajax: {
            url: '/list',
            dataSrc: 'data'
        },
        columns: [
            {data: 'business_name'},
            {data: 'cantidad'},
        ]
        
    } );
} );

$("#formConsultaTotal").validate();

