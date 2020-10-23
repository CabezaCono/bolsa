<table class="table table-hover" id="table-data"> 
    <thead> 
        <tr> 
            <th>#</th> 
            <th>Alumno</th> 
            <th>NRE</th> 
            <th style="width: 100px">Email</th>
            <th>Estado</th> 
            <th>Teléfono</th> 
            <th></th>
        </tr> 
    </thead>
    <tbody>
    @foreach($students as $student) 
        <tr>
            {!! Form::open(['method' => 'DELETE', 'route' => ['student.destroy', $student->id],"id" => "delete-form-".$student->id]) !!}
            {!! Form::close() !!}
            <td>{{ $student->user_id }}</td> 
            <td><a href="{{route("user.profile",$student->user->id)}}">{{ $student->user->name }} {{ $student->apellidos }}</a></td>
            <td>{{ $student->nre }}</td> 
            <td>{{ $student->user->email }}</td> 
            <td>{{ $student->status }}</td> 
            <td>{{ $student->user->phone }}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        @can("update",$student)
                        <li><a class="btn btn-link" href="{{route("student.edit",$student->id)}}"> <i class="fa fa-edit" ></i> Editar</a></li>
                        @endcan
                        @can("delete",$student)
                        <li>
                            <a class="btn btn-link" onclick="document.getElementById('delete-form-{{$student->id}}').submit();"><i class="fa fa-trash"></i> Eliminar</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>