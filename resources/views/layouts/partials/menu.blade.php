<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            @if(auth()->user()->rol == "is_enterprise")
                <li><a href="{{route("offers.create")}}"><i class="fa fa-plus-square"></i> Nueva Oferta </a></li>
            @endif

            <li><a href="{{route("offers.index")}}"><i class="fa fa-diamond "></i> Ver Ofertas </a></li>
            @if(auth()->user()->rol != "is_student")
                    <li><a href="{{route("home")}}"><i class="fa fa-home"></i> Home </a></li>
                @else
                    <li><a href="{{route("user.myoffers")}}"><i class="fa fa-trophy"></i> Mis Ofertas </a></li>
            @endif

        </ul>
    </div>
    @if(auth()->user()->rol == "is_admin" || auth()->user()->rol == "is_teacher" )
        <div class="menu_section">
            <h3>Administración</h3>
            <ul class="nav side-menu">
                @if(auth()->user()->rol == "is_admin" || auth()->user()->rol == "is_teacher")
                    <li><a><i class="fa fa-check"></i> Validar<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route("user.inactive")}}">Usuarios</a></li>
                            <li><a href="{{route("offers.inactive")}}">Ofertas</a></li>
                        </ul>
                    </li>
                @endif
                <li><a><i class="fa fa-sitemap"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        <li><a>Alumnos <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class="sub_menu"><a href="{{route("student.index")}}">Ver todos</a></li>
                                @can("create",\App\Student::class)
                                <li><a href="{{route("student.create")}}">Crear nuevo Alumno</a></li>
                                @endcan
                            </ul>
                        </li>
                        @if(auth()->user()->rol == "is_admin")
                            <li><a>Profesores <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="{{route("teacher.index")}}">Ver todos </a></li>
                                    @can("create",\App\Student::class)
                                    <li><a href="{{route("teacher.create")}}">Crear nuevo Profesor</a></li>
                                    @endcan
                                    <li><a href="{{route("teacher.invitations")}}">Invitar </a></li>
                                </ul>
                            </li>
                        @endif
                        <li><a>Empresas <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class="sub_menu"><a href="{{route("enterprise.index")}}">Ver todos</a></li>
                                @can("create",\App\Enterprise::class)
                                <li><a href="{{route("enterprise.create")}}">Crear nueva Empresa </a></li>
                                @endcan
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        @if(auth()->user()->rol == "is_admin")
        <div class="menu_section">
            <h3>Organización</h3>
            <ul class="nav side-menu">

                    <li><a><i class="fa fa-th"></i>Familias Profesionales <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{route("family.index")}}">Ver todos </a></li>
                            @can("create",\App\Family::class)
                            <li><a href="{{route("family.create")}}">Crear nueva Familia</a></li>
                            @endcan
                        </ul>
                    </li>

                    <li><a><i class="fa fa-circle-thin"></i>Ciclos Formativos <span
                                    class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{route("cicle.index")}}">Ver todos </a></li>
                            @can("create",\App\Cicle::class)
                            <li><a href="{{route("cicle.create")}}">Crear nuevo Ciclo</a></li>
                            @endcan
                        </ul>
                    </li>
            </ul>
        </div>
        @endif
    @endif
</div>