@extends('layouts.layout')
@section("css")
    <link href="{{asset("vendor/multiselect/css/multi-select.css")}}" media="screen" rel="stylesheet" type="text/css">
    <style> .ms-container {
            width: 100%;
        }</style>
@endsection
@section('content')
    <div class="container">
        @include("offers.partials.show.head")

        @if($offer->status == "Pend_Validacion" | $offer->status == "Pend_Confirmacion")
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    {{ Form::open([ 'method' => 'GET' , 'class' => 'form-horizontal form-label-left',"id" => "form-search"]) }}
                    <h3 class="text-center">Selecciona tus Alumnos</h3>
                    <hr>
                    <div class="input-group">
                        {{ Form::select('family', $families, $idFamily, ['class' => 'form-control',"placeholder" => "Familia","id" => "families-select"]) }}
                        <span class="input-group-addon"></span>
                        {{ Form::select('cicle', $cicles, "0", ['class' => 'form-control',"placeholder" => "Ciclos","id" => "cicles-select"]) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    {{ Form::open(['route' => ['offers.assign',$offer->id], 'method' => 'POST' , 'class' => 'form-horizontal form-label-left']) }}
                    <div class="form-group">
                        <select multiple="multiple" id="multi-select" name="students[]"
                                class="form-control">
                            @foreach($students as $student)
                                <option value="{{$student->id}}">{{$student->id}} {{$student->user->name}} {{$student->apellidos}}
                                    ({{$student->user->email}})
                                </option>
                            @endforeach
                        </select>
                        <hr>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-default">Confirmar Alumnos</button>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="text-center">¡Genial! La oferta ha avanzado a la siguiente fase</h3>
                            <h4 class="text-center">Ahora hay que esperar</h4>
                            <h5 class="text-center">a que los alumnos nos den el si quiero...</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("js")
    <script src="{{asset("vendor/multiselect/js/jquery.multi-select.js")}}"></script>
    <script>
        $("#families-select").change(function () {
            var idFamily = $("#families-select").val();
            $.ajax({
                type: "GET",
                url: "{{ url("admin/family/cicles") }}/" + idFamily,
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $("#cicles-select").empty();
                    $("#cicles-select").append('<option value="0">Todos los ciclos</option>');
                    $.each(obj.reverse(), function () {
                        $("#cicles-select").append('<option value="' + this.id + '">' + this.name + '</option>');
                    });
                },
            });
        });

        $("#cicles-select").change(function(){
            $("#form-search").submit();
        });
    </script>
    <script>
        $('#multi-select').multiSelect();
    </script>
@endsection