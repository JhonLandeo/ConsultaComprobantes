<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Consulta comprobante OX Factura</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">



    <!-- Styles -->
    {{-- Jquery --}}

</head>

<body class="antialiased">
    <div class="container mt-2">
        <div class="row">
            <div class="col-5">
                <div class="card p-2">
                    <div class="card-title">Consulta total</div>
                    <form>
                        <div class="form-group row">
                            <label for="numeroRuc" class="col-sm-4 col-form-label">Número RUC del emisor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="numeroRuc" placeholder="RUC" name="ruc">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipoDoc" class="col-sm-4 col-form-label">Tipo de documento</label>
                            <div class="col-sm-8">
                                <select class="custom-select form-control" id="tipoDoc" name="type_doc">
                                    {{-- <option selected value="00">Todos</option> --}}
                                    <option value="01">Factura</option>
                                    <option value="03">Boleta</option>
                                    {{-- <option value="3">Guías de remisión</option>
                                    <option value="4">Liquidación de compra</option> --}}
                                    <option value="07">Nota de crédito</option>
                                    <option value="08">Nota de débito</option>
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
            <div class="col-7">
                <div class="card p-2">
                    <div class="card-title ">Consulta por documento</div>
                    <form>
                        <div class="form-group row">
                            <label for="numeroRuc" class="col-sm-4 col-form-label">Número RUC del emisor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="numeroRucDoc" placeholder="RUC" >
                            </div>
                        </div>
                        <div class="form-group p-2 row">
                            <label for="tipoDoc" class="col-sm-4 col-form-label">Tipo de documento</label>
                            <div class="col-sm-8">
                                <select class="custom-select form-control" id="tipoDocumento">
                                    {{-- <option selected value="00">Todos</option> --}}
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
                            <label for="numeroRuc" class="col-sm-2 col-form-label">Serie</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numeroSerie" placeholder="F001">
                            </div>
                            <label for="numeroRuc" class="col-sm-2 col-form-label">Número</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="numero" placeholder="XXXXXXXX">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="tipoDoc" class="col-sm-4 col-form-label">Tipo de documento del receptor</label>
                            <div class="col-sm-8">
                                <select class="custom-select form-control" id="tipoDocReceptor">
                                    <option selected>Todos</option>
                                    <option value="1">RUC</option>
                                    <option value="2">DNI</option>
                                    <option value="3">PASAPORTE</option>

                                </select>
                            </div>

                        </div> --}}
                        <div class="form-group row p-2 align-items-center">
                            <label  class="col-sm-4 col-form-label" >Fecha de emisión</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="fecha" placeholder="19/05/2000">
                            </div>
                        </div>
                        <div class="form-group row p-2 align-items-center">
                            <label for="monto" class="col-sm-4 col-form-label">Monto total</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="monto" placeholder="">
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
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</html>
