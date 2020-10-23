<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bolsa de Trabajo</title>

    @include("layouts.partials.css")
</head>

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

<body class="login">

<div>
    <div class="login_wrapper">

        <div class="animate form login_form">
            <div class="logo" id="div-love-heart" style="margin-top: 3%;">
                <sup>hecha con <span class="fa fa-heart animated bounceIn infinite" id="love-heart"></span> por <b><a
                                href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members">Bolsa de Trabajo
                            Team&#8482; </a></b> </sup>
                <h1 align="center"><i class="fa fa-rocket"></i> Bolsa de Trabajo</h1>
            </div>
            @include("feedback.errors")
            <section class="login_content">
                <h1>Crear Cuenta </h1>

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#alumno" aria-controls="alumno" role="tab"
                                                              data-toggle="tab">Alumno</a></li>

                    <li role="presentation"><a href="#empresa" aria-controls="empresa" role="tab" data-toggle="tab">Empresa</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="empresa">

                        {{ Form::open(['route' => ['enterprise.store'],'method' => 'POST']) }}
                        @include("enterprise.partials.formulario")
                        <div>
                            <button class="btn btn-default submit" type="submit">Crear empresa</button>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div role="tabpanel" class="tab-pane active" id="alumno">
                        {{ Form::open(['route' => ['student.store'],'method' => 'POST']) }}
                        @include('student.partials.fields')
                        <button type="submit" class="btn btn-default submit">Crear alumno</button>
                        {{ Form::close() }}
                    </div>
                </div>


                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Ya tienes cuenta?
                        <a href="{{route("login")}}" class="to_register"> Logueate </a>
                    </p>
                    <p class="change_link">
                        <a href="{{route("register.teacher")}}" class="to_register"> Soy profesor </a>
                    </p>
                    <p align="center"><a href="{{ route('password.request') }}">Has perdido tu contraseña?</a></p>

                    <div class="clearfix"></div>
                    <div>
                        <p align="center" id="div-love-heart">
                            <br>Una aplicación de <b><a href="http://www.iescierva.net"> IES Ingeniero de la Cierva </a></b></a></b>
                        </p>
                    </div>

                </div>
            </section>
        </div>

    </div>
</div>
</body>
@include("layouts.partials.js")
</html>