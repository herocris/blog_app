@extends('admin.layout')
@section('header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Nueva Publicación</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Publicación</a></li>
                    <!-- <li class="breadcrumb-item active">Nueva</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <div style="display:none" role="alert" id="alertamsj">hola mundo</div>
</div>
@stop
@section('content')
<form action="{{ route('admin.posts.update', $post) }}" method="POST" id="enviar">
    {{ csrf_field() }} {{ method_field('PUT')}}
    <div class="row">
        <div class="col-md-8">
            <!-- /.card -->
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Titulo de la publicación: </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title',$post->title)  }}"
                            placeholder="Ingrese el titulo de la publicacion (minimo 10 palabras)" />
                        @error('title')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Contenido de la publicación: </label>
                        <textarea name="body" rows="10" id="summernote"
                            class="form-control @error('body') is-invalid @enderror"
                            placeholder="Ingrese el cuerpo de la publicación">{{ old('body', $post->body) }}</textarea>
                        @error('body')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div> <!-- /.card-body -->
            </div><!-- /.card -->
        </div>
        <div class="col-md-4">
            <!-- /.card -->
            <div class="card">
                <div class="card-body">
                    <!-- /.card-body -->
                    <div class="form-group">
                        <label>Fecha de publicación: </label>
                        <!-- <div class="input-group date">
                            <input class="form-control" id="reservationdate" type="text"
                                value="{{ old('published_at', optional($post->published_at)->format('d-M-Y')) }}">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                        </div> -->


                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="published_at"
                                class="form-control datetimepicker-input @error('published_at') is-invalid @enderror"
                                value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}"
                                data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>


                        @error('published_at')
                        <div class="alert-danger">{{ 'El campo fecha es obligatorio' }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Resumen de publicación: </label>
                        <textarea name="excerpt" rows="5" id="summernote"
                            class="form-control @error('excerpt') is-invalid @enderror"
                            placeholder="Ingrese un resumen de la noticia (minimo 15 palabras)">{{ old('excerpt',$post->excerpt) }}</textarea>
                        @error('excerpt')
                        <div class="alert-danger">{{ 'El campo resumen es obligatorio' }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoria: </label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                            <!--agregar la linea 95 en la version que esta en produccion -->
                            <option value="" {{ old('category_id') == null ? 'selected' : '' }} disabled hidden>Selecciona la categoria</option>
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id) == $category->id ? ' selected ' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert-danger">{{ 'El campo categoria es obligatorio' }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Etiquetas:</label>
                        <select name="tags[]" class="select2 @error('tags') is-invalid @enderror" multiple="multiple"
                            data-placeholder="Selecciona una o más etiquetas" style="width: 100%;">
                            @foreach ($tags as $tag)
                            <option
                                {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
                                value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="alert-danger">{{ 'El campo etiqueta es obligatorio' }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Imagen:</label>
                        <div style="display:none;" role="alert" id="alerta"></div>
                        <div class="dropzone" id=""></div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
                        <button type="button" style="display: none;" id="remover" class="btn btn-danger">Remover
                            Imagen</button>
                    </div>
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</form>
@if($post->photos->count())
<div class="row">
    @foreach ($post->photos as $photo )
    <div class="col-md-2">
        <form method="POST" action="{{ route('admin.photos.destroy',$photo)}}">
            {{ method_field('DELETE')}}{{ csrf_field() }}
            <button class="btn btn-xs btn-danger" style="position: absolute"><i class="far fa-trash-alt"></i></button>
            <img class="img-thumbnail" src="/storage/{{$photo->url?$photo->url:''}}" />
        </form>
    </div>
    @endforeach
</div>
@endif
@stop

@push('styles')
<!-- Drop Zone para subir imagenes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="/bootstrap-datepicker-master/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.css">
<!-- <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
<!-- summernote -->
<link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('scripts')
<!-- Drop Zone para subir imagenes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<!-- moments Bootstrap 4 -->
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<!-- cdnjs para cambiar idioma del datetimepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<script src="/bootstrap-datepicker-master/bootstrap-datepicker-master/js/bootstrap-datepicker.js"></script>
<script src="/bootstrap-datepicker-master/bootstrap-datepicker-master/js/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script>
<!-- Summernote -->
<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
//Date range picker
var fasd = new Date();

$('#reservationdate').datepicker({
    language: 'es',
    // locale: 'es', 
     format: "yyyy-m-d",
     autoclose: true,
     todayBtn: true,
    todayHighlight: true,
    // forceParse: false,
    startDate: 0,
    defaultViewDate: "today"

});
</script>

<script>
$('#summernote').summernote({
    height: 400,
    toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
    ]
});
</script>

<script>
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
</script>

<script>
var myDropzone = new Dropzone('.dropzone', {
    url: '/admin/posts/{{ $post->id }}/photos',
    paramName: 'photo',
    acceptedFiles: "image/jpg, image/jpeg",
    maxFilesize: 2,
    maxFiles: 1,
    autoProcessQueue: false,
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token()}}'
    },
    dictDefaultMessage: 'Click para agregar imagen'
});

myDropzone.on("addedfile", function(file) {
    if (file.type == "image/jpg") {
        alerta("Formato de imagen admitido.");
        $("#alerta").removeClass("alert alert-danger");
        $("#alerta").addClass("alert alert-success");
        $("#remover").show();
        $("#alertamsj").hide();
        if (this.files.length > 1) {
            alert("Hay mas de un archivo");
            this.removeFile(this.files[1]);
        }
    } else if (file.type == "image/jpeg") {
        $("#alerta").removeClass("alert alert-danger");
        $("#alerta").addClass("alert alert-success");
        alerta("Formato de imagen admitido.");
        $("#remover").show();
        $("#alertamsj").hide();
        if (this.files.length > 1) {
            alert("Hay mas de un archivo");
            this.removeFile(this.files[1]);
        }
    } else {
        myDropzone.removeFile(file);
        $("#alerta").removeClass("alert alert-success");
        $("#alerta").addClass("alert alert-danger");
        alerta("Formato de imagen no admitido.");
        $("#remover").hide();
    }

});

$("#remover").click(function() {
    var funciona = "<?php echo json_encode($post->id); ?>";
    //var token = {{csrf_token()}};
    myDropzone.removeAllFiles(true);

    // $.ajax({
    //     url: "{{ route('admin.photos.delete',$post->id)}}",
    //     type: 'GET',
    //     dataType: 'json'
    // }).done(function(res) {
    //     $("#alertamsj").show();
    //     $("#alertamsj").addClass("alert alert-success");
    //     $("#alertamsj").html("Fotografia eliminada.");
    //     $("#remover").hide();
    //     //alert(res);
    // }).fail(function(res) {
    //     alert(res + "no se guardo");
    // });
});

function alerta(mensage) {
    $("#alerta").html(mensage);
    $("#alerta").slideDown(500);
    $("#alerta").fadeTo(2000, 500).slideUp(500, function() {
        $(this).slideUp(500);
    });
}

$('#alerta').hide();
Dropzone.autoDiscover = false;

$( "#guardar" ).click(function() {
    myDropzone.processQueue();
  $( "#enviar" ).submit();
  
});
</script>

@endpush