<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login || Bolsa de Trabajo </title>

    @include("layouts.partials.css")
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>


    <div class="login_wrapper">

        <div class="animate form login_form">
            <div class="logo" id="div-love-heart" style="margin-top: 3%;">
                <sup>hecha con <span class="fa fa-heart animated bounceIn infinite" id="love-heart"></span> por <b><a
                                href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members">Bolsa de Trabajo
                            Team&#8482; </a></b> </sup>
                <h1 align="center"><i class="fa fa-rocket"></i> Bolsa de Trabajo</h1>
            </div>
            <section class="login_content">
                {{ Form::open(['route' => 'login', 'method' => 'post']) }}

                <h1>Login</h1>

                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="Username" name="email"
                           value="{{ old('email') }}" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password" required/>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
                <div>
                    <button class="btn btn-default submit pull-right" href="index.html">Acceder</button>
                    <div class="checkbox pull-left">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Recuérdame
                        </label>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    No tienes cuenta?
                    <p class="change_link">
                        <a href="{{route("register.student")}}" class="to_register"> Soy alumno </a>
                        <a href="{{route("register.enterprise")}}" class="to_register"> Soy empresa </a>
                        <a href="{{route("register.teacher")}}" class="to_register"> Soy profesor </a>
                    </p>

                    <p align="center"><a href="{{ route('password.request') }}">Has perdido tu contraseña?</a></p>

                    <div class="clearfix"></div>
                    <div>
                        <p align="center" id="div-love-heart">
                            <br>Una aplicación de <b><a href="http://www.iescierva.net"> IES Ingeniero de la Cierva </a></b></a></b>
                        </p>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img
                                        class="img-responsive center-block" style="margin-bottom:10px;"
                                        alt="Licencia de Creative Commons" style="border-width:0"
                                        src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png"/></a>
                            <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource"
                                  property="dct:title" rel="dct:type">bolsadetrabajo2017</span>
                            <br class="visible-xs"> by <br class="visible-xs">
                            <a xmlns:cc="http://creativecommons.org/ns#"  href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members" property="cc:attributionName" rel="cc:attributionURL">
                                Fernando Meseguer Fernández, Jose Antonio Gálvez Cobacho, Jose Adrián Pérez Sánchez, Antonio Saura Cánovas,
                                Angel Gassó Hernández, Fernando Hernández Fernández</a>
                            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"> is licensed under a Creative Commons
                                Reconocimiento-NoComercial-SinObraDerivada 4.0 Internacional License
                            </a>
                        </div>

                    </div>
                </div>
                {{Form::close()}}
            </section>
        </div>

    </div>

</div>
</body>
</html>
