@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h2 align="center">Editar</h2>
                        <h4 align="center">{{$family->name}}</h4>
                    </div>
                    <div class="panel-body">
                        {{Form::model($family, ['route' => ['family.update', $family->id],'method'=>'PUT'])}}
                            @include('family.partials.form')
                        <div class="form-group pull-right">
                            {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
                        </div>

                       <div class="form-group pull-left">
                      <a href="{{route("family.index")}}" class="btn btn-default">Cancel</a>
                    </div>
                            
                            {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection