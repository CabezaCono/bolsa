@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 align="center">{{$family->name}}</h2>
                        <a href="{{route("family.edit",$family->id)}}" class="btn btn-info">Editar</a>
                    </div>
                    
                    <div class="panel-body">
                        @foreach($family->cicles as $cicle)
                            <div class="col-lg-12">
                                <a href="{{route("cicle.show",$cicle->id)}}">
                                    <div class="panel panel-default">
                                        <h3 align="center">{{$cicle->name}}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-secondary pull-left" href="{{route("family.index")}}">Ir al Index</a>
                        <h5 align="right"><sup>Creado el: {{$family->created_at}}</sup></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection