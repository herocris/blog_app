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
                        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permisos</a></li>
                        <!-- <li class="breadcrumb-item active">Permisos</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content')
<form method="POST" action="{{ route('admin.permissions.update',$permission) }}">
    {{ method_field('PUT')}} {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">Datos de Permiso</h3>
                </div>
                <div class="card-body">
                    @include('admin.partials.error-messages')
                    <div class="form-group">
                        <label>Identificador: </label>
                        @if($permission->exists)
                        <input type="text" value="{{ $permission->name }}" class="form-control" disabled>
                        @else
                        <input type="text" name="name" value="{{ old('name',$permission->name) }}" class="form-control">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Titulo: </label>
                        <input type="text" name="display_name" value="{{ old('display_name',$permission->display_name) }}" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Actualizar permiso</button>
        </div>
    </div>
</form>
@endsection
