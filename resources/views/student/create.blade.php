@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-md-offset-5"><h3>Nuevo Alumno</h3></div>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => ['student.store'],'method' => 'POST']) }}
                        @include('student.partials.fields')
                        <div class="form-group pull-right">
                            {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
                        </div>
                        
                        <div class="form-group pull-left">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                        </div>
                        {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection