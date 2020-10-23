<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{ Form::label('name ', 'Nombre') }}
@endif
{{ Form::text('name', null, ['class' => 'form-control',"placeholder" => "Nombre"]) }}
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{ Form::label('email', 'Email') }}
@endif
{{ Form::email('email', null, ['class' => 'form-control',"placeholder" => "Correo"]) }}
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{ Form::label('password', 'Password') }}
@endif
{{ Form::password('password',['class' => 'form-control',"placeholder" => "Contraseña"]) }}
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
    {{ Form::label('password_confirmation', 'Repetir Contraseña') }}
@endif
{{ Form::password('password_confirmation',['class' => 'form-control',"placeholder" => "Repetir Contraseña"]) }}
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{ Form::label('sociedad', 'Sociedad') }}
@endif
{{ Form::select('sociedad',["SL"=>"SL","SA"=>"SA","SAE"=>"SAE","SLNE"=>"SLNE","AUT"=>"Autonomo"], null, ['class' => 'form-control',"placeholder" => "Sociedad"]) }}
<br>
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{ Form::label('phone', 'Telefono') }}
@endif
{{ Form::text('phone', null, ['class' => 'form-control',"placeholder" => "Teléfono"]) }}
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{Form::label('CIF', 'CIF')}}
@endif
{{Form::text('cif', null, ['class' => 'form-control',"placeholder" => "CIF"]) }}
</div>

@if(\Route::currentRouteName() != "register.enterprise")
<div class="form-group">
{{Form::label('fax', 'Fax')}}
{{Form::text('fax', null, ['class' => 'form-control',"placeholder" => "Fax"]) }}
</div>
@endif

@if(\Route::currentRouteName() != "register.enterprise")
<div class="form-group">
{{Form::label('fecha_fundacion', 'Fecha de Fundacion')}}
{{Form::date('fecha_fundacion', null, ['class' => 'form-control',"placeholder" => "Fecha de Fundación"]) }}
</div>
@endif

@if(\Route::currentRouteName() != "register.enterprise")
<div class="form-group">
{{Form::label('web', 'Web')}}
{{Form::text('web', null, ['class' => 'form-control',"placeholder" => "Sitio Web"]) }}
</div>
@endif

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{Form::label('pais', 'Pais')}}
@endif
{{Form::text('pais', null, ['class' => 'form-control',"placeholder" => "Pais"]) }}
</div>

<div class="form-group">
@if(\Route::currentRouteName() != "register.enterprise")
{{Form::label('ciudad', 'Ciudad')}}
@endif
{{Form::text('ciudad', null, ['class' => 'form-control',"placeholder" => "Ciudad"]) }}
</div>

@if(\Route::currentRouteName() != "register.enterprise" && auth()->check() &&auth()->user()->rol != "is_enterprise")
<div class="form-group">
{{Form::label('score', 'Score')}}
{{Form::text('score', null, ['class' => 'form-control',"placeholder" => ""]) }}
</div>
@endif

@if(\Route::currentRouteName() != "register.enterprise")
<div class="form-group">
{{Form::label('min_empleados', 'Empleados minimos')}}
{{Form::text('min_empleados', null, ['class' => 'form-control',"placeholder" => "Nº mínimo de Empleados (aprox)"]) }}
</div>
@endif


@if(\Route::currentRouteName() != "register.enterprise")
<div class="form-group">
{{Form::label('max_empleados', 'Empleados máximos')}}
{{Form::text('max_empleados', null, ['class' => 'form-control',"placeholder" => "Nº Máximo de Empleados (aprox)"]) }}
</div>
@endif


@if(\Route::currentRouteName() != "register.enterprise")
    <div class="form-group">
        {{ Form::label('descripcion', 'Descripcion') }}
        {{ Form::textarea('descripcion', null, ['class' => 'form-control',"placeholder" => "Descripcion"]) }}
    </div>
@endif

