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
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                        <!-- <li class="breadcrumb-item active">crear</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content')
<form method="POST" action="{{ route('admin.roles.store') }}">
    @include('admin.roles.form')
      <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6"> <button type="submit" class="btn btn-primary btn-block">Guardar Rol</button></div>
      </div>
</form>
@endsection
