<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        html, body {
            height: 100vh;
            width: 100vw;
        }

        #main-container {
            overflow: hidden;
            background-color: rgba(255, 255, 255, 1);
            width: auto;
            /*height: 50vh;*/
            height: auto;
            border-radius: 20px;
            /*padding: 7.5vh 5vw;*/
        }

        .card {
            height: auto;
        }

        /*
        #main-container::before{
            content: '';
            position: absolute;
            background-color: rgba(255,255,255,0.5);
            width: 45vw;
            height: 42.5vh;
            border-radius: 20px;
        }
         */
        input.currency {
            padding: 10px;
            font: 20px Arial;
            width: 70%;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"
            integrity="sha512-vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.onload = function () {
            const currencyInput = document.querySelector('input[type="currency"]');
            const currency = 'COP'; // https://www.currency-iso.org/dam/downloads/lists/list_one.xml


            if (currencyInput !== null) {
                // format inital value
                onBlur({target: currencyInput});


                // bind event listeners
                currencyInput.addEventListener('focus', onFocus);
                currencyInput.addEventListener('blur', onBlur);
            }


            function localStringToNumber(s) {
                return Number(String(s).replace(/[^0-9.-]+/g, ""));
            }

            function onFocus(e) {
                const value = e.target.value;
                e.target.value = value ? localStringToNumber(value) : '';
            }

            function onBlur(e) {
                const value = e.target.value;

                const options = {
                    maximumFractionDigits: 2,
                    currency: currency,
                    style: "currency",
                    currencyDisplay: "symbol"
                };

                e.target.value = (value || value === 0)
                    ? localStringToNumber(value).toLocaleString(undefined, options)
                    : '';
            }
        };
    </script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100"
     style="background-image: url('https://cusezar.com/wp-content/uploads/2021/08/Cusezar-La-Marlene-Aerea-union-Especifica-V4.jpg');background-repeat: no-repeat;">

    <!-- Page Content -->
    <main>
        <div class="container-fluid d-flex justify-content-center align-items-center"
             style="height:100vh; overflow:hidden;">
            <div id="main-container" class="row text-center d-flex align-items-center">
                <div class="card card-default p-4">
                    <div class="card-body">
                        <form method="POST" role="form" enctype="multipart/form-data">

                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div id="" class="container">
                                        <div id="" class="row">
                                            <div id="" class="col-8">
                                                <div class="row">
                                                    <div class="fs-1">Cotización
                                                        para: {{$cotizador->proyecto->nombre_del_proyecto}}</div>
                                                </div>

                                                <!-- Cotizador -->
                                                <div id="" class="row m-5 mb-3">
                                                    <div id="" class="col- d-flex">
                                                        <select class="form-select w-100 flex" name="area"
                                                                id="select-apt">
                                                            @foreach ($cotizador->proyecto->areas as $area)
                                                                <option value="{{$area->id}}"
                                                                        recorrido="{{$area->recorrido}}">
                                                                    Unidad {{$area->construidos}}&nbsp;mts&sup2;&nbsp;-&nbsp;
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" id="ver-recorrido" class="btn btn-primary">Ver</button>
                                                    </div>
                                                </div>
                                                <div id="" class="row mt-3">
                                                    <div id="" class="col">
                                                        <h4>Valor</h4>
                                                    </div>
                                                    <div id="" class="col">
                                                        <h4>{{money($unidad->precio.'0')->toString()}}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <img src="{{$cotizador->proyecto->media->logo}}"
                                                     class="rounded float-right"
                                                     style="float: right;"
                                                     alt="Logo">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="" class="container mt-5 mb-5" style="height: auto">
                                        <div class="row">
                                            <div class="col-4 fs-3">
                                                Información financiera
                                            </div>
                                        </div>
                                        <div id="" class="row mt-3">
                                            <div class="col">
                                                <div class="row border border-dark">
                                                    <table class="table">
                                                        <thead></thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Ingresos mensuales</th>
                                                            <td>{{money($comprador->ingresos.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Subsidio a aplicar</th>
                                                            <td>{{money($cotizacion->subsidio.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Primas proyectadas</th>
                                                            <td>{{money($cotizacion->primasProyectadas.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Cesantías</th>
                                                            <td>{{money($comprador->cesantias.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Cesantías proyectadas</th>
                                                            <td>{{money($cotizacion->cesantiasProyectadas.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Ahorros</th>
                                                            <td>{{money($comprador->ahorros.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Ahorros proyectados</th>
                                                            <td>{{money($cotizacion->ahorrosProyectados.'0')->toString()}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-2 "></div>
                                            <div class="col">
                                                <div class="row border border-dark">
                                                    <table class="table align-middle">
                                                        <thead></thead>
                                                        <tbody class="">
                                                        <tr class="table-success">
                                                            <th scope="row">Total Aportes</th>
                                                            <td>{{money($cotizacion->totalAportes.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row">Crédito hipotecario</th>
                                                            <td>{{money($cotizacion->preaprobacionCredito.'0')->toString()}}</td>
                                                        </tr>
                                                        <tr class="table-success">
                                                            <th scope="row">Total</th>
                                                            <td>{{money($cotizacion->total.'0')->toString()}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row mt-3 mb-3 fs-4 border border-dark pt-3 pb-3">
                                                    <div class="col">{{$cotizacion->plazo}} Cuotas mensuales</div>
                                                    <div class="col">{{money($cotizacion->cuota.'0')->toString()}}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="box-footer mt20">
                                                        <button type="button"
                                                                class="w-full btn btn-primary">{{__('Descargar PDF')}}</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="box-footer mt20">
                                                        <button type="submit"
                                                                class="w-full btn btn-primary">{{__('Continuar')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- Inner row -->
        </div>
    </main>
    <script>
        document.getElementById('ver-recorrido').onclick = function () {
            console.log('metodo iniciado');
            let element = document.getElementById('select-apt');
            let elements = element.getElementsByTagName('option');
            for (let i = 0; i < elements.length; i++) {
                if (elements[i].value === element.value) {
                    console.log(elements[i].getAttribute('recorrido'));
                    Object.assign(document.createElement('a'), {
                        target: '_blank',
                        href: elements[i].getAttribute('recorrido'),
                    }).click();
                }
            }
        };
        document.getElementById('select-apt').onchange = function () {

        };
    </script>
</div>
</body>
</html>
