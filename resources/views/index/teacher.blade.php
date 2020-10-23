@extends("layouts.layout")
@section("content")
<link href="{{asset("css/creative.css")}}" rel="stylesheet"> 
<header style="background-image: url('{{asset($quote['image'])}}')">
    <div class="header-content">
        <div class="header-content-inner">
            <h3 id="homeHeading">"<em>{{$quote["quote"]}}</em>" </h3>
            <br><h1> {{$quote["author"]}}</h1>
            @if($studentCount == 0 && $enterpriseCount == 0)
            	<p>Parece que no tienes nada que validar, suele llamarse trabajo en equipo, ¡vuelve más tarde!</p>
            @else
	            <p>¡Empiece a revisar las validaciones pendientes!</p>
	            <a href="#about" class="btn btn-primary btn-xl page-scroll disabled">X ofertas sin validar</a>
	            <a href="{{ route('student.inactive') }}" class="btn btn-primary btn-xl page-scroll {{ (\App\Student::NoActive()->count() > 0) ? 'active' : 'disabled' }}">{{$studentCount}} alumnos sin validar</a>
	            <a href="{{route("enterprise.inactive")}}" class="btn btn-primary btn-xl page-scroll {{ (\App\Enterprise::NoActive()->count() > 0) ? 'active' : 'disabled' }}">{{$enterpriseCount}} empresas sin validar</a>
            @endif
        </div>
    </div>
</header>
@endsection