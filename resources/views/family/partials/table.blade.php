<table id="table-data" class="table table-striped dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info">
    <thead>
        <tr role="row">
            <th>#</th>
            <th>Nombre</th>
            <th>Creado</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    @foreach($profesionalfamilys as $profesionalfamily)
        <tr role="row">
            {{ Form::open(['route' => ['family.destroy', $profesionalfamily->id],'method' => 'DELETE',"id" => "delete-form-".$profesionalfamily->id]) }}
            {!! Form::close() !!}
            <td> {{$profesionalfamily->id}}</td>
            <td><a href="{{route("family.show",$profesionalfamily->id)}}">{{$profesionalfamily->name}}</a> </td>
            <td>{{$profesionalfamily->created_at->diffForHumans()}}</td>
            <td><span class="label label-info">{{$profesionalfamily->cicles->count()}} ciclos</span></td>
            <td class="text-center">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="btn btn-link" href="{{route("family.edit",$profesionalfamily->id)}}"> <i class="fa fa-edit" ></i> Editar</a></li>
                        <li>
                            <a class="btn btn-link" onclick="document.getElementById('delete-form-{{$profesionalfamily->id}}').submit();"><i class="fa fa-trash"></i> Eliminar</a>
                        </li>
                    </ul>
                </div>
           </td>

        </tr>
    @endforeach
    </tbody>
</table>