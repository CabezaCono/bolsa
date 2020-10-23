@extends('layouts.layout')

@section('content')
<div class="x_panel">
    <div class="x_title">
        <h2>Invitar a un profesor<small>admin</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
           
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        {{ Form::open(['route' => 'teacher.invite', 'method' => 'post' , 'class' => 'form']) }}
        <div class="form-group">
            {{ Form::label('email',"Email del Profesor") }}
            {{ Form::text('email',null,['class'=>'form-control','placeholder' => "Ej: ejemplo@dominio.com"]) }}
        </div>

        <div class="form-group pull-right">
            {{ Form::submit("Guardar",['class'=>'btn btn-success']) }}
        </div>

        
        <div class="form-group pull-left">
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
{!! Form::open(['method' => 'POST', 'route' => ['teacher.invitations.clean']]) !!}
<button class="btn btn-default">Limpiar Invitaciones</button>
{!! Form::close() !!}
<div class="x_panel">
    <div class="x_title">
        <h2>Invitaciones <small>admin</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if(!$invites->isEmpty())
            @include("admin.partials.table")
        @else
            <h2 class="text-center">No hay Invitaciones</h2>
        @endif
    </div>
</div>
@endsection