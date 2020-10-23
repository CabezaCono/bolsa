@extends('layouts.layout')

@section("css")
    <style type="text/css">
        .nav-tabs > li, .nav-pills > li {
            float: none;
            display: inline-block;
            *display: inline; /* ie7 fix */
            zoom: 1; /* hasLayout ie7 trigger */
        }

        .nav-tabs, .nav-pills {
            text-align: center;
        }

        .nav-tabs {
            border-bottom: 2px solid #DDD;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
            border-width: 0;
        }

        .nav-tabs > li > a {
            border: none;
            color: #666;
        }

        .nav-tabs > li.active > a, .nav-tabs > li > a:hover {
            border: none;
            color: #4285F4 !important;
            background: transparent;
        }

        .nav-tabs > li > a::after {
            content: "";
            background: #4285F4;
            height: 2px;
            position: absolute;
            width: 100%;
            left: 0px;
            bottom: -1px;
            transition: all 250ms ease 0s;
            transform: scale(0);
        }

        .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after {
            transform: scale(1);
        }

        .tab-nav > li > a::after {
            background: #21527d none repeat scroll 0% 0%;
            color: #fff;
        }

        .tab-pane {
            padding: 15px 0;
        }

        .tab-content {
            padding: 20px
        }

        .card {
            background: #FFF none repeat scroll 0% 0%;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Nav tabs -->
                <div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active" ><a href="#acepted" aria-controls="acepted" role="tab"
                                                                   data-toggle="tab">Aceptadas</a></li>

                        <li role="presentation"><a href="#pending" aria-controls="pending" role="tab"
                                                       data-toggle="tab">Pendientes</a></li>

                        <li role="presentation"><a href="#denied" aria-controls="denied" role="tab" data-toggle="tab">Denegadas</a>
                        </li>

                        <li role="presentation"><a href="#subscriptions" aria-controls="subscriptions" role="tab" data-toggle="tab">Suscripciones</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="acepted">
                            @foreach($acepted as $offer)
                                @include("offers.partials.show.head")
                            @endforeach
                        </div>
                        <div role="tabpanel" class="tab-pane" id="pending">
                            @foreach($pending as $offer)
                                @include("offers.partials.show.head")
                            @endforeach
                        </div>
                        <div role="tabpanel" class="tab-pane" id="denied">
                            @foreach($denied as $offer)
                                @include("offers.partials.show.head")
                            @endforeach
                        </div>

                        <div role="tabpanel" class="tab-pane" id="subscriptions">
                            @foreach($subscriptions as $offer)
                                @include("offers.partials.show.head")
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->rol == "is_teacher" | auth()->user()->rol == "is_admin")
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-md-6 col-sm-6 col-xs-6s">
                            @include("index.partials.currentUserValidations")
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            @include("index.partials.allValidations")
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection