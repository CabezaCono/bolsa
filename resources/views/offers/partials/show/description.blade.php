<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <h3>Descripción</h3>
                        <div class="col-lg-12">
                            <br>
                            <p>{{$offer->description}}</p>
                            <br>
                            <h4>Requisitos</h4>
                            <p>{{$offer->requirements}}</p>
                            <br>
                            <h4>Requisitos recomendados</h4>
                            <p>{{$offer->recommended}}</p>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                            <h5>Ciudad</h5>
                            <p>{{$offer->enterprise->ciudad}} ({{$offer->enterprise->pais}})</p>
                            <h5>Jornada</h5>
                            <p> {{($offer->work_day == "full day")?"Completa":"Media"}}</p>
                            <h5>Contrato</h5>
                            <p>{{$offer->contract}}</p>
                            <h5>Salario</h5>
                            <p>{{$offer->salary}}€</p>
                            <h5>Familia Profesional</h5>
                            <p>{{ $offer->family->name }}</p>
                            <h5>Vacantes</h5>
                            <p>{{$offer->student_number}}</p>
                        </div>
                    </div>
                    @if(auth()->user()->rol == "is_student")
                    <div class="col-lg-12">
                        <hr>
                         @include("offers.partials.show.subscribeButton")
                        <hr>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>