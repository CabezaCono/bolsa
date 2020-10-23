<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Ooh.. 403 </title>

    @include("layouts.partials.css")
</head>
<style>
</style>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
            <div class="col-middle">
                <div class="text-center text-center">
                    <h1 class="error-number animated bounce infinite" style="animation-duration: 2.5s">403</h1>
                    <h2>Ups... parece que has tocado algo que no debes</h2>
                    <h4 id="forbidden-sign">
                        <span class="fa-stack fa-lg animated swing infinite" style="animation-duration: 5s">
                          <i class="fa fa-hand-paper-o fa-stack-1x"></i>
                          <i class="fa fa-ban fa-stack-2x text-danger"></i>
                        </span>
                    </h4>

                    <div class="logo logo-error" id="div-love-heart">
                        <sup style="left: 2.5%;">hecha con <span style="color: #ff2825;" class="fa fa-heart animated bounceIn infinite" id="love-heart"></span> por <b><a href="https://bitbucket.org/bolsadetrabajoiescierva/profile/members">Bolsa de Trabajo Team&#8482; </a></b> </sup>
                        <h1 align="center"> Bolsa de Trabajo</h1>
                        <p align="center" id="div-love-heart">
                            Una aplicación de <b><a href="http://www.iescierva.net"> IES Ingeniero de la Cierva </a></b></a></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>

@include("layouts.partials.js")

</body>
</html>