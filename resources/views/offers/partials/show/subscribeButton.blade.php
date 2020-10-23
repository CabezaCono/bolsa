@if(auth()->user()->rol == "is_student")
        @if($offer->selected_by_auth)
            @if($offer->confirmed_selection_by_auth)
                <h3><i class="fa fa-trophy" data-toggle="tooltip" title="¡Enhorabuena! Te han recomendado" style="color: #ecd143;"></i></h3>
                <a class="btn btn-default" href="{{route("offers.proffer",$offer->confirmed_selection_by_auth)}}">Volver a responder</a><br>
            @elseif($offer->denied_selection_by_auth)
                <a class="btn btn-default" href="{{route("offers.proffer",$offer->denied_selection_by_auth)}}">Volver a responder</a><br>
            @elseif($offer->pending_selection_by_auth)
                <a class="btn btn-default" href="{{route("offers.proffer",$offer->pending_selection_by_auth)}}">Responder</a><br>
            @endif
        @else
            @if(empty($offer->subscribed_by_auth))
                <a class="btn btn-default" href="{{route("offers.subscribe",$offer->id)}}">Inscribirme</a><br>
            @else
                <a class="btn btn-warning" href="{{route("offers.unsubscribe",$offer->id)}}">Cancelar Subscripción</a><br>
            @endif
        @endif
@elseif(auth()->user()->rol == "is_teacher" | auth()->user()->rol == "is_admin")
    <div class="col-xs-12">
        <hr class="visible-xs">
        <br class="hidden-xs">
    @if($offer->status == "Pend_Validacion" | $offer->status == "Pend_Confirmacion")
        <div class="col-xs-6">
           <a class="btn btn-default" href="{{route("offers.activate",$offer->id)}}">Sugerir Alumnos</a>
        </div>
    @endif
        <div class="{{($offer->status == "Pend_Validacion" | $offer->status == "Pend_Confirmacion")?"col-xs-6":"col-xs-12"}} text-right">
            <label style="color: #5ba807;" data-toggle="tooltip" title="Confirmado">({{$offer->selectionsPositive->count()}})</label>
            <label style="color: #ffba00;" data-toggle="tooltip" title="Pendiente">({{$offer->selectionsPending->count()}})</label>
            <label style="color: #a83c2c;"  data-toggle="tooltip" title="Rechazado"> ({{$offer->selectionsNegative->count()}})</label>
        </div>
    </div>
@endif

