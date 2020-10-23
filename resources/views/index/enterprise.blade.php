@extends("layouts.layout")
@section("content")
<link href="{{asset("css/creative.css")}}" rel="stylesheet">
<header style="background-color: #00a7d0">
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="homeHeading">La unión perfecta entre Alumnos y Empresas</h1>
            <p>Empiece ya, publicando una oferta de trabajo totalmente gratis. Nuestros profesores se encargarán de enviarle a nuestros mejores alumnos</p>
            <a href="#about" class="btn btn-primary btn-xl page-scroll">QUIERO PUBLICAR UNA OFERTA!</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">Tenemos todo lo que usted necesita</h2>
                <p class="text-faded">La calidad de nuestra enseñanza nos acredita. De nuestras aulas salen los mejores profesionales, publique ya una oferta de trabajo y olvídese del resto. Nuestro sistema se encarga de lo demás.<br> <h1><span class="fa fa-trophy animated pulse infinite" style="color: #fffa04;"></span></h1> </p>
                <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Empecemos!</a>
            </div>
        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">A su servicio</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-diamond text-primary sr-icons animated pulse infinite"></i>
                    <h3>Nuestras gemas</h3>
                    <p class="text-muted">Los mejores profesionales, nuestros alumnos</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-paper-plane text-primary sr-icons animated shake infinite" style="animation-duration: 5s"></i>
                    <h3>Rapidez de selección</h3>
                    <p class="text-muted">Conocemos a nuestros alumnos, escogemos a los que mejor puedan adaptarse a su empresa.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-newspaper-o text-primary sr-icons animated wobble infinite" style="animation-duration: 3s"></i>
                    <h3>Actualizados</h3>
                    <p class="text-muted">Nos aseguramos de que las enseñanzas de nuestros alumnos esten a la par con la actualidad del mundo laboral</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-heart text-primary sr-icons animated pulse infinite"></i>
                    <h3>Hecho con Amor</h3>
                    <p class="text-muted">Un sistema eficaz, hecho por alumnos</p>
                </div>
            </div>
        </div>
    </div>
</section>

<aside class="bg-dark">
    <div class="container text-center">
        <div class="call-to-action">
            <h5>¿Aún no se ha decidido?</h5>
            <h1>Publique ya una oferta!</h1>
            <a href="#" class="btn btn-default btn-xl sr-button">Comencemos</a>
        </div>
    </div>
</aside>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading">El contacto es importante</h2>
                <p>Tiene dudas? No sabe como continuar? Llama a nuestro centro, o envia un correo. Resolveremos todas sus dudas y le ayudaremos en el proceso.</p>
            </div>
            <div class="col-lg-4 col-lg-offset-2 text-center">
                <i class="fa fa-phone fa-3x sr-contact"></i>
                <p>123-456-6789</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
            </div>
        </div>
    </div>
</section>

@endsection