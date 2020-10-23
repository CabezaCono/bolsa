@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(\Route::currentRouteName() != "teacher.edit" && \Route::currentRouteName() != "user.settings" )
                        <h2 align="center">Editar</h2>
                        <h4 align="center">{{$student["name"]}}</h4>
                    @else
                        <h2 align="center">Ajustes</h2>
                    @endif
                </div>
                <div class="panel-body">

                    {{ Form::model($student, ['route' => ['student.update',$student],'method' => 'PUT']) }}
                    @include('student.partials.fields')
                    @can("update",$student)
                    {{ Form::submit("Editar",['class' => 'btn btn-warning pull-right'])}}
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