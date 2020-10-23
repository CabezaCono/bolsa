<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @if(!$students->isEmpty())
            {!! Form::open(['method' => 'post', 'route' => ['user.toggle.selected']]) !!}
            @endif
            <article class="container">
                @if(!$students->isEmpty())

                <div >
                    <div class="pull-left">
                        <input type="checkbox" class="check-padre" id="student">Marcar Todos
                    </div>

                    <div class="pull-right">
                        <button class="btn btn-success" type="submit">Validar Seleccionados</button>
                        <br>
                        <br>
                    </div>
                </div>

                @endif

                <div class="col-xs-12" >

                    @if(!$students->isEmpty())
                    @foreach($students as $student)
                    <div class=" col-sm-6 col-xs-12" >
                        <div class="x_panel">
                            <div class="x_title">
                               
                                    <h2><label><input type="checkbox" name="selected[]" id="student" value=" {{$student->user->id}}">{{ $student->user->name }} {{ $student->apellidos }} <small>{{ $student->user->rol }}</small></label></h2>
                                
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <table class="table table-striped">
                                    <tr>
                                        <th>NRE:</th>
                                        <td>{{ $student->nre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $student->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Teléfono:</th>
                                        <td>{{ $student->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vehículo propio:</th>
                                        <td>
                                            {{ ($student->vehiculo) ? "Sí" : "No" }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Estado:</th>
                                        <td>{{ $student->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Domicilio:</th>
                                        <td>{{ $student->domicilio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Edad:</th>
                                        <td>{{ $student->edad }}</td>
                                    </tr>
                                </table>

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