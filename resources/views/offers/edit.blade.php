@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 align="center">Editar</h2>
                        <h4 align="center">{{$offer["title"]}}</h4>
                    </div>
                    <div class="panel-body">
                        {{Form::model($offer, ['route' => ['offers.update', $offer["id"]],'method'=>'PUT'])}}
                        @include('offers.partials.form')
                        <div class="form-group pull-right">
                            {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
                        </div>
                        {{ Form::close() }}
                        <div class="form-group pull-left">
                            <a href="{{route("offers.index")}}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection