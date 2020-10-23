@extends('layouts.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(\Route::currentRouteName() != "teacher.edit" && \Route::currentRouteName() != "user.settings" )
                    <h2 align="center">Editar</h2>
                    <h4 align="center">{{$empresa->name}}</h4>
                    @else
                        <h2 align="center">Ajustes</h2>
                    @endif
                </div>
                <div class="panel-body">
                    {{Form::model($empresa, ['route' => ['enterprise.update', $empresa->id],'method'=>'PUT'])}}
                    @include('enterprise.partials.formulario')
                    @can("update",$empresa)
                    <div class="form-group pull-right">
                        {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
                    </div>
                    @endcan
                    <div class="form-group pull-left">
                       <a href="{{route("enterprise.index")}}" class="btn btn-default">Cancel</a>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
