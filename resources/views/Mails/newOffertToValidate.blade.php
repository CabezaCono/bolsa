@extends('layouts.mail')

<!--We're in a table . Estamos en una tabla -->
@section('content')
                                <tr>
                                    <td class="content-block" style="text-align:center;">

                                        <h3>Nueva oferta: {{ $offert->id }}</h3>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Titulo </td>
                                    <td>{{ $offert->title }}</td>

                                </tr>

                                <tr>

                                    <td>Creada por</td>
                                    <td>{{$offert->user->name}}</td>

                                </tr>
                                <tr>
                                    <td>Descripción </td>
                                    <td>{{$offert->description}}</td>

                                </tr>

                                <tr>
                                    <td>Requisitos </td>
                                    <td>{{$offert->requirements}}</td>

                                </tr>

                                <tr>
                                    <td>Horario </td>
                                    <td>{{$offert->work_day}}, {{$offert->schedule}}</td>

                                </tr>

                                <tr>
                                    <td>Salario </td>
                                    <td>{{$offert->salary}}</td>

                                </tr>

                                <tr>
                                    <td>Contacto </td>
                                    <td>{{$offert->contract}}</td>

                                </tr>




                                <tr>

                                    <td class="aligncenter"><button>Ir a la oferta</button></td>
                                </tr>
@endsection