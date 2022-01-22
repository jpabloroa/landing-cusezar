<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <label class="mt-3">{{__('Nombres')}}</label>
            {{ Form::text('nombres', $prospecto->nombre_1.' '.$prospecto->nombre_2, ['class' => 'form-control' . ($errors->has('nombre_1') ? ' is-invalid' : ''), 'placeholder' => 'Nombres']) }}
            {!! $errors->first('nombre_1', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Apellidos')}}</label>
            {{ Form::text('apellidos', $prospecto->apellido_1.' '.$prospecto->apellido_2, ['class' => 'form-control' . ($errors->has('apellido_1') ? ' is-invalid' : ''), 'placeholder' => 'Apellidos']) }}
            {!! $errors->first('apellido_1', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Número de documento')}}</label>
            {{ Form::text('cedula', $prospecto->cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'C.C.']) }}
            {!! $errors->first('cedula', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Número de celular')}}</label>
            {{ Form::text('celular', $prospecto->celular, ['class' => 'form-control' . ($errors->has('celular') ? ' is-invalid' : ''), 'placeholder' => '+57']) }}
            {!! $errors->first('celular', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Correo electrónico')}}</label>
            {{ Form::text('correo', $prospecto->correo, ['class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'placeholder' => 'ejemplo@ejemplo.com']) }}
            {!! $errors->first('correo', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Caja de compensación')}}</label>
            {{ Form::text('caja_compensacion', $prospecto->caja_compensacion, ['class' => 'form-control' . ($errors->has('caja_compensacion') ? ' is-invalid' : ''), 'placeholder' => 'Caja Compensacion']) }}
            {!! $errors->first('caja_compensacion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Actividad económica')}}</label>
            {{ Form::text('actividad', $prospecto->actividad, ['class' => 'form-control' . ($errors->has('actividad') ? ' is-invalid' : ''), 'placeholder' => 'Actividad']) }}
            {!! $errors->first('actividad', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Ingresos mensuales')}}</label>
            {{ Form::text('ingresos', $prospecto->ingresos, ['class' => 'form-control' . ($errors->has('ingresos') ? ' is-invalid' : ''), 'placeholder' => 'Ingresos']) }}
            {!! $errors->first('ingresos', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Saldo en cesantías')}}</label>
            {{ Form::text('cesantias', $prospecto->cesantias, ['class' => 'form-control' . ($errors->has('cesantias') ? ' is-invalid' : ''), 'placeholder' => 'Cesantias']) }}
            {!! $errors->first('cesantias', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Ahorros')}}</label>
            {{ Form::text('ahorros', $prospecto->ahorros, ['class' => 'form-control' . ($errors->has('ahorros') ? ' is-invalid' : ''), 'placeholder' => 'Ahorros']) }}
            {!! $errors->first('ahorros', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            <label class="mt-3">{{__('Documentos cliente')}}</label>
            {{ Form::text('documentos_cliente', $prospecto->documentos_cliente, ['class' => 'form-control' . ($errors->has('documentos_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Documentos Cliente']) }}
            {!! $errors->first('documentos_cliente', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="w-full btn mt-3 btn-primary">{{__('Enviar')}}</button>
    </div>
</div>
