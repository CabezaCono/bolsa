<h4>Usuarios</h4>
<div class="x_content">
   <table class="" style="width:100%">
      <tr>
         <td>
            <canvas class="canvasUsers" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
         </td>
         <td>
            <table class="tile_info">
               <tr>
                  <td>
                     <p><i class="fa fa-square blue"></i>Alumnos </p>
                  </td>
                  <td><span>{{ estadisticasUsuarios('studentsPorcentaje') }}</span>%</td>
                  <span id="studentsNumero" class="hidden">{{ estadisticasUsuarios('studentsNumero') }}</span>
               </tr>
               <tr>
                  <td>
                     <p><i class="fa fa-square green"></i>Empresas </p>
                  </td>
                  <td><span>{{ estadisticasUsuarios('enterprisesPorcentaje') }}</span>%</td>
                  <span id="enterprisesNumero" class="hidden">{{ estadisticasUsuarios('enterprisesNumero') }}</span>
               </tr>
               <tr>
                  <td>
                     <p><i class="fa fa-square purple"></i>Profesores </p>
                  </td>
                  <td><span>{{ estadisticasUsuarios('teachersPorcentaje') }}</span>%</td>
                  <span id="teachersNumero" class="hidden">{{ estadisticasUsuarios('teachersNumero') }}</span>
               </tr>
               <tr>
                  <td>
                     <p><i class="fa fa-square red"></i>Admins </p>
                  </td>
                  <td><span>{{ estadisticasUsuarios('adminsPorcentaje') }}</span>%</td>
                  <span id="adminsNumero" class="hidden">{{ estadisticasUsuarios('adminsNumero') }}</span>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</div>