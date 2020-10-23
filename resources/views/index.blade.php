<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Bolsa de Trabajo</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset("vendor/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="{{asset("vendor/font-awesome/css/font-awesome.min.css")}}">
        <link rel="stylesheet" href="{{asset("vendor/simple-line-icons/css/simple-line-icons.css")}}">
        <link rel="stylesheet" href="{{asset("vendor/device-mockups/device-mockups.min.css")}}">

        <!-- Theme CSS -->
        <link href="{{asset("css/new-age.css")}}" rel="stylesheet">
        <!-- Animate -->
        <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <style>
        header {
            position: relative;
            width: 100%;
            min-height: auto;
            overflow-y: hidden;
            background: url("{{asset("images/pattern-test.png")}}"), #4882a6;
            /* fallback for old browsers */
            background: url("{{asset("images/pattern-test.png")}}"), -webkit-linear-gradient(to left, #b240d7, #4882a6);
            /* Chrome 10-25, Safari 5.1-6 */
            background: url("{{asset("images/pattern-test.png")}}"), linear-gradient(to left, #b240d7, #4882a6);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: white;
        }
        section.cta {
            position: relative;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
            background-position: center;
            background-image: url('{{asset("images/bg-cta.jpg")}}');
            padding: 250px 0;
        }
    </style>
    <body id="page-top">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>

                    <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-rocket animated wobble infinite" style="animation-duration: 6s"></i> Bolsa de Trabajo</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                @if (Route::has('login'))
                    @if (Auth::check())
                <li>
                    <a href="{{ url('/home') }}">Home</a>
                </li>
                    @endif
                @endif
                    <li>
                        <a class="page-scroll" href="#home">Inicio</a>
                    </li>
                <li>
                    <a class="page-scroll" href="#features">Características</a>
                </li>
                <li>
                    <a class="page-scroll" href="#empecemos">Empecemos</a>
                </li>
                @if (Route::has('login'))
                    @if (!Auth::check())
                    <li>
                        <a href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registro <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">¿Quién eres?</li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("register.student")}}">Soy un Alumno</a></li>
                            <li><a href="{{route("register.teacher")}}">Soy un Profesor</a></li>
                            <li><a href="{{route("register.enterprise")}}">Soy una Empresa</a></li>
                        </ul>
                    </li>

                    <li role="separator" class="divider hidden-lg hidden-md hidden-sm"><hr></li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{route("register.student")}}">Soy un Alumno</a></li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{route("register.teacher")}}">Soy un Profesor</a></li>
                    <li class="hidden-lg hidden-md hidden-sm"><a href="{{route("register.enterprise")}}">Soy una Empresa</a></li>
                    @endif
                @endif
            </ul>

                </div>

                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div id="home" class="container">

                <div class="col-sm-6 pull-left">
                    <div class="header-content">
                        <div class="header-content-inner">
                            <div class="logo" id="div-love-heart" style="margin-top: 7%;">
                                <sup>hecha con <span class="fa fa-heart animated bounceIn infinite" id="love-heart"></span> por <b><a target="_blank" href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members">Bolsa de Trabajo Team&#8482; </a></b> </sup>
                                <h1 align="center"><i class="fa fa-rocket animated wobble infinite" style="animation-duration: 5s"></i> Bolsa de Trabajo </h1>
                                <br>


                            </div>

                            <h2>La unión perfecta entre Empresas y Alumnos</h2>
                            <br><br>
                            <!--<a href="#download" class="btn btn-outline btn-xl page-scroll">Registrate gratis!</a>-->
                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Registrate gratis!
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route("register.student")}}">Como Alumno</a></li>
                                    <li><a href="{{route("register.teacher")}}">Como Profesor</a></li>
                                    <li><a href="{{route("register.enterprise")}}">Como Empresa</a></li>
                                </ul>
                            </div>
                            <hr>
                            <p style="color: #2d3072">Una aplicación de <b><a style="color: #241c2f;" target="_blank" href="http://www.iescierva.net"> IES Ingeniero de la Cierva </a></b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-right" style="position: relative;">
                    <div class="device-container" style="margin-top: 45%;">
                        <div class="device-mockup macbook_2015 portrait white">
                            <div class="device" style="width: 150%; height: 150%;">
                                <div class="screen" style="top: 7.4%; bottom: 10.9%; left: 12.46%; right: 12.4%;">
                                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                    <img src="{{asset("images/mac-device.png")}}" class="img-responsive" alt="">
                                </div>
                                <div class="button">
                                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section  class="features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-heading">
                            <h2>Nos hacía falta. Te hacía falta.</h2>
                            <p class="text-muted">Mira qué es lo que ofrece nuestra aplicación</p>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row" id="features">
                    <div class="col-md-4">
                        <div class="device-container">
                            <div class="device-mockup iphone6_plus portrait white">
                                <div class="device">
                                    <div class="screen">
                                        <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                        <img src="https://i.gyazo.com/9ab82ed19f72936221d9c4f4516ac522.png" class="img-responsive" alt=""> </div>
                                    <div class="button">
                                        <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-screen-smartphone text-primary"></i>
                                        <h3>100% Adaptable</h3>
                                        <p class="text-muted">Usamos las últimas tecnologías del desarrollo web. La aplicación responderá a ti</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-map text-primary"></i>
                                        <h3>No te vas a perder</h3>
                                        <p class="text-muted">Es facil de usar! Lo garantizamos</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-present text-primary"></i>
                                        <h3>Es gratis</h3>
                                        <p class="text-muted">Si, gratis</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-graduation text-primary"></i>
                                        <h3>Hecha por alumnos, para alumnos</h3>
                                        <p class="text-muted">Todos aprendemos con esto!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-lock text-primary"></i>
                                        <h3>Exclusiva</h3>
                                        <p class="text-muted">Sólo estudiantes de <a style="color: #241c2f;" target="_blank" href="http://www.iescierva.net"> IES Ingeniero de la Cierva </a></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <i class="icon-speedometer text-primary"></i>
                                        <h3>Será rápido</h3>
                                        <p class="text-muted"> Antes de que te des cuenta, tendrás tu oferta de trabajo lista! </a></b> </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="empecemos" class="cta">
            <div class="cta-content">
                <div class="container">
                    <h2>Ve a lo importante.<br><br> Nosotros te guiamos</h2>
                    <a href="{{asset("docs/user-guide.pdf")}}" download class="btn btn-outline btn-xl page-scroll">Empecemos</a>
                </div>
            </div>
            <div class="overlay"></div>
        </section>

        <section id="love" class="contact bg-secundary">
            <div class="container">
                <h2>Hecha con <i class="fa fa-heart animated pulse infinite"></i>  </h2>
                <h4>por  <b><a  target="_blank" href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members">Bolsa de Trabajo Team&#8482; </a></b> </h4>
                <div class="row">
                    <div class="col-xs-12">
                        <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img
                                    class="img-responsive center-block" style="margin-bottom:10px;"
                                    alt="Licencia de Creative Commons" style="border-width:0"
                                    src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png"/></a>
                        <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource"
                              property="dct:title" rel="dct:type">bolsadetrabajo2017</span>
                        <br class="visible-xs"> by <br class="visible-xs">
                        <a style="color: #423a1e; text-decoration: underline;" xmlns:cc="http://creativecommons.org/ns#"  href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members" property="cc:attributionName" rel="cc:attributionURL">
                            Fernando Meseguer Fernández, Jose Antonio Gálvez Cobacho, Jose Adrián Pérez Sánchez, Antonio Saura Cánovas,
                            Angel Gassó Hernández, Fernando Hernández Fernández</a>
                        <a style="color: #423a1e; text-decoration: underline;" rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"> is licensed under a Creative Commons
                            Reconocimiento-NoComercial-SinObraDerivada 4.0 Internacional License
                        </a>
                    </div>

                </div>
                <!--<ul class="list-inline list-social">
                    <li class="social-twitter">
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="social-facebook">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="social-google-plus">
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>-->
            </div>
        </section>

        <!-- jQuery -->
        <script src="{{asset("vendor/jquery/dist/jquery.min.js")}}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset("vendor/bootstrap/dist/js/bootstrap.min.js")}}"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/new-age.min.js"></script>

    </body>

</html>
