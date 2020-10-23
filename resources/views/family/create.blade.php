@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-md-offset-5"> <h3>Nueva Familia</h3></div>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => 'family.store', 'method' => 'post' , 'class' => 'form']) }}
                            @include('family.partials.form')
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
        </div>
    </div>
@endsection