@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 align="center">{{$cicle->name}}</h2>
                        <a href="{{route("cicle.edit",$cicle->id)}}" class="btn btn-info">Editar</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12">
                            <a href="{{route("family.show",$cicle->family->id)}}">
                                <div class="panel panel-default">
                                    <h3 align="center">{{$cicle->family->name}}</h3>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <a class="btn btn-secondary pull-left" href="{{route("cicle.index")}}">Ir al Index</a>
                        <h5 align="right"><sup>Creado el: {{$cicle->created_at}}</sup></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection