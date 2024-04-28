@extends('admin.layout')
@section('header')
{{--<h1>
    Usuarios
    <small>Listado</small>
</h1>--}}
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Lista de Usuarios </h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ Route('dashboard')}}">Inicio</a></li>
            <!-- <li class="breadcrumb-item active">Usuario</li> -->
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@stop
@section('content')
<div class="row">
    <div class="col-12">
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">...</h3> -->
          <a href="{{route('admin.users.create')}}" class="btn btn-primary float-right">Agregar Usuario</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="posts-table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Permisos</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->getRoleNames()->implode(', ')}}</td>
                <td>
                    @foreach ( $user->permissions as $permisso )
                    {{$permisso->name}}
                    @endforeach
                </td>

                <td><a href="{{ route('admin.users.show', $user)}}" class="btn btn-sm btn-info" data-bs-toogle="tooltip" data-bs-placement="top" title=" Ver Usuario ">
                <i class="far fa-eye"></i></a>
                    <a href="{{ route('admin.users.edit', $user)}}" class="btn btn-sm btn-warning" data-bs-toogle="tooltip" data-bs-placement="top" title=" Editar Usuario ">
                    <i class="far fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.users.disable',$user)}}" style="display: inline">
                        {{ csrf_field() }} {{-- method_field('PUT') --}}
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estas seguro de eliminar este Usuario?')" data-bs-toogle="tooltip" data-bs-placement="top" title=" Eliminar Usuario ">
                        <i class="fas fa-trash"></i></button>
                    </form>
                </td>
              </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  <!-- /.row -->
</div>
@stop

@push('styles')
  <!-- datatables css -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@push('scripts')
  <!--   JS Datables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!--   JS Datables -->
@endpush
