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
                        <li role="presentation" class="active" ><a href="#myoffers" aria-controls="myoffers" role="tab"
                                                                   data-toggle="tab" title="Ofertas en las que he participado en el proceso de selección">Ofertas</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="myoffers">
                            @foreach($offers as $offer)
                                @include("offers.partials.show.head")
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection