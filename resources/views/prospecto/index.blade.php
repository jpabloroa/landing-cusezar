@extends('layouts.app')

@section('template_title')
    Prospecto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Prospecto') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('prospectos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre 1</th>
										<th>Nombre 2</th>
										<th>Apellido 1</th>
										<th>Apellido 2</th>
										<th>Cedula</th>
										<th>Celular</th>
										<th>Correo</th>
										<th>Caja Compensacion</th>
										<th>Actividad</th>
										<th>Ingresos</th>
										<th>Cesantias</th>
										<th>Ahorros</th>
										<th>Documentos Cliente</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prospectos as $prospecto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $prospecto->nombre_1 }}</td>
											<td>{{ $prospecto->nombre_2 }}</td>
											<td>{{ $prospecto->apellido_1 }}</td>
											<td>{{ $prospecto->apellido_2 }}</td>
											<td>{{ $prospecto->cedula }}</td>
											<td>{{ $prospecto->celular }}</td>
											<td>{{ $prospecto->correo }}</td>
											<td>{{ $prospecto->caja_compensacion }}</td>
											<td>{{ $prospecto->actividad }}</td>
											<td>{{ $prospecto->ingresos }}</td>
											<td>{{ $prospecto->cesantias }}</td>
											<td>{{ $prospecto->ahorros }}</td>
											<td>{{ $prospecto->documentos_cliente }}</td>

                                            <td>
                                                <form action="{{ route('prospectos.destroy',$prospecto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('prospectos.show',$prospecto->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('prospectos.edit',$prospecto->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $prospectos->links() !!}
            </div>
        </div>
    </div>
@endsection
