<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-xs-10">
                        <h3 style="margin-top: 4.5%;"><a
                                    href="{{route("offers.show",$offer->id)}}">{{$offer->title}}</a></h3>
                    </div>
                    <div class="col-xs-2">
                        <a href="{{route("user.profile",$offer->enterprise->user->id)}}">
                            <img style="width: 72px; height: auto; border: 1px solid #e2e5e6;"
                                 src="{{asset("images/enterprise.png")}}"
                                 data-toggle="tooltip"
                                 title="{{$offer->enterprise->user->name}}">
                        </a>
                    </div>
                    <div class="col-xs-12">
                        <hr >
                        <div class="">
                            <ul class="pull-left">
                                <li><a class="btn-link"
                                       href="{{route("user.profile",$offer->enterprise->user->id)}}">{{$offer->enterprise->user->name}}</a>
                                </li>
                                <li>{{$offer->enterprise->ciudad}} ({{$offer->enterprise->pais}})</li>
                                <li>Publicada {{$offer->created_at->diffForHumans()}}</li>
                                <li>Vencimiento: {{$offer->end_date}}</li>
                            </ul>
                            <ul class="pull-left">
                                <li>Salario: {{$offer->salary}}€</li>
                                <li>Contrato: {{$offer->contract}}</li>
                                <li>Jornada: {{($offer->work_day == "full day")?"Completa":"Media"}}</li>
                                <li>Vacantes: {{$offer->student_number}}</li>
                            </ul>
                            <ul class="pull-left">
                                <li>Familia: {{$offer->family->name}} </li>
                            </ul>

                        </div>
                        <div class="text-right">
                            @include("offers.partials.show.subscribeButton")
                            Hay {{$offer->selectionsPositive->count() + $offer->subscriptions->count()}} personas siguiendo la oferta

                        </div>

                    </div>
                    @if(auth()->user()->rol == "is_admin" | auth()->user()->rol == "is_teacher" | auth()->user()->rol == "is_enterprise")
                    <div class="col-xs-12">
                        @if(!$offer->selectionsPending->isEmpty())
                            <hr>
                            <h4>Pendientes</h4>
                            @foreach($offer->selectionsPending as $select)
                                <div class="btn-group">
                                    <a type="button"
                                       class="btn btn-default dropdown-toggle"
                                       data-toggle="dropdown" aria-expanded="false">
                                        {{$select->student->user->name}} {{$select->student->apellidos}}
                                        ({{$select->student->user->email}}) <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="btn btn-link"
                                               href="{{route("user.profile",$select->student->user->id)}}">Ver
                                                Perfil</a>
                                        </li>
                                        @if(auth()->user()->rol != "is_enterprise")
                                        <li>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['offers.selected.destroy', $select->id]]) !!}
                                            <button type="submit" class="btn btn-link">
                                                Eliminar de esta Oferta
                                            </button>
                                            {!! Form::close() !!}
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                        @if(!$offer->selectionsPositive->isEmpty())
                            <hr>
                            <h4>Seleccionados</h4>
                            @foreach($offer->selectionsPositive as $select)
                                <div class="btn-group">
                                    <a type="button"
                                       class="btn btn-default dropdown-toggle"
                                       data-toggle="dropdown" aria-expanded="false">
                                        {{$select->student->user->name}} {{$select->student->apellidos}}
                                        ({{$select->student->user->email}}) <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="btn btn-link"
                                               href="{{route("user.profile",$select->student->user->id)}}">Ver
                                                Perfil</a>
                                        </li>
                                        @if(auth()->user()->rol != "is_enterprise")
                                        <li>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['offers.selected.destroy', $select->id]]) !!}
                                            <button type="submit" class="btn btn-link">
                                                Eliminar de esta Oferta
                                            </button>
                                            {!! Form::close() !!}
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                            @if(auth()->user()->rol != "is_enterprise")
                                @if(!$offer->selectionsNegative->isEmpty())
                                    <hr>
                                    <h4>Declinados</h4>
                                    @foreach($offer->selectionsNegative as $select)
                                        <div class="btn-group">
                                            <a type="button"
                                               class="btn btn-default dropdown-toggle"
                                               data-toggle="dropdown" aria-expanded="false">
                                                {{$select->student->user->name}} {{$select->student->apellidos}}
                                                ({{$select->student->user->email}}) <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a class="btn btn-link"
                                                       href="{{route("user.profile",$select->student->user->id)}}">Ver
                                                        Perfil</a>
                                                </li>
                                                @if(auth()->user()->rol != "is_enterprise")
                                                    <li>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['offers.selected.destroy', $select->id]]) !!}
                                                        <button type="submit" class="btn btn-link">
                                                            Eliminar de esta Oferta
                                                        </button>
                                                        {!! Form::close() !!}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                            @if(!$offer->subscriptions->isEmpty())
                                <hr>
                                <h4>Suscripciones</h4>
                                @foreach($offer->subscriptions as $select)
                                    <div class="btn-group">
                                        <a href="{{route("user.profile",$select->student->user->id)}}"
                                           class="btn btn-default">
                                            {{$select->student->user->name}} {{$select->student->apellidos}}
                                            ({{$select->student->user->email}})
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>