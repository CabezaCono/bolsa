<table id="table-data" class="table table-striped dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr role="row">
            <th>#</th>
            <th>Nombre</th>
            <th>Sociedad</th>
            <th>Empleados</th>
            <th></th>
        </tr>
    </thead>

    <tbody>

        @foreach($empresas as $empresa)
        <tr role="row">
            {{ Form::open(['route' => ['enterprise.destroy',$empresa->id],'method' => 'DELETE',"id" => "delete-form-".$empresa->id]) }}
            {!! Form::close() !!}
            <td>{{ $empresa->id }}</td>
            <td><a href="{{route("user.profile",$empresa->user->id)}}">{{ $empresa->user->name }}</a> </td>
            <td>{{$empresa->sociedad}}</td>
            <td>{{$empresa->min_empleados}} - {{$empresa->max_empleados}}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="btn btn-link" href="{{$empresa->web}}"><i class="fa fa-link"></i> Web</a></li>
                        @can("update",$empresa)
                        <li><a class="btn btn-link" href="{{route('enterprise.edit',$empresa->id)}}"> <i class="fa fa-edit" ></i> Editar</a></li>
                        @endcan
                        @can("delete",$empresa)
                        <li>
                            <a class="btn btn-link" onclick="document.getElementById('delete-form-{{$empresa->id}}').submit();"><i class="fa fa-trash"></i> Eliminar</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </td>

        </tr>
        @endforeach

    </tbody>
</table>