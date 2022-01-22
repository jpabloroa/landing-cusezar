@extends('layouts.app')

@section('template_title')
    {{ $prospecto->name ?? 'Show Prospecto' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Prospecto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('prospectos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre 1:</strong>
                            {{ $prospecto->nombre_1 }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre 2:</strong>
                            {{ $prospecto->nombre_2 }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido 1:</strong>
                            {{ $prospecto->apellido_1 }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido 2:</strong>
                            {{ $prospecto->apellido_2 }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $prospecto->cedula }}
                        </div>
                        <div class="form-group">
                            <strong>Celular:</strong>
                            {{ $prospecto->celular }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $prospecto->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Caja Compensacion:</strong>
                            {{ $prospecto->caja_compensacion }}
                        </div>
                        <div class="form-group">
                            <strong>Actividad:</strong>
                            {{ $prospecto->actividad }}
                        </div>
                        <div class="form-group">
                            <strong>Ingresos:</strong>
                            {{ $prospecto->ingresos }}
                        </div>
                        <div class="form-group">
                            <strong>Cesantias:</strong>
                            {{ $prospecto->cesantias }}
                        </div>
                        <div class="form-group">
                            <strong>Ahorros:</strong>
                            {{ $prospecto->ahorros }}
                        </div>
                        <div class="form-group">
                            <strong>Documentos Cliente:</strong>
                            {{ $prospecto->documentos_cliente }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
