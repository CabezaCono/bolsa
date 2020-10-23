@extends('layouts.layout') 

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(\Route::currentRouteName() != "teacher.edit" && \Route::currentRouteName() != "user.settings" )
                        <h2 align="center">Editar</h2>
                        <h4 align="center">{{$teacher->user->name}}</h4>
                    @else
                        <h2 align="center">Ajustes</h2>
                    @endif
                </div>
                <div class="panel-body">
                    {{Form::model($teacher, ['route' => ['teacher.update', $teacher->id],'method'=>'PUT'])}}
                    @include('teachers.partials.form')
                    @can("update",$teacher)
                    <div class="form-group pull-right">
                        {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
                    </div>
                    @endcan
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