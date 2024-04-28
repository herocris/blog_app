<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        <div class="widget">
            <div class="banner-spot clearfix">
                <!--div class="banner-img">
                    <img src="/front/upload/banner_07.jpg" alt="" class="img-fluid">
                </div --><!-- end banner-img -->
            </div><!-- end banner -->
        </div><!-- end widget -->

        <div class="widget">
            <!-- <h2 class="widget-title">Videos</h2> -->
            <div class="trend-videos">
                <div class="blog-box">
                    <div class="post-media">
                        <a href="tech-single.html" title="">
                            <!-- <img src="/front/upload/tech_video_01.jpg" alt="" class="img-fluid"> -->
                            <div class="hovereffect">
                                <span class="videohover"></span>
                            </div><!-- end hover -->
                        </a>
                    </div><!-- end media -->
                    <div class="blog-meta">
                        <h4>Observatorio Hondureño Sobre Drogas</h4>
                        <p style="text-align:justify">
                        Es la unidad encargada de recopilar, analizar e interpretar la información
                        estadística mediante la aplicación de métodos científicos, para la elaboración
                        de informes y su respectiva divulgación.  
                        </p> 
                        <strong><ul>Líneas de acción</ul></strong> 
                        <li style="text-align:justify">
                        Analizar, interpretar y divulgar la información relacionada con el problema
                        nacional de las drogas para obtener una apreciación correcta del mismo.</li>
                        <br>
                        <li style="text-align:justify">
                        Recopilar y dar seguimiento a los datos para dar respuesta a requerimientos
                        nacionales e internacionales de información.</li>          
                    </div><!-- end meta -->
                </div><!-- end blog-box -->
            </div><!-- end videos -->
        </div><!-- end widget -->

        <div class="widget">
            <h2 class="widget-title h2color">Archivo</h2>
            <hr>
            <div class="blog-list-widget">
                <div class="list-group">
                    @if(isset($archive))
                    @foreach ($archive as $date )
                    <a href="{{ route('pages.home',['month'=>$date->month , 'year'=>$date->year]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <h5 class="mb-1 h2color">{{$date->monthname}}-{{$date->year}} ({{$date->posts}})</h5>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div><!-- end blog-list -->
        </div><!-- end widget -->
    </div><!-- end sidebar -->
</div><!-- end col -->
