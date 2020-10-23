<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @if(!$enterprises->isEmpty())
            {!! Form::open(['method' => 'post', 'route' => ['user.toggle.selected']]) !!}
            @endif
            <article class="container">
                @if(!$enterprises->isEmpty())

                <div  >
                    <div class="pull-left">
                        <input type="checkbox" class="check-padre" id="enterprise">Marcar Todos
                    </div>

                    <div class="pull-right">
                        <button class="btn btn-success" type="submit">Validar Seleccionados</button>
                        <br>
                        <br>
                    </div>
                </div>

                @endif
                <div class="col-xs-12" >
                    @if(!$enterprises->isEmpty())
                    @foreach($enterprises as $enterprise)
                    <div class="col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <h2><label><input type="checkbox" name="selected[]" id="enterprise" value=" {{$enterprise->user->id}}">{{ $enterprise->user->name }} <small>{{ $enterprise->sociedad }}</small></label></h2>

                                <ul class="nav navbar-right panel_toolbox">
                                    <li data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Buscar en Google"><a
                                            href="https://www.google.es/search?q={{str_slug($enterprise->user->name ." ".$enterprise->sociedad,"+")}}"
                                            target="_blank"><i  class="fa fa-google"></i></a>
                                    </li>
                                    <li data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Vistiar web"><a
                                            href="{{$enterprise->web}}" target="_blank" ><i  class="fa fa-globe"></i></a>
                                    </li>
                                    <!--                                            <a target="_blank" href="{{$enterprise->web}}">Visitar web</a>-->


                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>

                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="slimScroll">
                                    <table class="table table-striped">
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
                                                Sociedad:
                                            </td>
                                            <td>
                                                <{{$enterprise->sociedad}}
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
                                                <a href="{{$enterprise->web}}" title="{{ $enterprise->user->name }}" target="_blank">{{$enterprise->web}}</a>

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
                                                Empleados:
                                            </td>
                                            <td>
                                                {{$enterprise->min_empleados}} - {{$enterprise->max_empleados}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {!! Form::close() !!}
                    @else
                    <article class="container">
                        <hr>
                        <h2 align="center">Vaya!</h2>
                        <h3 align="center">Parece que no hay nada que validar aquí.</h3>
                        <h4 align="center">Buen trabajo!</h4>
                        <hr>
                    </article>
                    @endif
                </div>


            </article>

        </div>
    </div>
</div> 