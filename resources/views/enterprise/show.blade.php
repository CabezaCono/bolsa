@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 align="center">Empresa</h3>
                        <h4 align="center">{{$enterprise->user->name}}</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    ID:
                                </td>
                                <td>
                                    {{$enterprise->id}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nombre:
                                </td>
                                <td>
                                    {{$enterprise->user->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Telefono:
                                </td>
                                <td>
                                    {{$enterprise->user->phone}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email:
                                </td>
                                <td>
                                    {{$enterprise->user->email}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descripcion:
                                </td>
                                <td>
                                    {{$enterprise->descripcion}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sociedad:
                                </td>
                                <td>
                                    {{$enterprise->sociedad}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    FAX:
                                </td>
                                <td>
                                    {{$enterprise->fax}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    CIF:
                                </td>
                                <td>
                                    {{$enterprise->cif}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Fundacion:
                                </td>
                                <td>
                                    {{$enterprise->fecha_fundacion}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Web:
                                </td>
                                <td>
                                    {{$enterprise->web}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pais:
                                </td>
                                <td>
                                    {{$enterprise->pais}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ciudad:
                                </td>
                                <td>
                                    {{$enterprise->ciudad}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Score:
                                </td>
                                <td>
                                    {{$enterprise->score}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Empleados:
                                </td>
                                <td>
                                    {{$enterprise->min_empleados}} - {{$enterprise->max_empleados}}
                                </td>
                            </tr>
                        </table>
                        <div class="col-xs-12 text-center">
                            <a href="{{url()->previous()}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$offers->isEmpty())
        <h4 class="text-center">Ofertas publicadas por {{$enterprise->user->name}}</h4>
        @include("offers.partials.table")
    @endif
@endsection