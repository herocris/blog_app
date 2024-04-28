<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ Route('dashboard') }}" class="nav-link {{ request()->is('admin') ? ' active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Inicio
                    <!--<span class="right badge badge-danger">New</span>-->
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('admin/posts') ? ' active' : '' }}">
                <i class="nav-icon far fa-newspaper"></i>
                <p>Publicaciones<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link">
                        <i class="far fa-eye"></i>
                        <p>Mostrar todas</p>
                    </a>
                </li>
                @role('Writer')
                <li class="nav-item">
                    @if (request()->is('admin/posts/*'))
                        <a href="{{ route('admin.posts.index') }}" class="nav-link">
                        @else
                            <!-- <a href="#" data-toggle="modal" data-target="#editpost" class="nav-link"> -->
                                <!--agregar linea 33 a version de produccion -->
                            <a href="{{ route('admin.index_modal',1) }}" class="nav-link">
                    @endif
                    <i class="far fa-file"></i>
                    <p>Crear Publicación</p>
                    </a>
                </li>
                @endrole
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link {{  request()->is('admin/reports') ? ' active' : '' }}">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>Informes<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link">
                        <i class="far fa-eye"></i>
                        <p>Mostrar todos</p>
                    </a>
                </li>
                @role('Writer')
                <li class="nav-item">
                    <a href="{{ route('admin.reports.create') }}" class="nav-link">
                        <i class="far fa-file"></i>
                        <p>Crear Informe</p>
                    </a>
                </li>
                @endrole
            </ul>
        </li>
        @role('Admin')
        <li class="nav-item">
            <a href="#" class="nav-link {{request()->is('admin/users') ? ' active' : '' }}">
                <i class="nav-icon fas fa-user-friends "></i>
                <p>Gestion de Usuarios<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="far fa-eye nav-icon"></i>
                        <p>Ver Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.users.create')}}" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <p>Crear Usuario</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{--menu-open--}}">
            <a href="#" class="nav-link {{request()->is('admin/roles') ? ' active' : '' }}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    Roles y Permisos
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link"> <!--faltaba la ruta -->
                        <i class="fas fa-user-cog nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                        <i class="fas fa-user-check nav-icon"></i>
                        <p>Permisos</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link {{request()->is('admin/users') ? ' active' : '' }}">
                <i class="nav-icon fas fa-user-friends "></i>
                <p>Etiquetas<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.tags.index')}}" class="nav-link">
                        <i class="far fa-eye nav-icon"></i>
                        <p>Ver Etiquetas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tags.create')}}" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <p>Crear Etiqueta</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.binnacle')}}" class="nav-link class= nav-link {{ request()->is('admin/binaccle') ? ' active' : '' }}">
                <i class="nav-icon  fas fa-book"></i>
                <p>
                    Bitacora
                    <!--<span class="right badge badge-danger">New</span>-->
                </p>
            </a>
        </li>
        @endrole
        <li class="nav-item">
            <a href="/storage/Manual de usuario.pdf" class="nav-link class= nav-link" target="_blank">
                <i class="nav-icon  far fa-file-pdf"></i>
                <p>
                    Manual de Usuario
                </p>
            </a>
        </li>
    </ul>
</nav>
