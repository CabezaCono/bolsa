@extends('layouts.mail')

<!--We're in a table . Estamos en una tabla -->
@section('content')
                                <tr>
                                    <td class="content-block" style="text-align:center;">
                                        <h3>Bienvenido,{{$user->name}}</h3>
                                    </td>
                                </tr>
                                <tr style="text-align:center">
                                    <td class="content-block">Para poder disfrutar de los servicios que ofrecemos necesita la aprobación de un profesor.<br>Este
                                        proceso durará como máximo 48h. <br>

                                        Gracias por confiar en nosotros.</td>
                                </tr>

@endsection