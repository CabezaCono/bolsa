@extends("layouts.layout")
@section("content")
<div class="row">
	<a href="#about">
		<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="tile-stats">
				<div class="icon">
					<i class="fa fa-check-square"></i>
				</div>
				<div class="count">x</div>
				<h3>Ofertas aceptadas</h3>
				<p>Has sido aceptado en x ofertas</p>
			</div>
		</div>
	</a>
	<a href="#about">
		<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="tile-stats">
				<div class="icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="count">x</div>
				<h3>Ofertas pendientes</h3>
				<p>x ofertas pendientes de tu aprovación</p>
			</div>
		</div>
	</a>
	<a href="#about">
		<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="tile-stats">
				<div class="icon">
					<i class="fa fa-pause"></i>
				</div>
				<div class="count">x</div>
				<h3>Ofertas en espera</h3>
				<p>Estás inscrito en x ofertas activas</p>
			</div>
		</div>
	</a>
</div>

@endsection