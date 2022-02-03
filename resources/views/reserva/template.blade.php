@extends('reserva.layout.template')

@section('template_title')

@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center"
         style="height:100vh; overflow:hidden;">

        <!-- Inner row, half the width and height, centered, blue border -->
        <div id="main-container" class="row text-center d-flex align-items-center">

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{$title}}</span>
                </div>
                <div class="card-body">
                    <form method="POST" role="form" enctype="multipart/form-data">

                        @csrf

                        <div class="box box-info padding-1">
                            <div class="box-body">

                                {!! $content !!}

                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="w-full btn mt-3 btn-primary">{{__('Enviar')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div> <!-- Inner row -->
    </div>
@endsection
