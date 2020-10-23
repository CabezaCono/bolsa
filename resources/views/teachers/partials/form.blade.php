@if(\Route::currentRouteName() != "teacher.edit" && \Route::currentRouteName() != "user.settings" )
<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('invitation',"Código de Invitacion") }}
    @endif
    {{ Form::text('code',null,['class'=>'form-control','placeholder' => "Código de Invitacion"]) }}
</div>
@endif
<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('email',"Email") }}
    @endif
    {{ Form::email('email',null,['class'=>'form-control','placeholder' => "Email"]) }}
</div>

<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('name',"Nombre") }}
    @endif
    {{ Form::text('name',null,['class'=>'form-control','placeholder' => "Nombre"]) }}
</div>

<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('apellidos',"Apellidos") }}
    @endif
    {{ Form::text('apellidos',null,['class'=>'form-control','placeholder' => "Apellidos"]) }}
</div>

<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('nrp_expediente',"NRP / Expediente") }}
    @endif
    {{ Form::text('nrp_expediente',null,['class'=>'form-control','placeholder' => "NRP / Expediente"]) }}
</div>

<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('phone',"Telefono") }}
    @endif
    {{ Form::text('phone',null,['class'=>'form-control','placeholder' => "Telefono"]) }}
</div>

<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('password',"Contraseña") }}
    @endif
    {{ Form::password('password',['class'=>'form-control','placeholder' => "Contraseña"]) }}
</div>

<div class="form-group">
    @if(\Route::currentRouteName() != "register.teacher")
        {{ Form::label('password_confirmation',"Repetir Contraseña") }}
    @endif
    {{ Form::password('password_confirmation',['class'=>'form-control','placeholder' => "Repetir Contraseña"]) }}
</div>

@if(auth()->check())
    @if(auth()->user()->rol == "is_admin")
        <div class="form-group">
        @if(\Route::currentRouteName() != "register.teacher")
                {{ Form::label('is_admin',"Admin") }}
            @endif
        {{ Form::checkbox('is_admin',"false") }}
        </div>
    @endif
@endif