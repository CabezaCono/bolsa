<div class="panel panel-default">
    <div class="panel-body">
        <div class= list-group-item-heading">
            <a href="{{route("offers.show",$offer->id)}}"><h4 class="col-xs-10"
                                                              style="color: #6c6c6c">{{str_limit($offer->title,51)}}</h4>
            </a>
            <div class="pull-right">
                <ul class="nav navbar-right">
                    <li class="dropdown" style="border: none">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i
                                style="font-size: 15px" class="fa fa-ellipsis-v "></i></a>
                        <ul class="dropdown-menu pull-right" role="menu">
                            @can("update",$offer)
                            <li><a href="{{route("offers.edit",$offer->id)}}">Editar Oferta</a>
                            @endcan
                            <li><a href="{{route("user.profile",$offer->enterprise->user->id)}}">Ver Empresa</a>
                            </li>
                            @can("view",$offer)
                                <li><a href="{{route("offers.show",$offer->id)}}">Ver Oferta</a></li>
                            @endcan
                            @if(\Route::currentRouteName() != "offers.proffer")
                            @if(auth()->user()->rol == "is_student")
                            @if(!$offer->subscribed_by_auth)
                            <li><a href="{{route("offers.subscribe",$offer->id)}}">Inscribirme</a></li>
                            @else
                            <li><a href="{{route("offers.unsubscribe",$offer->id)}}">Cancelar
                                    Subscripción</a></li>
                            @endif
                            @endif
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-xs-12 pull-left">
                De <a class="text-left" href="{{route("user.profile",$offer->enterprise->user->id)}}">{{$offer->enterprise->user->name}}</a>
            </div>
            <div class="hidden-xs col-sm-6 col-xs-6 pull-right text-right">

            <span class="text-right"><i class="fa fa-clock-o"></i> {{$offer->created_at->diffForHumans()}}</span>
            </div>
            <p class="col-xs-12 lead">{{$offer->description}}</p>
        </div>

        <div >
            <div class="col-sm-9 col-sm-9">
                <span>
                    @if($offer->contract == "Practice")
                    <span class="label label-danger"><i
                            class="fa fa-pencil"></i> {{$offer->contract}}</span>
                    @elseif($offer->contract == "Temporay")
                    <span class="label label-warning"><i
                            class="fa fa-pencil"></i> {{$offer->contract}}</span>
                    @elseif($offer->contract == "Indefinite")
                    <span class="label label-success"><i
                            class="fa fa-pencil"></i> {{$offer->contract}}</span>

                    @endif

                    <span class="label label-info"><i
                            class="fa fa-clock-o"></i>{{($offer->work_day == "full day")?"Jornada Completa":"Media Jornada"}}</span>
                    <span class="label label-success"><i class="fa fa-eur "></i>{{$offer->salary}}</span>
                    <span class="label label-warning">{{$offer->family->name}}</span>
                </span>
            </div>
            @if(\Route::currentRouteName() != "offers.proffer")
                @include("offers.partials.show.subscribeButton")
            @endif
        </div>
    </div>
</div>