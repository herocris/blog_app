@extends('admin.layout')
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                        <!-- <li class="breadcrumb-item active">crear</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content')
<form method="POST" action="{{ route('admin.users.store') }}" autocomplete="off">
    <div class="row">
            {{ csrf_field() }}
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header with-border">
                        <h3 class="card-title">Datos de usuario</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.error-messages')
                        <div class="form-group">
                            <label>Nombre: </label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Correo: </label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Clave: </label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese la nueva contraseña" autocomplete="off">
                            <span class="text-info"></span>
                        </div>
                        <div class="form-group">
                            <label>Confirme Clave: </label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Repita la contraseña">
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header with-border">
                        <h3 class="card-title">Categorias</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.users.checkboxes')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header with-border">
                        <h3 class="card-title">Roles</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.roles.checkboxes')
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header with-border">
                        <h3 class="card-title">Permisos</h3>
                    </div>
                    <div class="card-body">
                        @include('admin.permissions.checkboxes',['model' => $user])
                    </div>
                </div>
                <button class="btn btn-primary btn-block">Registrar usuario</button>
            </div>

    </div>
</form>
@endsection
