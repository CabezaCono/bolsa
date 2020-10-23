@extends('layouts.mail')

<!--We're in a table . Estamos en una tabla -->
@section('content')

    <tr>
        <td class="content-block" style="text-align:center;">

            <h3>Enhorabuena,</h3>
        </td>
    </tr>
    <tr style="text-align:center">
        <td class="content-block">
            Le han invitado a participar en <a href="{{url("/")}}">Bolsa IES CIERVA</a> <br><br>

            Ya puede crearse una cuenta de Profesor intruduciendo el siguiente código en el formulario de registro <br>
            <br>
            <hr>
            <h1><b>{{$doorman}}</b></h1><br><br>

            <hr>
            <br><br>
            Gracias por confiar en nosotros.
        </td>
    </tr>

    <tr style="text-align:center">
        <td class="content-block">
            <a href="{{route("register")}}" class="btn-primary"> Registrarme </a>
        </td>
    </tr>

@endsection