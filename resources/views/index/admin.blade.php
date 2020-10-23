@extends("layouts.layout")
@section("content")
   @include("index.partials.infoTopAdmin")
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="text-center">
               <h2>Estadísticas</h2>
               <div class="clearfix"></div>
            </div>
            <div class="col-xs-12 col-sm-6">
               @include("index.partials.estadisticasUsuarios")
            </div>
            <div class="col-xs-12 col-sm-6">
               @include("index.partials.estadisticasPendienteValidacion")
            </div>
         </div>
      </div>  
   </div>

   <div class="row">
      <div class="col-xs-12 col-sm-6"> 
         @include("index.partials.currentUserValidations")
      </div> 
      <div class="col-xs-12 col-sm-6">
         @include("index.partials.allValidations")
      </div>
   </div>
@endsection