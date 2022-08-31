<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Consulta comprobante OX Factura</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <!-- Styles -->
    {{-- Jquery --}}

</head>

<body class="antialiased">
    <div class="container-fluid mt-2">
        {{-- Consulta total y por documento --}}
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-4">
                <div class="card p-2">
                    <div class="card-title">Consulta total</div>
                    <form id="formConsultaTotal">
                        <div class="form-group row">
                            <div class="col-sm-4 d-inline-flex">
                                <input type="text" class="form-control" id="numeroRuc" placeholder="Número de RUC" name="ruc">
                            </div>
                            <div class="col-sm-8">
                                <select class="custom-select form-control" id="tipoDoc" name="type_doc">
                                    <option selected value="00">Seleccione tipo de documento</option>
                                    <option value="01">Factura</option>
                                    <option value="03">Boleta</option>
                                    <option value="00">Nota de venta</option>
                                    <option value="09">Guías de remisión</option>
                                    <option value="4">Liquidación de compra</option>
                                    <option value="07">Nota de crédito</option>
                                    <option value="08">Nota de débito</option>
                                    <option value="OV">Orden de venta</option>
                                    <option value="CT">Cotización</option>
                                    <option value="OC">Orden de compra</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3 mt-2 d-flex justify-content-around">
                            <label for="tipoDoc" class="col-sm-1  col-form-label d-inline-flex ">Año</label>
                            <div class="col-sm-4 p-0 m-0">
                                <select class="custom-select form-control" id="year" name="year">
                                    {{-- <option selected value="00">Todos</option> --}}
                                    <option value="2022">2022</option>
                                    <option value="03">2023</option>
                                </select>
                            </div>
                            <label for="tipoDoc" class="col-sm-1 col-form-label d-inline-flex ">Mes</label>
                            <div class="col-sm-4 p-0 m-0">
                                <select class="custom-select form-control" id="month" name="month">
                                    {{-- <option selected value="00">Todos</option> --}}
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row p-3  ">
                            <button class="btn btn-success col-4" id="btnConsultar">Consultar</button>
                            <div class="col-4 d-flex justify-content-end">
                                <label for="total" >Total</label>
                            </div>

                            <div class="col-4 p-0">

                                <input type="text" class="form-control total" id="total">

                            </div>


                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-2">
                    <div class="card-title ">Consulta por documento</div>
                    <form>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numeroRucDoc" placeholder="Número de RUC" >
                            </div>
                            <div class="col-sm-8">
                                <select class="custom-select form-control" id="tipoDocumento">
                                    <option selected value="00">Seleccione tipo de documento</option>
                                    <option value="01">Factura</option>
                                    <option value="03">Boleta</option>
                                    {{-- <option value="3">Guías de remisión</option>
                                    <option value="4">Liquidación de compra</option> --}}
                                    <option value="07">Nota de crédito</option>
                                    <option value="08">Nota de débito</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row p-2 d-flex align-items-center justify-content-around">
                            <label for="numeroRuc" class="col-sm-1 col-form-label d-inline-flex">Serie</label>
                            <div class="col-sm-4 d-inline-flex p-0">
                                <input type="text" class="form-control" id="numeroSerie" placeholder="F001">
                            </div>
                            <label for="numeroRuc" class="col-sm-1 col-form-label d-inline-flex">Número</label>
                            <div class="col-sm-4 d-inline-flex">
                                <input type="text" class="form-control" id="numero" placeholder="XXXXXXXX">
                            </div>
                        </div>
                        <div class="form-group row p-3">
                            <button class="btn btn-success col-4" id="btnConsultarDoc">Consultar</button>
                            <div class="col-8">
                                <input type="text" class="form-control" id="resultado">

                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Tabla de status --}}
        <div class="row">
            <div class="form-group  col-12">
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <select class="form-control filtro " id="filtro" >
                            <option value="" selected>Seleccione fecha</option>
                            <option value=<?php echo date("Y-m-d H:i:s",strtotime("-0 days"));  ?> >Hoy</option>
                            <option value=<?php echo date("Y-m-d H:i:s",strtotime("-1 days"));  ?> >Hace un dia</option>
                            <option value=<?php echo date("Y-m-d H:i:s",strtotime("-2 days")); ?>  >Hace 2 días</option>
                        </select>

                    </div>
                    <div class="col-4">
                        <button class="btn btn-success " id="btnConsultarFecha">Consultar</button>
                    </div>
                </div>
                <div id="content" style="height: 20px">
                    
                </div>

                <div class="row mt-2" style="position: relative">
                    <div class="col-5 ">
                        <table class="table table-hover col-5  table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" colspan="5" scope="row">ENVIO DE DOCUMENTOS</th>
                                </tr>
                              <tr>
                                <th scope="col">Documento</th>
                                <th scope="col">Pendientes</th>
                                <th scope="col">Aceptados</th>
                                <th scope="col">Rechazados</th>
                                <th scope="col">Pendientes x reprocesar</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              <tr>
                                <th scope="row">Factura</th>
                                <td class="fp"></td>
                                <td class="fa"></td>
                                <td class="fr"></td>
                                <td class="fpr"></td>
                              </tr>
                              <tr>
                                <th scope="row">Boleta</th>
                                <td class="bp"></td>
                                <td class="ba"></td>
                                <td class="br"></td>
                                <td class="bpr"></td>
                              </tr>
                              <tr>
                                <th scope="row">Nota de crédito</th>
                                <td class="ncp"></td>
                                <td class="nca"></td>
                                <td class="ncr"></td>
                                <td class="ncpr"></td>
                              </tr>
                              {{-- <tr>
                                <th scope="row">Nota de débito</th>
                                <td class="ndp"></td>

                                <td class="ndr"></td>
                              </tr> --}}
                              <tr>
                                <th scope="row">Total</th>
                                <td class="totalPendientes"></td>
                                <td class="totalAprobados"></td>
                                <td class="totalRechazados"></td>
                                <td class="totalPendienteReproceso"></td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row col-7">
                        <div class="col-12">
                            <table class="table table-hover col-5  table-striped table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" colspan="6" scope="row">ENVIO DE BAJAS</th>
                                    </tr>
                                  <tr>
                                    <th scope="col">Pendiente 3</th>
                                    <th scope="col">Rechazados 5</th>
                                    <th scope="col">Proceso con ticket</th>
                                    <th scope="col">Aceptado</th>
                                    <th scope="col">Pendiente sin ticket 6</th>
                                    <th scope="col">Proceso con ticke 7</th>
    
                                  </tr>
                                </thead>
                                <tbody class="text-center">
                                  <tr>
                                    <td class="bap"></td>
                                    <td class="bar"></td>
                                    <td class="bapr"></td>
                                    <td class="baa"></td>
                                    <td class="bap6"></td>
                                    <td class="bapr7"></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table table-hover col-5  table-striped table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" colspan="3" scope="row">ENVIO DE GUIAS DE REMISION</th>
                                    </tr>
                                  <tr>
                                    <th scope="col">Rechazados</th>
                                    <th scope="col">Aceptado</th>
                                    <th scope="col">Pendiente</th>    
                                  </tr>
                                </thead>
                                <tbody class="text-center">
                                  <tr>
                                    <td class="gr"></td>
                                    <td class="gapr"></td>
                                    <td class="gp"></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
        <div class="row mt-2 align-items-center">
            <div class="col-4">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
            <div class="col-4">
                <canvas id="chartEnterprise" width="400" height="200"></canvas>
            </div>
            <div class="card col-4">
                <div class="">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>Folios</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    <div class="container-fluid mt-2">
        <div class="row mt-3 d-flex justify-content-start mb-3">
           
            <div class="col-8">
                <canvas id="chartClient" width="400" height="200"></canvas>
            </div>

        </div>
    </div>
    {{-- spiner --}}
    
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

</html>
