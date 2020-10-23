<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(!$offers->isEmpty())
                {!! Form::open(['method' => 'post', 'route' => ['user.toggle.selected']]) !!}
            @endif
            <article class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(!$offers->isEmpty())
                        @foreach($offers as $offer)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-lg-12 list-group-item-heading">
                                        <a href="{{route("offers.show",$offer->id)}}"><h4 class="col-lg-6"
                                                                                          style="color: #6c6c6c">{{str_limit($offer->title,40)}}</h4>
                                        </a>
                                        <div class="col-lg-12">
                                            <a style="margin-top:-20px" class="btn btn-link"
                                               href="{{route("user.profile",$offer->enterprise->user->id)}}">{{$offer->enterprise->user->name}} {{$offer->enterprise->sociedad}}</a>
                                        </div>
                                        <div class="col-lg-12">
                                            <p>{{$offer->description}}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
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

                                        <div class="col-lg-6 text-right">
                                            <a href="{{route("offers.activate",$offer->id)}}" class="btn btn-default"> Validar <i class="fa fa-check"></i></a>
                                        </div>
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

        </div>
    </div>
</div> 