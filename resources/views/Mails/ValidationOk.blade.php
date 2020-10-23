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
            Acaban de validar su cuenta! <br><br>

            Ya puede empezar a usar los servicios de <a href="bolsa.iescieva.net">Bolsa IES CIERVA</a> .<br>

            Gracias por confiar en nosotros.
        </td>
    </tr>

    <tr style="text-align:center">
        <td class="content-block">
            <a href="{{route("user.profile",$user->id)}}" class="btn-primary"> Ir a su perfil </a>
        </td>
    </tr>

@endsection