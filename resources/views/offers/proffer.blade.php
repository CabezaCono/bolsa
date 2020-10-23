@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Es tu decisión...
            </h1>

            <h2 class="text-center">
                {{$selection->teacher->user->name}} {{$selection->teacher->apellidos}} te ha seleccionado
            </h2>
            <hr>
            @include("offers.partials.fichaOffer")
        </div>
    </div>

    <div class="row">
        <h3 class="text-center">¿Te interesa?</h3>
        <hr>
        <div class="col-lg-12">

            {{ Form::open(['route' => ['offers.answer',$selection->id], 'method' => 'post']) }}
            <div class="col-lg-6 text-center" >
                <input type="submit" name="answer" value="NO" style="padding: 35%;" class="btn btn-danger">
            </div>
            <div class="col-lg-6 text-center">
                <input type="submit" name="answer" value="SI" id="yesBtn" style="padding: 35%;" class="btn btn-success">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!-- Modal subida de Curriculum-->
<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="text-center" style="padding-bottom: 10px;">¡Sube tu Curriculum!</h1>
                <p>Añade tu curriculum para aportar mayor información a la empresa que vas a solicitar la entrevista de trabajo, para que puedan conocer todas tus aptitudes y facultades. Será de gran apoyo para su elección.</p>
                <div class="row">
                    <img src="{{ asset("images/motivacion-laboral.jpg") }}" class="img img-responsive" style="padding-bottom: 18px;">
                    {{ Form::open(['route' => ['offers.answer',$selection->id], 'method' => 'post', 'files' => true]) }}
                        {{ Form::file("cv") }}
                        <section id="selectButton" style="margin-top: 10px;">
                            <input type="submit" value="Omitir" id="skipCV" name="optCV" class="btn btn-default" style="float: right;">
                            <input type="submit" value="Subir CV" id="addCV" name="optCV" class="btn btn-success" style="float: right;">
                        </section>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection

@section("js")

<script>
    $("#yesBtn").click(function(event){
        event.preventDefault();
        $("#modal").modal();
    });
</script>

@endsection