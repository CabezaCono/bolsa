@if(auth()->user()->rol == "is_admin")
    <div class="form-group">
        {{ Form::label('enterprise_id',"Empresa") }}
        {{ Form::select('enterprise_id',$enterprises, null, ['class' => 'form-control',"placeholder" => "Empresas"]) }}
    </div>
@endif

<div class="form-group">
    {{ Form::label('title',"Titulo") }}
    {{ Form::text('title',null,['class'=>'form-control','placeholder' => "Ej: Desarrollador Web"]) }}
</div>
<div class="form-group">
    {{ Form::label('family_id',"Familia") }}
    {{ Form::select('family_id', $families, null, ['class' => 'form-control',"placeholder" => "Familia"]) }}
</div>
<div class="form-group">
    {{ Form::label('description',"Descripción") }}
    {{ Form::textarea ('description',null,['class'=>'form-control','placeholder' => "Ej: Puesto de desarrollador senior (full developer) para realizar mantenimiento de webs sobretodo en front-end"]) }}
</div>
<div class="form-group">
    {{ Form::label('requirements',"Requisitos") }}
    {{ Form::text('requirements',null,['class'=>'form-control','placeholder' => "Ej: Desarrollo en PHP, JavaScript y conocimientos del Framework Laravel"]) }}
</div>
<div class="form-group">
    {{ Form::label('recommended',"Recomendados") }}
    {{ Form::text('recommended',null,['class'=>'form-control','placeholder' => "Ej: Full Developer"]) }}
</div>
<div class="form-group">
    {{ Form::label('work_day',"Jornada") }}
    {{ Form::select('work_day',['full day' => "JORNADA COMPLETA", "half day" => "MEDIA JORNADA"],null,['class' => 'form-control',"placeholder" => "Jornada"]) }}
</div>
<div class="form-group">
    {{ Form::label('schedule',"Horario") }}
    {{ Form::text('schedule',null,['class'=>'form-control','placeholder' => "Ej: 8:00-15:00 ininterrumpido"]) }}
</div>
<div class="form-group">
    {{ Form::label('contract',"Contrato") }}
    {{ Form::select('contract',['FCT'=>"FCT",'Practice'=>"PRACTICAS",'Temporay'=>"TEMPORAL",'Indefinite'=>"INDEFINIDO"],null,['class' => 'form-control',"placeholder" => "Contrato"])}}
</div>
<div class="form-group">
    {{ Form::label('salary',"Salario") }}
    {{ Form::number('salary',null,['class'=>'form-control','placeholder' => "Ej: 20K"]) }}
</div>
<div class="form-group">
    {{ Form::label('student_number',"Numero de alumnos") }}
    {{ Form::number('student_number',null,['class'=>'form-control','placeholder' => "Ej: 1-3"]) }}
</div>
<div class="form-group">
    {{ Form::label('start_date',"Fecha comienzo") }}
    {{ Form::date('start_date', \Carbon\Carbon::now()) }}
</div>
<div class="form-group">
    {{ Form::label('end_date',"Fecha fin") }}
    {{ Form::date('end_date', \Carbon\Carbon::now()) }}
</div>