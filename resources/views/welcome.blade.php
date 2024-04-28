@extends('layout')
<!-- BEGIN content -->
@section('content')
<!-- <style>
    .img2 {
    background-color: #f8f8f8;
    background: url(front/images/fondo_prospice.png);
    background-repeat: no-repeat;
    background-attachment: fixed;
}
    </style> -->
<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
    <div class="page-wrapper">
        <div class="blog-top clearfix">
            <h2 class="pull-left">
                @switch ($cat)
                    @case('Reducción de la Oferta')
                    <h2>Reducción de la Oferta de Drogas</h2>
                    <p style="text-align:justify">Es la unidad encargada de fortalecer el intercambio de 
                    información y facilitar las coordinaciones entre los operadores de justicia que 
                    contrarrestan el tráfico ilícito de drogas.
                    </p>
                    <strong><ul>Líneas de acción</ul></strong>
                    <li style="text-align:justify">
                    Fortalecer las capacidades institucionales para el estudio del fenómeno del tráfico
                    ilícito de drogas en Honduras.
                    <br>
                    <li style="text-align:justify">
                    Recolectar información efectiva, actualizada y no duplicada a fin de elaborar informes
                    periódicos y anuales en el tema de drogas, contribuyendo a mejorar los procedimientos
                    y la toma de decisiones.
                    <br> 
                    <li style="text-align:justify">
                    Estandarizar los procedimientos institucionales.
                    <br>
                    <li style="text-align:justify">
                    Fortalecer las relaciones internacionales con los entes encargados de coordinar las 
                    acciones en el combate al tráfico ilícito de drogas.
                    <br>
                    <li style="text-align:justify">
                    Proporcionar a la comunidad nacional e internacional información relacionada con 
                    el tráfico ilícito de drogas en Honduras.
                    <br>
                    @break

                    @case('Reducción de la Demanda')
                    <h2>Reducción de la Demanda</h2>
                    <p style="text-align:justify">Es la unidad encargada de contribuir al mejoramiento de
                    la calidad de los servicios prestados en prevención, tratamiento y rehabilitación de 
                    consumo de drogas a nivel nacional.
                    </p>
                    <strong><ul>Líneas de acción</ul></strong>
                    <li style="text-align:justify">
                    Brindar una panorámica nacional sobre la situación de drogas en el área de reducción
                    de la demanda, para mejorar la comprensión del fenómeno y facilitar la toma de 
                    decisiones a las autoridades correspondientes.
                    <br>
                    <li style="text-align:justify">
                    Contar con datos nacionales actualizados sobre la Prevalencia de Consumo de Drogas 
                    a fin de conocer el comportamiento de uso de sustancias psicoactivas y tomar las 
                    decisiones más acertadas en el área de reducción de la demanda; sirviendo además como 
                    insumo para las autoridades de reducción de la oferta.
                    <br>
                    <li style="text-align:justify">
                    Medir la calidad de la atención ofrecida por los centros de tratamiento de 
                    drogodependencias, y así implementar una cultura de calidad que facilite la
                    instalación de un sistema nacional de acreditación y certificación de calidad.
                    <br>
                    <li style="text-align:justify">
                    Fortalecer la red nacional de información sobre drogas, en el área de tratamiento.
                    <br>
                    <li style="text-align:justify">
                    Realizar campaña de concientización a la población hondureña sobre el problema
                    de consumo de drogas y el peligro que representa para la sociedad.
                    <br>
                    @break

                    @case('Precursores Químicos')
                    <h2>Precursores Químicos</h2>
                    <p style="text-align:justify">Es la unidad encargada de elaborar las políticas públicas 
                    que favorezcan y faciliten la toma de decisiones a los operadores de justicia en el 
                    combate contra el desvío de precursores químicos frecuentemente utilizados para la 
                    fabricación ilícita de drogas.
                    </p>
                    <strong><ul>Líneas de acción</ul></strong>
                    <li style="text-align:justify">
                    Establecer un protocolo de destrucción, eliminación y neutralización de
                    sustancias, precursores químicos y drogas.
                    <br>
                    <li style="text-align:justify">
                    Definir las rutas de desvíos de precursores o de fabricación ilícita, mediante 
                    la ejecución de operativos o visitas de control disuasivas y preventivas.
                    <br>
                    <li style="text-align:justify">
                    Mejorar la capacidad técnica del personal administrativo y operativo, para 
                    fortalecer la eficiencia y la eficacia en sus actividades.
                    <br>
                    <li style="text-align:justify">
                    Establecer y mantener un panorama actualizado en materia de precursores químicos,
                    para la implementación de nuevas estrategias o el fortalecimiento de las ya existentes.
                    <br>
                    @break

                    @default
                @endswitch
        </div><!-- end blog-top -->
    </div>
    <div class="page-wrapper">
        <div class="blog-top clearfix">
            <h2 class="pull-left">
                @if (isset($title))
                {{ $title }}
                @else
                    @if (!$posts->isEmpty())
                    Últimas noticias
                    @else
                    Upps, no hay noticias
                    @endif
                @endif
                
                <!-- CAJA DEL BUSCADOR -->
                <input class="form-control" type="text" id="buscador" placeholder="Buscar" value="">

        </div><!-- end blog-top -->
        <div class="blog-list clearfix" id="tata">
             {{-- @foreach ($posts as $post)
            <div class="blog-box row">
                <div class="col-md-4">
                    <div class="post-media">
                        <a href="{{ route('posts.show',$post->id)}}" title="imagen">
                            @if (!$post->photos->isEmpty())
                            <img src="/storage/{{ $post->photos->first()?$post->photos->first()->url:''}}" alt=""
                                class="img-fluid">
                            @else
                            <img src="/img/defaultNew.jpg" alt="" class="img-fluid">
                            @endif
                            <div class="hovereffect"></div>
                        </a>
                    </div><!-- end media -->
                </div><!-- end col -->
                <div class="blog-meta big-meta col-md-8">
                <a href=" {{ route('posts.show',$post->id)}}" title="" style="font-size: 25px;"><b>{{ $post->title}}</b></a>
                    <p style="text-align:justify">{{ $post->excerpt}}...</p>
                    <small class="firstsmall"><a class="bg-orange" href="{{route('categories.show',$post->category)}}"
                        >{{$post->category->name}}</a></small>
                    <small>{{ $post->published_at->format('d-m-Y')}}</small>
                    <small>por : OHSD</small><br>
                    @foreach ($post->tags as $tag )
                    <small>#{{ $tag->name}}</a></small>
                    @endforeach
                </div><!-- end meta -->
            </div><!-- end blog-box -->
            <hr class="invis">
            @endforeach --}}
            
        </div><!-- end blog-list -->
        <div id='anim' style='width: 250px; display: block;margin-left: auto;margin-right: auto'></div>
    </div><!-- end page-wrapper -->
    <hr class="invis">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-start">
                    <li class="page-item">
                        {{-- {{$posts->appends(request()->all())->links()}} --}}
                        {{-- {!! $posts->render() !!} --}}
                        <a  id="anterior" > << Anterior</a> &nbsp &nbsp &nbsp &nbsp &nbsp
                        <a  id="siguiente" aria-readonly="true" href=""> Siguiente >></a>
                    </li>
                </ul>
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end col -->
@stop
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.11.0/lottie.min.js"></script>
<!-- ACA EMPIEZA EL NUEVO CODIGO DE POST -->
<script>
    function animar(){
            var animation = bodymovin.loadAnimation({
            container: document.getElementById('anim'),
            path: '/84785-not-found.json',
            render: 'svg',
            loop: true,
            autoplay: true,
            name: 'demo animation',
        });
    }
    
//Accion para animación de scroll al momento de realizar busqueda    
function scrollAnimated() {
    if ('{{$cat}}' == 'Reducción de la Demanda') {
        $("html, body").animate({ scrollTop: "600" });
    }else if('{{$cat}}' == 'Precursores Químicos' || '{{$cat}}' == 'Reducción de la Oferta'){
        $("html, body").animate({ scrollTop: "500" }); 
    } 
}

//Accion que se desencadena al presionar enter en la caja de busqueda
$('#buscador').keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
    getData(1, $('#buscador').val(),'{{$cat}}','{{$anio}}','{{$mes}}')
    scrollAnimated();
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
    getData(page, $('#buscador').val(),'{{$cat}}','{{$anio}}','{{$mes}}');
});


//Llamado inicial del Ajax para cargar la primera pagina de los registros
getData(1,$('#buscador').val(),'{{$cat}}','{{$anio}}','{{$mes}}')

//Declaracion de la funcion Ajax que trae los registros
function getData(page, buscado, categoria, anio, mes){
    $.ajax({
        url: "/indexposts"+"?page=" + page, //Ruta de la accion que trae los registros
        data:{ //Parametros de busqueda 
            buscar : buscado,
            catego : categoria,
            anio : anio,
            mes :mes
        },
        type:'get',
        success: function( response ) { //Respuesta de la busqueda
            console.log(response.respuesta)
           
            $("#tata").empty(); //Limpiando el contenedor que contiene los registros iniciales

            if(response.respuesta.data.length != 0){
                $("#siguiente").attr('href', response.respuesta.next_page_url) //Agregando hipervinculo al elemento siguiente
                $("#anterior").attr('href', response.respuesta.prev_page_url) //Agregando hipervinculo al elemento anterior

                response.respuesta.data.forEach(function(item){ //Iteracion de la lista de registros obtenidos de la base de datos
                    var fecha = formatoFecha((new Date(item.published_at)), 'dd-mm-yy'); //Formateo de fecha que viene de la base de datos

                    var foto=""
                    var urlfoto= "/storage/"+item.photos[0].url; //Obtencion de la URL de la foto
                    if (item.photos[0]!="null") { //Determina si la foto viene nula
                        foto= "<img src= "+urlfoto+" alt='' class='img-fluid'>" //Asignacion de URL en caso de no venir nulo
                    } else {
                        foto= "<img src='/img/defaultNew.jpg' alt='' class='img-fluid'>" //Asignacion de foto por defecto en caso de venir nulo(Post no tenga foto)
                    }

                    // Construccion de la ruta del post por medio de funcion replace de JavaScript
                    var rutapost ="{{ route('posts.show', ['id'=>'idpost'])}}" 
                        rutapost=rutapost.replace('idpost', item.id)

                    // Construccion de la ruta de la categoria por medio de funcion replace de JavaScript
                    var rutacat ="{{ route('categories.show', ['category'=>'nomcat'])}}" //Declaracion inicial de la cadena de texto que tiene la ruta
                    var nombrecategoria = item.category.name.replace(/ /g,'%20') //Sustitucion de los espacios por %20 en el nombre de la categoria
                        rutacat=rutacat.replace('nomcat', nombrecategoria) //Agregando nombre de la categoria a la ruta por medio de la funcion replace de JavaScript

                    
                    var tags = ""; 
                    //Iteracion del objeto Tags para obtener los nombres de los tags
                    (item.tags).forEach(function(item, idx, array){
                        if (idx === array.length - 1){
                            tags = tags + "#" + item.name;
                        }else{
                            tags = tags + "#" + item.name + " / ";
                        }
                    })
                    
                    // Agregando codigo HTML al elemento contenedor de los Posts via JavaScript
                    $("#tata").append(
                        
                        "<div class='blog-box row'>"
                            +"<div class='col-md-4'>"
                                +"<div class='post-media'>"
                                    +"<a href='"+rutapost+"' title='imagen'>"
                                    +foto
                                    +"<div class='hovereffect'></div>"
                                +"</div>"
                            +"</div>"
                            +"<div class='blog-meta big-meta col-md-8'>"
                                +"<a href='"+rutapost+"' title='' style='font-size: 25px;'><b>"+item.title+"</b></a>"
                                +"<p style='text-align:justify'>"+item.excerpt+"...</p>"
                                +"<small class='firstsmall'><a class='bg-orange' href="+rutacat+">"+item.category.name+"</a></small>"
                                +"<small>"+fecha+"</small>"
                                +"<small>por : OHSD</small><br>"
                                +"<small>"+tags+"</small>"
                            +"</div>"
                        +"</div>"
                        +"<hr class='invis'>"
                    );
                });
            }else{
                $("#tata").append(
                    "<p style='text-align:center'>No se han encontrado resultados para tu búsqueda (<b>"+$('#buscador').val()+"</b>).</p>"  
                );
                animar()
            }
        }
    });
}
</script>
@endpush