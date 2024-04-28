@extends('layout')
  <!-- BEGIN content -->
  @section('content')
  <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
    <div class="page-wrapper">
        <div class="blog-top clearfix">
            <h2 class="pull-left h2color">
                @if (isset($title))
                {{ $title }}
                @else
                Acciones y logros en materia de drogas
                @endif
                <!--a href="#"><i class="fa fa-rss"></i></a --></h2>
        </div><!-- end blog-top -->

        <!-- CAJA DEL BUSCADOR -->
        <input class="form-control" type="text" id="buscador" placeholder="Buscar" value="">
        <br>
       

        <div class="blog-list clearfix" id="tata">
            
            {{-- @foreach ($reports as $report )
            <div class="blog-box row">
                <div class="col-md-4">
                    <div class="post-media">
                        <a href="/storage/{{$report->attached}}" title="Informe" target="_blank">
                            <!-- <img src="/img/pdfreport.png" alt="Portada informe" width="80" height="200" class="fluid">  -->
                            <!--src="/img/pdfreport.png" -->
                            <!-- Agregar esta linea de codigo 24 a la version en produccion -->
                            <img class="img-responsive" data-pdf-thumbnail-file="/storage/{{$report->attached}}">
                            <div class="hovereffect"></div>
                        </a>
                    </div><!-- end media -->
                </div><!-- end col -->
                <div class="blog-meta big-meta col-md-8">
                    <h4><a href="/storage/{{$report->attached}}" title="" target="_blank">{{$report->title}}</a></h4>
                        <p>{{$report->description}}</p>
                    <small><a class="bg-orange" href="" title="">{{$report->created_at->format('Y')}}</a></small>
                    <small>by OHSD</small><br>
                </div><!-- end meta -->
            </div><!-- end blog-box -->
            <hr class="invis">
            @endforeach --}}
        </div><!-- end blog-list -->
    </div><!-- end page-wrapper -->
    <hr class="invis">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-start">
                    <li class="page-item">
                        {{-- {{$posts->appends(request()->all())->links()}} --}}
                        {{-- {!! $posts->render() !!} --}}
                        <a  id="anterior"> << Anterior</a> &nbsp &nbsp &nbsp &nbsp &nbsp
                        <a  id="siguiente" aria-readonly="true" href=""> Siguiente >></a>
                    </li>
                </ul>
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end col -->
@stop
<!-- Agregar estos 2 cdn -->


@push('scripts')
<script src="/pdfThumbnails-master/pdfThumbnails.js" data-pdfjs-src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.js"></script>


<!-- ACA EMPIEZA EL NUEVO CODIGO DE INFORME -->
<script>

//Accion que se desencadena al persionar enter en la caja de busqueda
$('#buscador').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
    getData(1, $('#buscador').val())
    //alert("hola");
   
  }
});

//Funcion para dar formato a fecha
function formatoFecha(fecha, formato) {
    const map = {
        dd: fecha.getDate(),
        mm: fecha.getMonth() + 1,
        yy: fecha.getFullYear().toString(),
        yyyy: fecha.getFullYear()
    }
    return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched])
}


//Accion que se desencadena al presionar siguiente o anterior en la vista o paginas
 $("#anterior, #siguiente").on( "click", function(e) {
     e.preventDefault();
     var page=$(this).attr('href').split('page=')[1];
     getData(page, $('#buscador').val());
 });



getData(1,$('#buscador').val())

function getData(page, buscado){
    $.ajax({
        url: "/indexreports"+"?page=" + page, //Ruta de la accion que trae los registros
        data:{ //Parametros de busqueda
            buscar : buscado,
        },
        type:'get',
        success: function( response ) { //Respuesta de la busqueda
            console.log(response.respuesta)
           
            $("#tata").empty(); //Limpiando el contenedor que contiene los registros iniciales
            $("#siguiente").attr('href', response.respuesta.next_page_url) //Agregando hipervinculo al elemento siguiente
            $("#anterior").attr('href', response.respuesta.prev_page_url) //Agregando hipervinculo al elemento anterior

            response.respuesta.data.forEach(function(item){ //Iteracion de la lista de registros de la base de datos
                var fecha = formatoFecha((new Date(item.created_at)), 'yy'); //Formato de fecha que viene de la base de datos
                
                
                // Agregando codigo HTML al elemento contenedor de los Reports via JavaScript
                $("#tata").append(
                    
                    "<div class='blog-box row'>"
                       +"<div class='col-md-4'>"
                            +"<div class='post-media'>"
                                +"<a href='/storage/"+item.attached+"' title='Informe' target='_blank'>"
                                    
                                    +"<img class='img-responsive' data-pdf-thumbnail-file='/storage/"+item.attached+"'>"
                                    +"<div class='hovereffect'></div>"
                                +"</a>"
                            +"</div>"
                        +"</div>"
                        +"<div class='blog-meta big-meta col-md-8'>"
                            +"<h4><a href='/storage/"+item.attached+"' title='' target='_blank'>"+item.title+"</a></h4>"
                            +"<p>"+item.description+"</p>"
                            +"<small><a class='bg-orange' href='' title=''>"+fecha+"</a></small>"
                            +"<small>by OHSD</small><br>"
                        +"</div>"
                    +"</div>"
                    +"<hr class='invis'>"
                );
                createPDFThumbnails(); //NO TOCAR ESTA LINEA - DE MOVERLA O BORRAR NO FUNCIONA MINIATURA DE PDF DE INFORMES, :( PELIGRO, AUXILIO ME DESMAYO
            });
        }
    });
}
</script>
@endpush
