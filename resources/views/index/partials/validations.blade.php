<li>
   <ul class="nav navbar-right">
      <li class="dropdown" style="border: none">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                    style="font-size: 20px" class="fa fa-ellipsis-v"></i></a>
         <ul class="dropdown-menu" role="menu">
            <li><a href="{{route("user.profile", $validation->user->id)}}">Ver Perfil
                  de {{$validation->user->name}} </a></li>
            <li><a href="{{route("user.profile", $validation->teacher->user->id)}}">Ver Perfil
                  de {{$validation->teacher->user->name}}</a></li>
            {{Form::open(['method' => 'PUT', 'route' => ["user.toggle.active", $validation->user->id]])}}
            <li>
               <button class="btn btn-link"
                       type="submit">{{ ($validation->user->is_active) ? "Desactivar" : "Activar" }}</button>
            </li>
            {{Form::close()}}
         </ul>
      </li>
   </ul>
      <div class="block">
         <div class="tags">
         @if($validation->action == "ADD")
            <a href="#" class="tag tag-positive">
               <span>+1 {{$validation->rol}}</span>
            </a>
         @else
            <a href="#" class="tag tag-negative">
               <span>-1 {{$validation->rol}}</span>
            </a>
         @endif
         </div>
         <div class="block_content">
            <h2 class="title">
            @if($validation->teacher->id != auth()->user()->id)
               <a>{{ $validation->teacher->user->name }} ha {{ ($validation->action == "ADD") ? "activado" : "desactivado" }} a {{$validation->user->name}} <i class="fa fa-circle {{ ($validation->user->is_active) ? "text-success" : "red" }}"></i> </a>
            @else
               <a>Has {{ ($validation->action == "ADD") ? "activado" : "desactivado" }} a {{$validation->user->name}} <i class="fa fa-circle {{ ($validation->user->is_active) ? "text-success" : "red" }}"></i></a>
            @endif
            </h2>
            <div class="byline">
               <span>{{$validation->created_at->diffForHumans()}}</span> by <a>{{$validation->teacher->user->name}}</a>
            </div>
         </div>
      </div>
</li>