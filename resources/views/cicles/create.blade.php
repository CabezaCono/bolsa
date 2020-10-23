@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-md-offset-5"> <h3>Nuevo Ciclo</h3></div>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => 'cicle.store', 'method' => 'post' , 'class' => 'form']) }}
                            @include('cicles.partials.form')
                        <div class="form-group pull-right">
                            {{ Form::submit("Guardar",['class'=>'btn btn-success' ,"name" => "save"]) }}
                        </div>

                        <div class="form-group pull-left">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                        </div>
                            {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection