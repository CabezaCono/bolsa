<h4>Pendiente de validación</h4>
<div class="widget_summary">
   <div class="w_left w_25">
      <span><a href="{{route("student.inactive")}}"><b>Alumnos</b>   </a></span>

   </div>
   <div class="w_center w_55">
      <div class="progress">
         <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ estadisticasUsuarios("pendingStudentsPorcentaje") }}%;">
         </div>
      </div>
   </div>
   <div class="w_right w_20">
      <span>{{ estadisticasUsuarios("pendingStudents") }}</span>
   </div>
   <div class="clearfix"></div>
</div>
<div class="widget_summary">
   <div class="w_left w_25">
      <span><a href="{{route("teacher.inactive")}}"><b>Profesores</b>   </a></span>
   </div>
   <div class="w_center w_55">
      <div class="progress">
         <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ estadisticasUsuarios("pendingTeachersPorcentaje") }}%;">
         </div>
      </div>
   </div>
   <div class="w_right w_20">
      <span>{{ estadisticasUsuarios("pendingTeachers") }}</span>
   </div>
   <div class="clearfix"></div>
</div>
<div class="widget_summary">
   <div class="w_left w_25">
      <span><a href="{{route("student.inactive")}}"><b>Empresas</b></a></span>
   </div>
   <div class="w_center w_55">
      <div class="progress">
         <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ estadisticasUsuarios("pendingEnterprisesPorcentaje") }}%;">
         </div>
      </div>
   </div>
   <div class="w_right w_20">
      <span>{{ estadisticasUsuarios("pendingEnterprises") }}</span>
   </div>
   <div class="clearfix"></div>
</div>
<div class="widget_summary">
   <div class="w_left w_25">
      <span><a href="#"><b>Ofertas</b>   </a></span>

   </div>
   <div class="w_center w_55">
      <div class="progress">
         <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
            <span class="sr-only">70% Complete</span>
         </div>
      </div>
   </div>
   <div class="w_right w_20">
      <span>545</span>
   </div>
   <div class="clearfix"></div>
</div>