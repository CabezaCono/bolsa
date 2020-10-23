@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 align="center">Editar</h2>
                        <h4 align="center">{{$cicle->name}}</h4>
                    </div>
                    <div class="panel-body">
                        {{Form::model($cicle, ['route' => ['cicle.update', $cicle->id],'method'=>'PUT'])}}
                            @include('cicles.partials.form')
                        <div class="form-group pull-right">
                            {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
                        </div>

                        
                        <div class="form-group pull-left">
                            <a href="{{route("cicle.index")}}" class="btn btn-default">Cancel</a>
                        </div>
                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection