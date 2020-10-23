@if(\Route::currentRouteName() != "cicle.edit")
<div class="form-group">
    {{ Form::label('family_id', 'Familia Profesional') }}
    {{ Form::select('family_id',$familys, null, ['class' => 'form-control select2',"placeholder" => "Familia Profesional","style" => "width:100%;"]) }}
    <br>
</div>
@endif
<div class="form-group">
    {{ Form::label('name',"Nombre") }}
    {{ Form::text('name',null,['class'=>'form-control','placeholder' => "Ej: Informática"]) }}
</div>

<div class="form-group">
    {{ Form::label('tipo', 'Tipo') }}
    {{ Form::select('tipo',["CFGS"=>"Grado Superior","CFGM"=>"Grado Medio","FPB"=>"FP Básica"], null, ['class' => 'form-control',"placeholder" => "Tipo de Ciclo"]) }}
    <br>
</div>

<div class="form-group">
    {{ Form::label('plan', 'Plan') }}
    {{ Form::select('plan',["LOE"=>"LOE","LOGSE"=>"LOGSE","LOMCE"=>"LOMCE"], null, ['class' => 'form-control',"placeholder" => "Plan"]) }}
    <br>
</div>