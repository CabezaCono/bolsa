<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cambiar Contraseña || Bolsa de Trabajo </title>

    @include("layouts.partials.css")
</head>

<body class="login">
<div>

    <div class="login_wrapper">

        <div class="animate form login_form">
            <div class="logo" id="div-love-heart" style="margin-top: 3%;">
                <sup>hecha con <span class="fa fa-heart animated bounceIn infinite" id="love-heart"></span> por <b><a href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members">Bolsa de Trabajo Team&#8482; </a></b> </sup>
                <h1 align="center"><i class="fa fa-rocket"></i> Bolsa de Trabajo</h1>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <section class="login_content">
                {{ Form::open(['route' => 'password.request', 'method' => 'post']) }}
                <input type="hidden" name="token" value="{{ $token }}">
                <h1>Cambiar Contraseña</h1>

                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $email or old('email') }}" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password" required />
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Repite la contraseña" name="password_confirmation" required />
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div>
                    <button class="btn btn-default submit" href="index.html">Cambiar Contraseña</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <div class="clearfix"></div>
                    <div>
                        <p align="center" id="div-love-heart">
                            <br>Una aplicación de <b><a href="http://www.iescierva.net"> IES Ingeniero de la Cierva </a></b></a></b>
                        </p>
                    </div>

                </div>
                {{Form::close()}}
            </section>
        </div>

    </div>
</div>
</body>
</html>
