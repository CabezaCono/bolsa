@extends('layouts.layout')
@section("css")
    <link href="{{ asset('vendor/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/ion.rangeSlider/css/ion.rangeSlider.skinModern.css') }}" rel="stylesheet">
    <style>
        #families-select {
            margin-right: -4px;
            border-top-left-radius: 7px;
            border-bottom-left-radius: 7px;
            width: 15%;
        }

        #inlineFormInput {
            width: 75%;
        }

        @media (max-width: 768px) {
            /* For mobile phones: */
            #inlineFormInput, #families-select {
                width: 100%;
            }
        }

    </style>



@endsection
@section('content')
    <div class="container-fluid">
        {{Form::open(["method" => "GET"])}}
        <div class="row">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body" style="background-image: url('{{asset($quote['image'])}}');">
                        <ul class="nav navbar-right pull-right">
                            <li class="dropdown" style="border: none">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i
                                            style="font-size: 15px" class="fa fa-ellipsis-v"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route("offers.create")}}">Nueva Oferta</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="">
                            <h1 class="text-center" style="color: #ffffff;">Ofertas</h1>
                        </div>

                        <!-- <form class="form-inline col-xs-offset-1">-->
                        <div class="form-inline "> <!-- ESTO NO ESTABA, estaba form-->
                            <!-- Select con el método de búsqueda-->
                        {{ Form::select('family', $families, $request->get("family"), ['class' => 'form-control',"placeholder" => "Familia","id" => "families-select"]) }}
                        <!-- Input con el término de la búsqueda -->
                            <input type="text" class="form-control"
                                   id="inlineFormInput" name="search" placeholder="Buscar Ofertas"
                                   value="{{ $request->get("search") }}">
                            <button type="submit" class="form-control"
                                    style="margin-top: 5px; margin-left:-5px;border-top-right-radius: 4px;border-bottom-right-radius: 4px;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div> <!-- ESTO NO ESTABA, estaba form-->

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center">
                    @if($offers->total() > 0)
                        {{$offers->total()}} ofertas listas para ti.
                    @else
                        Lo sentimos, actualmente no tenemos ofertas para usted, vuelva más tarde...
                    @endif
                </h2>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @include("offers.partials.filtro")
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="list">
                        @include('offers.partials.table')
                        <div class="text-center"> {{$offers->appends(Request::except('page'))->render()}}</div>
                    </div>

                    <div class="tab-pane fade in" id="menu2">
                        @include('offers.partials.table2')
                        <div class="text-center"> {{$offers->appends(Request::except('page'))->render()}}</div>
                    </div>
                </div>

            </div>

            {{Form::close()}}
        </div>
    </div>
@endsection

@section("js")
    <script src="{{ asset('vendor/ion.rangeSlider/js/ion.rangeSlider.min.js') }}"></script>
    <script>

    </script>
@endsection