@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Datos de usuario</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">
                        {{ $error }}
                    </li>
                    @endforeach

                </ul>
                @endif
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    {{ csrf_field() }}{{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Nombre: </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo: </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Clave: </label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Ingrese la nueva contraseña">
                        <span class="text-info">Ingrese contraseña solamente si desea cambiarla</span>
                    </div>
                    <div class="form-group">
                        <label>Confirme Clave: </label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Repita la contraseña">

                    </div>

                    <button class="btn btn-primary btn-block">Actualizar Informacion</button>
                </form>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Categorias</h3>
            </div>
            <div class="card-body">
                <!-- @role('Admin') -->
                <form method="POST" action="{{ route('admin.users.categories.update', $user) }}">
                   
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    @include('admin.users.checkboxes')
                    <button type="submit" class="btn btn-primary btn-block">Actualizar Categorias</button>
                </form>
                <!-- @else
                <ul class="list-group">
                    @forelse ($user->categories as $category)
                    <li class="list-group-item">{{ $category->name }}</li>
                    @empty
                    <li class="list-group-item">No Tiene Categorias</li>
                    @endforelse
                </ul>
                @endrole -->
            </div>
        </div>


    </div>
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                @role('Admin')
                <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    @include('admin.roles.checkboxes')
                    <button type="submit" class="btn btn-primary btn-block">Actualizar roles</button>
                </form>
                @else
                <ul class="list-group">
                    @forelse ($user->roles as $role)
                    <li class="list-group-item">{{ $role->name }}</li>
                    @empty
                    <li class="list-group-item">No Tiene Roles</li>
                    @endforelse
                </ul>
                @endrole

            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Permisos</h3>
            </div>
            <div class="card-body">
                @role('Admin')
                <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    @include('admin.permissions.checkboxes',['model' => $user])
                    <button type="submit" class="btn btn-primary btn-block">Actualizar permisos</button>
                </form>
                @else
                <ul class="list-group">
                    @forelse ($user->permissions as $permission)
                    <li class="list-group-item">{{ $permission->name }}</li>
                    @empty
                    <li class="list-group-item">No tiene Permisos</li>
                    @endforelse
                </ul>
                @endrole
            </div>
        </div>
    </div>
</div>
@endsection