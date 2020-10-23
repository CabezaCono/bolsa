@extends('layouts.mail')

<!--We're in a table . Estamos en una tabla -->
@section('content')

    <tr>
        <td class="content-block" style="text-align:center;">
            <h3>¡Enhorabuena {{$student->user->name}}!</h3>
            <h2>¡Te han seleccionado para una oferta!</h2>
        </td>
    </tr>
    <tr style="text-align:center">
        <td class="content-block">
            <h3>{{ $offer->title }}</h3>
            <br>
            <p style="text-align:center;">
                {{$offer->description}}
            </p>
            <br>
            <h5>Requisitos</h5>
            <p style="text-align:center;">
                {{$offer->requirements}}
            </p>
            <br>
            <p> Horario: {{$offer->work_day}}, {{$offer->schedule}} | Salario: {{$offer->salary}}€</p>

            <h4>Contrato</h4>
            <p>{{$offer->contract}}</p>
        </td>
    </tr>
    <tr style="text-align:center">
        <td class="content-block">
            <a href="{{route("user.myoffers")}}" class="btn-primary"> Mis Ofertas </a>
        </td>
    </tr>

@endsection