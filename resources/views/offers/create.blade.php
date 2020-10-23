@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-md-offset-5"> <h3>Nueva Oferta</h3></div>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => 'offers.store', 'method' => 'post' , 'class' => 'form']) }}
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