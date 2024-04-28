<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Site Metas -->
<title>OHSD</title>
<meta name="keywords" content="observatorio, hondureño, drogas, ohsd, honduras, dnii">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link href="/front/css/bootstrap.css" rel="stylesheet">
<link href="/front/css/bootstrap.min.css.map" rel="stylesheet">
<!-- FontAwesome Icons core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/front/style.css" rel="stylesheet">
<link href="/front/style_img.css" rel="stylesheet">
<!-- Responsive styles for this template -->
<link href="/front/css/responsive.css" rel="stylesheet">
<!-- Colors for this template -->
<link href="/front/css/colors.css" rel="stylesheet">
<!-- Version Tech CSS for this template -->
<link href="/front/css/tech.css" rel="stylesheet">
<style>
.h2color {
    background-color: white;
}
</style>
</head>

<body>
    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                @include('partials.nav')
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->

        <section class="section first-section">
            <div class="container-fluid">
            </div>
        </section>
        {{-- <section class="section img2"> --}}
        <section class="section">
            <div class="container">

                <div class="row">

                    @yield('content')
                    @include('partials.lateralderecha')

                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        <div class="footer">
            <center>
                <p>Copyright &copy; 2023 - <a href="#">Observatorio Hondureño Sobre Drogas</a><br>Todos los derechos
                    reservados<br>Departamento Desarrollo de Software</p>
            </center>
        </div>
    </div><!-- end wrapper -->
    
    <!-- Core JavaScript
    ================================================== -->
    <script src="/front/js/jquery.min.js"></script>
    <script src="/front/js/tether.min.js"></script>
    <script src="/front/js/bootstrap.min.js"></script>
    <script src="/front/js/custom.js"></script>
</body>

</html>
<!-- <div id="sfc5p6tu7bswl5xl81pgdzag8dt4bkmb7j4">
<script type="text/javascript" src="https://counter6.stat.ovh/private/counter.js?c=5p6tu7bswl5xl81pgdzag8dt4bkmb7j4&down=async" async></script>
<noscript>
    <a href="http://sodhdemo.pignusv.dnii/" title="contadores de visitas">
        <p style="color: #000000">Visitas al sitio web</p>
        <img src="https://counter6.stat.ovh/private/contadorvisitasgratis.php?c=5p6tu7bswl5xl81pgdzag8dt4bkmb7j4" border="0" title="contadores de visitas" alt="contadores de visitas">
    </a>
</noscript>
</div> -->
@stack('scripts')
<script src="/front/js/jquery.min.js"></script>
