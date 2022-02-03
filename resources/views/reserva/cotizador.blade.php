@extends('reserva.layout.template')

@section('template_title')

@endsection

@section('content')
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
                                                    <button type="button" id="ver-recorrido" class="btn btn-primary">
                                                        Ver
                                                    </button>
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
@endsection
