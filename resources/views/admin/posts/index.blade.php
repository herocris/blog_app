@extends('admin.layout')
@section('header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Publicaciones registradas</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ Route('dashboard')}}">Inicio</a></li>

            <!-- <video width="100" height="100">
            <source src="http:\\127.0.0.1:8000\C:\xampp\htdocs\OHSD\public\front\images\AppdeMensajeriaNuntius.mp4" type="video/mp4">
            </video> -->
            <!-- <li class="breadcrumb-item active">Publicaciones</li> -->
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
          @role('Writer')
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#editpost">Crear publicación</button>
          @endrole
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="posts-table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Categoria</th>
              <th>Usuario</th>
              <th>Fecha</th>
              @if(auth()->user()->hasRole('Admin'))<!--Estado de las publicaciones -->
              <th>Estatus</th><!--Estado de las publicaciones -->
              @endif<!--Estado de las publicaciones -->
              <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <!--Modificar la linea 54 en la version de produccion -->
                <td>{{$post->category!=null?$post->category->name:""}}</td>
                <td>{{$post->autor->name}}</td>
                <td>{{$post->created_at}}</td>
                @if(auth()->user()->hasRole('Admin'))<!--Estado de las publicaciones-->
                <td>{{$post->visible == 1?'Activo': 'Inactivo'}}</td><!--Estado de las publicaciones -->
                @endif<!--Estado de las publicaciones -->
                <td><a href="{{ route('posts.show', $post)}}" class="btn btn-sm btn-info" target="_blank"><i class="far fa-eye"></i></a>
                    @role('Writer')
                    <a href="{{ route('admin.posts.edit', $post)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                    <form method="POST" action="{{route('admin.posts.disable', $post)}}" style="display: inline">
                        {{ csrf_field() }} {{-- method_field('PUT')--}}
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿ Estas seguro de eliminar esta publicacion?')"><i class="fas fa-trash"></i></button>
                    </form>
                    @endrole
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
<!-- Gregar linea 79 a version de produccion -->
@include('admin.posts.create')

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
<!--agregar de la linea 105 a 110 a version de produccion -->
<script>
  @if($id==1)
  $('#editpost').modal('show');

  @endif
</script>
<!--   JS Datables -->
@endpush
