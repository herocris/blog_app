@extends('admin.layout')
@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Listado de Etiquetas</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ Route('dashboard')}}">Inicio</a></li>
                    <!-- <li class="breadcrumb-item active">roles</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@stop
@section('content')
<div class="row">
    
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Datos de la Etiqueta</h3>
            </div>
            <div class="card-body">
                @include('admin.partials.error-messages')
                <form method="POST" action="{{ route('admin.tags.store') }}">
                {{ csrf_field() }}
                    <label>Titulo: </label>
                    <input type="text" name="name" value="" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">Guardar Etiqueta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop