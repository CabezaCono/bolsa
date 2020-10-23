<table id="table-data" class="table table-striped dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr>
            <th>#</th>
            <th style="width: 150px">Nombre</th>
            <th>NRP</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Admin</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($teachers as $teacher)
        <tr>
            {!! Form::open(['method' => 'DELETE', 'route' => ['teacher.destroy', $teacher->id],"id"=> "delete-form-".$teacher->id]) !!}
            {!! Form::close() !!}

            <td>
                {{$teacher->id}}
            </td>
            <td>
                <a href="{{route("user.profile",$teacher->user->id)}}">{{$teacher->apellidos}}, {{$teacher->user->name}} </a>
            </td>
            <td>
                {{$teacher->nrp_expediente}}
            </td>
            <td>
                {{$teacher->user->email}}
            </td>
            <td>
                {{$teacher->user->phone}}
            </td>
            <td>
                {{$teacher->is_admin}}
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="btn btn-link" href="{{route("teacher.edit",$teacher->id)}}"> <i class="fa fa-edit" ></i> Editar</a></li>
                        <li>
                            <a class="btn btn-link" onclick="document.getElementById('delete-form-{{$teacher->id}}').submit();"><i class="fa fa-trash"></i> Eliminar</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>