@extends('admin.layout')
@section('header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Inicio</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ Route('dashboard')}}">Inicio</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@stop
@section('content')
<div class="row col-9">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="card card-primary card-outline">
        <canvas id="myChart" width="25px" height="25px"></canvas>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>
<!-- cdn de libreria de graficas Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
<!-- Script de la grafica -->
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var categorias ={!! json_encode($categorias)!!};
var cantidades ={!! json_encode($cantidades)!!};
console.log(categorias);
console.log(cantidades);
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: categorias,
        datasets: [{
            label: 'Publicaciones por categoría e Informes',
            data: cantidades,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: 
    {
        scales:
         {
            y: {
                beginAtZero: true
            }
        }, 
        legend: {
            display: false
        }
    }
});
</script>
@stop
