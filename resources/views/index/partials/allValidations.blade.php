<div class="x_panel">
     <div class="x_title">
        <h2>Recientes<small>Validaciones</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
           </li>

           <li><a class="close-link"><i class="fa fa-close"></i></a>
           </li>
        </ul>
        <div class="clearfix"></div>
     </div>
     <div class="x_content">
        <div class="slimScroll">
           <ul class="list-unstyled timeline">
              @forelse($allValidations as $validation)
                @include("index.partials.validations")
              @empty
                  <p>Está vacío</p>
              @endforelse
           </ul>

        </div>
     </div>
  </div>