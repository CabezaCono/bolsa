<div class="container">
    @foreach($offers as $offer)
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">        
            <div class="panel-body" >              
                <div class=" list-group-item-heading">
                    <a href="{{route("offers.show",$offer->id)}}"><h4 class="col-xs-10"
                                                                      style="color: #6c6c6c">{{str_limit($offer->title,40)}}</h4>
                    </a>
                </div>
                <div class="pull-right">
                    <ul class="nav navbar-right ">
                        <li class="dropdown" style="border: none">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i
                                    style="font-size: 15px" class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="{{route("user.profile",$offer->enterprise->user->id)}}">Ver
                                        Empresa</a>
                                </li>
                                <li><a href="{{route("offers.show",$offer->id)}}">Ver Oferta</a></li>
                                @if(auth()->user()->rol == "is_student")
                                @if(!$offer->subscribed_by_auth)
                                <li><a href="{{route("offers.subscribe",$offer->id)}}">Inscribirme</a></li>
                                @else
                                <li><a href="{{route("offers.unsubscribe",$offer->id)}}">Cancelar Subscripción</a></li>
                                @endif
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="col-xs-12">
                    <a style="margin-top:-20px" class="btn btn-link "
                       href="{{route("user.profile",$offer->enterprise->user->id)}}">{{$offer->enterprise->user->name}} {{$offer->enterprise->sociedad}}</a>
                    <span class="pull-left" style="margin-top:-13px"><i class="fa fa-clock-o"></i> {{$offer->created_at->diffForHumans()}}</span>
                </div>


                <div class="col-xs-12">

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
                                class="fa fa-clock-o"></i>{{($offer->work_day = "full day")?"Jornada Completa":"Media Jornada"}}</span>
                        <span class="label label-success"><i class="fa fa-eur "></i>{{$offer->salary}}</span>
                    </span>
                </div>


            </div>
        </div>
    </div>
    @endforeach
</div>