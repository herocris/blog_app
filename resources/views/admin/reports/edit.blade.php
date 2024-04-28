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
                    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Informes</a></li>
                    <!-- <li class="breadcrumb-item active">crear</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@stop

@section('content')
<form method="POST" action="{{ route('admin.reports.update', $report) }}" enctype="multipart/form-data">
    {{ csrf_field() }} {{ method_field('PUT')}}
    <input id="id" name="id" type="hidden" value="{{ old('id',$report->id)  }}">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title">Datos de Informe</h3>
                </div>
                <div class="card-body">
                    @include('admin.partials.error-messages')
                    <div class="form-group">
                        <label>Titulo: </label>
                        <input type="text" name="title" value="{{ old('title',$report->title)  }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descripcion: </label>
                        <input type="text" name="description" value="{{ old('description',$report->description)}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Adjunto: </label>
                        <input type="file" id="attached" accept=".pdf" name="attached"
                            value="" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Modificar Informe</button>
        </div>
        <div class="col-md-6">
            <embed id="vistaPrevia" src="/storage/{{$report->attached}}" type="application/pdf" width="600" height="600">
        </div>
    </div>
</form>
<script>
document.querySelector('#attached').addEventListener('change', () => {
    let pdffFile = document.querySelector('#attached').files[0];
    let pdffFileURL = URL.createObjectURL(pdffFile);
    document.querySelector('#vistaPrevia').setAttribute('src', pdffFileURL);
})
</script>

@endsection