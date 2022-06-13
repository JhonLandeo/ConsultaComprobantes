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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- Jquery --}}

</head>

<body class="antialiased">
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="row d-flex justify-content-around col-7">
                @foreach ($product as $p)

                    <a class="card col-3 text-center product p-2 m-1" href="">
                        <form action="" class="form-item">
                            <div class="card-title des">{{$p->description}}</div>
                            <div class="card-body">
                                <img src="{{ asset('imagenes/manzana.jpg') }}" alt="" class="img-fluid">
                            </div>
                            <div class="card-footer">
                                <p class="precio">Precio <strong>{{number_format($p->price,2)}}</strong></p>

                            </div>
                            <input type="hidden" name="idProducto" class="idProducto" value="{{$p->id}}">
                            <input type="submit" value="Agregar" class="btn btn-success">
                        </form>
                    </a>

                @endforeach

        </div>
            <div class="row d-flex align-items-start col-5">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="pro d-none text-center">

                    </tbody>

                </table>
            </div>
        </div>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</html>
