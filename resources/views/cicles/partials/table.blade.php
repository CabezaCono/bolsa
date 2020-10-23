<table id="table-data" class="table table-striped table-hover dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info"  width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Plan</th>
            <th class="hidden-xs hidden-sm">Created</th>
            <th style="width: 140px"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($formativeCicles as $formativeCicle)
        <tr>
            {!! Form::open(['method' => 'DELETE', 'route' => ['cicle.destroy', $formativeCicle->id],"id"=> "delete-form-".$formativeCicle->id]) !!}
            {!! Form::close() !!}
            <td>
                {{$formativeCicle->id}}
            </td>
            <td>
                <a href="{{route("cicle.show",$formativeCicle->id)}}">{{$formativeCicle->name}}</a>
            </td>
            <td>
                <a href="{{route("cicle.show",$formativeCicle->id)}}">{{$formativeCicle->tipo}}</a>
            </td>
            <td>
                <a href="{{route("cicle.show",$formativeCicle->id)}}">{{$formativeCicle->plan}}</a>
            </td>
            <td class="hidden-xs hidden-sm">
                {{$formativeCicle->created_at->diffForHumans()}}
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="btn btn-link" href="{{route("cicle.edit",$formativeCicle->id)}}"> <i class="fa fa-edit" ></i> Editar</a></li>
                        <li>
                            <a class="btn btn-link" onclick="document.getElementById('delete-form-{{$formativeCicle->id}}').submit();"><i class="fa fa-trash"></i> Eliminar</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>