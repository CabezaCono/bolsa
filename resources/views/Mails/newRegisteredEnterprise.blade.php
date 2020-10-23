@extends('layouts.mail')

<!--We're in a table . Estamos en una tabla -->
@section('content')
    <tr>
        <td class="content-block" style="text-align:center;">

            <h3>Bienvenido,{{$user->name}}</h3>
        </td>
    </tr>
    <tr style="text-align:center">
        <td class="content-block">
            Para que ústed pueda publicar ofertas es necesario que un profesor valide su
            perfil.<br> Este proceso durará máximo 48h, si lo desea puede ponerse en contacto con nosotros en info@bolsa
            .iescierva.net.<br>

            Gracias por confiar en nosotros.
        </td>
    </tr>


@endsection