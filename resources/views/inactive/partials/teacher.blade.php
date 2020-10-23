<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @if(!$teachers->isEmpty())
            {!! Form::open(['method' => 'post', 'route' => ['user.toggle.selected']]) !!}
            @endif
            <article class="container">
                @if(!$teachers->isEmpty())

                <div >
                    <div class="pull-left">
                        <input type="checkbox" class="check-padre" id="teacher">Marcar Todos
                    </div>
                    
                    <div class="pull-right">
                        <button class="btn btn-success" type="submit">Validar Seleccionados</button>
                        <br>
                        <br>
                    </div>
                </div>

                @endif
                
                <div class="col-xs-12" >
                    
                    @if(!$teachers->isEmpty())
                    @foreach($teachers as $teacher)
                    <div class=" col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                
                                    <h2><label><input type="checkbox" name="selected[]" id="teacher" value=" {{$teacher->user->id}}">{{ $teacher->user->name }} <small>{{ $teacher->user->rol }}</small></label></h2>
                                
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                    
                                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            Nombre:
                                        </td>
                                        <td>
                                            {{$teacher->user->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Apellidos:
                                        </td>
                                        <td>
                                            {{$teacher->apellidos}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            NRP/Expediente:
                                        </td>
                                        <td>
                                            {{$teacher->nrp_expediente}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telefono:
                                        </td>
                                        <td>
                                            {{$teacher->user->phone}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email:
                                        </td>
                                        <td>
                                            {{$teacher->user->email}}
                                        </td>
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
            <br>
            <br>
            <br>
        </div>
    </div>
</div>