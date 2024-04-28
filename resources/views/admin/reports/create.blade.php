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

<form method="POST" id="form1" action="{{ route('admin.reports.store') }}" enctype="multipart/form-data">
    @csrf
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
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Descripcion: </label>
                        <input type="text" name="description" value="{{ old('description') }}" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Adjunto: </label>
                        <input type="file" id="attached" accept=".pdf" name="attached" value="{{ old('attached') }}"
                            class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Agregar Informe</button>
        </div>
        <div class="col-md-6">
            <!-- <iframe src = "" id="docpdf" width='400' height='300' allowfullscreen webkitallowfullscreen></iframe> -->
            <!-- <iframe src="" style="width:600px; height:500px;" id="docpdf" frameborder="0"></iframe> -->
            <embed id="vistaPrevia" type="application/pdf" width="600" height="600">
            <!-- <div id="viewPdf">

            </div> -->
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.6/pdfobject.min.js"></script>
<script>
// function llenar_pdf(filesa) {

// }

// var viewer = document.getElementById("viewPdf");
// PDFObject.embed('', viewer, {
//     height: "25rem"
// });

document.querySelector('#attached').addEventListener('change', () => {

    let pdffFile = document.querySelector('#attached').files[0];
    let pdffFileURL = URL.createObjectURL(pdffFile);

    document.querySelector('#vistaPrevia').setAttribute('src', pdffFileURL);
})
</script>



@endsection