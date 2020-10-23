<table class="table table-hover ">
    <thead>
    <tr>
        <th>#</th>
        <th>Código</th>
        <th>Para</th>
        <th>Usado</th>
        <th>Expiracion</th>
        <th></th>
    </tr>
    </thead>
@foreach($invites as $invite)
        <tr>
            <th>{{ $invite->id }}</th>
            <th>{{ $invite->code }}</th>
            <th>{{$invite->for}}</th>
            <th>{{($invite->uses == 0)?"No":"Si"}}</th>
            <th>{{$invite->valid_until->diffForHumans()}}</th>
            <th>
                {!! Form::open(['method' => 'DELETE', 'route' => ['teacher.invitation.cancel',$invite->id]]) !!}
                <button class="btn btn-default" type="submit">Cancelar</button>
                {!! Form::close() !!}
            </th>
        </tr>
@endforeach
</table>