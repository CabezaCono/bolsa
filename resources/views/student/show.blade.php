@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 align="center">Alumno</h3>
                    <h4 align="center">{{ $student->user->name }} {{ $student->apellidos }}</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Alumno:</th>
                            <td>{{ $student->user->name }} {{ $student->apellidos }}</td>
                        </tr>
                        <tr>
                            <th>NRE:</th>
                            <td>{{ $student->nre }}</td>
                        </tr>
                        <tr>
                            <td>
                                Ciclos Formativos:
                            </td>
                            <td>
                                @foreach($student->cicles as $cicle)
                                <p>{{$cicle->name}} Promocion:{{$cicle->pivot->promocion}}</p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $student->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td>{{ $student->user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Vehículo propio:</th>
                            <td>
                                {{ ($student->vehiculo) ? "Sí" : "No" }}
                            </td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>{{ $student->status }}</td>
                        </tr>
                        <tr>
                            <th>Domicilio:</th>
                            <td>{{ $student->domicilio }}</td>
                        </tr>
                        <tr>
                            <th>Edad:</th>
                            <td>{{ $student->edad }}</td>
                        </tr>

                    </table>
                     <div class="col-xs-12 text-center">
                            <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
                        </div>


                    @if($student->cicles->isEmpty())
                    <div class="form-group pull-right">
                        <a class="btn btn-default" href="#" data-toggle="modal" data-target=".bs-example-modal-lg"
                           data-toggle="tooltip"
                           title="Añadir nuevo Ciclo">Nuevo Ciclo</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@if( !$student->cicles->isEmpty() )

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ciclos
                    <small> Formativos</small>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    @can("update",$student)
                    <li>
                        <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-toggle="tooltip"
                           title="Añadir nuevo Ciclo"><i class="fa fa-plus"></i></a>
                    </li>
                    @endcan
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a data-toggle="tooltip" title="Cerrar" class="close-link"><i
                                class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="list-unstyled timeline">
                    @foreach($student->cicles as $cicle)
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{$cicle->name}}
                                <small> {{$cicle->pivot->promocion}}</small>
                            </h2>
                            @can("update", $student)
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    {{ Form::open(['route' => ['student.cicle.destroy',$student->id,$cicle->id],'method' => 'DELETE']) }}
                                    <button class="btn btn-default" type="submit">Eliminar Ciclo</button>
                                    {{ Form::close() }}
                                </li>
                            </ul>
                            @endcan
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

@can("update", $student)
<div class="modal fade bs-example-modal-lg in" tabindex="-1" role="dialog" aria-hidden="true"
     style="display: none; padding:17px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Añadir nuevo Ciclo</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => ['student.cicle.add',$student->id],'method' => 'POST']) }}
                <div class="form-group">
                    {{ Form::label('cicle_id',"Ciclo formativo") }}

                    {{ Form::select('cicle_id', get_model_selectable_by_name(\App\Cicle::all()), null, ['class' => 'form-control',"placeholder" => "Ciclo Formativo"]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('promocion',"Promocion") }}

                    {{ Form::select('promocion',config("select.promocion"), null, ['class' => 'form-control',"placeholder" => "Promocion"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('finalizado',"Acabado: ") }}

                    {{ Form::checkbox('finalizado',"false") }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endcan
@endsection