<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            @if(!$offers->isEmpty())
            {!! Form::open(['method' => 'post', 'route' => ['user.toggle.selected']]) !!}
            @endif
            <article class="container">
                <div class="col-xs-12 col-md-12 col-sm-12 col-xs-12">
                    @if(!$offers->isEmpty())
                    @foreach($offers as $offer)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-xs-12 list-group-item-heading">
                                <a href="{{route("offers.show",$offer->id)}}"><h4 class="col-xs-6"
                                                                                  style="color: #6c6c6c">{{str_limit($offer->title,40)}}</h4>
                                </a>

                                <a  class="btn btn-link pull-right"
                                    href="{{route("user.profile",$offer->enterprise->user->id)}}">{{$offer->enterprise->user->name}} {{$offer->enterprise->sociedad}}</a>

                                <div class="col-xs-12">
                                    <p>{{$offer->description}}</p>
                                </div>
                            </div>

                            <div class="col-xs-12">

                                <span class="pull-left">
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



                                <a  href="{{route("offers.activate",$offer->id)}}" class="btn btn-default pull-right"> Validar <i class="fa fa-check"></i></a>

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