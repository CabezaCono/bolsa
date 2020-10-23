@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('email', 'Correo electrónico') }}
@endif
{{ Form::text('email', null, ['class' => 'form-control', "placeholder" => "Email", "id"=>"email"]) }}


@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('name', 'Nombre') }}
@endif
{{ Form::text('name', null, ['class' => 'form-control', "placeholder" => "Nombre"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('apellidos', 'Apellidos') }}
@endif
{{ Form::text('apellidos', null, ['class' => 'form-control', "placeholder" => "Apellidos"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('password', 'Contraseña') }}
@endif
{{ Form::password('password', ['class' => 'form-control', "placeholder" => "Contraseña"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('password_confirmation', 'Repetir Contraseña') }}
@endif
{{ Form::password('password_confirmation', ['class' => 'form-control', "placeholder" => "Repetir Contraseña"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('phone', 'Telefono') }}
@endif
{{ Form::text('phone', null, ['class' => 'form-control', "placeholder" => "Teléfono"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('nre', 'Número regional del estudiante (NRE)') }}
@endif
{{ Form::text('nre', null, ['class' => 'form-control', "placeholder" => "Número regional del estudiante (NRE)"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('domicilio', 'Domicilio') }}
@endif
{{ Form::text('domicilio', null, ['class' => 'form-control', "placeholder" => "Domicilio"]) }}

@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('status', 'Estado del alumno') }}
@endif
{{ Form::select('status',['ESTUDIANDO' => "Estudiando", "FCT" => "En FCT", "CONTRATADO" => "Contratado", "PARO" => "En paro"], "ESTUDIANDO", ['class' => 'form-control']) }}
<br>
@if(\Route::currentRouteName() != "register.student")
    {{ Form::label('edad', 'Edad') }}
@endif
{{ Form::text('edad', null, ['class' => 'form-control', "placeholder" => "Edad"]) }}

<div class="checkbox">
    <label> {{ Form::checkbox('vehiculo')}} Vehiculo Propio</label>
</div>
