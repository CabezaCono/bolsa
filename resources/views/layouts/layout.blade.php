<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bolsa de Trabajo || IES Ingeniero de la Cierva</title>
    <!-- AQUI EL CSS -->
    @include("layouts.partials.css")
    @yield("css")
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route("home")}}" class="site_title"><i class="fa fa-rocket"></i> <span>Bolsa de Trabajo</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{asset("images/" . str_replace('is_', '', Auth::user()->rol) . ".png")}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenido,</span>
                        <h2>{{auth()->user()->name}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                    @include("layouts.partials.menu")
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">

                    <a href="{{route("user.settings")}}" data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a class="fullScreen-button" data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    {{ Form::open(['route' => 'logout', 'method' => 'post',"id"=>"logout-form"]) }}
                    <a class="logout-button" type="submit" data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                    {{Form::close()}}
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset("images/" . str_replace('is_', '', Auth::user()->rol) . ".png")}}" alt=""><label class="hidden-xs">{{ Auth::user()->name }}</label>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="{{route("user.myoffers")}}">
                                        @if(auth()->user()->rol == "is_student")
                                            <span class="pull-right">{!! offerPendingNotificationCount() !!}</span>
                                        @endif
                                        Mis Ofertas</a>
                                </li>
                                <li>
                                    <a href="{{route("user.profile",auth()->user()->id)}}">Perfil</a>
                                </li>

                                <li>
                                    <a href="{{route("user.settings")}}">Ajustes</a>
                                </li>
                               
                                <li><a href="{{asset("docs/user-guide.pdf")}}" download>Guia de Usuario</a></li>
                                <li><a class="logout-button" href="#"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                        @if (auth()->user()->rol == "is_student")
                        {!! offerPendingNotificationCenter() !!}
                        @endif

                        @if (auth()->user()->rol == "is_admin" || auth()->user()->rol == "is_teacher")
                        {!! userNotificationCenter() !!}

                        {!! offerNotificationCenter() !!}
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" >
            @include("feedback.errors")
            @include("feedback.feedback")
            @yield("content")

        </div>

        <style>
            .right-col[role="main"]{
                min-height: 815px;
            }
        </style>
        <!-- /page content -->

        <!-- footer content -->
        <footer >
            <div class="text-center"><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img class="img-responsive center-block" style="margin-bottom:10px;" alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a>
                <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">bolsadetrabajo2017</span>
                <br class="visible-xs"> by <br class="visible-xs"> <a xmlns:cc="http://creativecommons.org/ns#" href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members" property="cc:attributionName" rel="cc:attributionURL">
                    Fernando Meseguer Fernández, Jose Antonio Gálvez Cobacho, Jose Adrián Pérez Sánchez, Antonio Saura Cánovas,
                    Angel Gassó Hernández, Fernando Hernández Fernández</a>
                is licensed under a
                <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Reconocimiento-NoComercial-SinObraDerivada 4.0 Internacional License</a>.</div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<!-- AQUI LOS SCRIPTS -->
@include("layouts.partials.js")
@yield("js")
</body>
</html>

