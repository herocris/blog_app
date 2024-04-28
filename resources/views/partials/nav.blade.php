<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/"><img src="/front/images/Logo.png" height="50" width="300"
    margin="-50px"></a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">INICIO</a>
            </li>

            <!--<li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
            </li> -->

            <li class="nav-item dropdown has-submenu">
                <a class="nav-link dropdown-fa-toggle-down" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CATEGORÍAS
                </a>
                @if(isset($categories))
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($categories as $category)
                    <li><a class="dropdown-item" href="{{ route('categories.show',$category)}}">{{$category->name}}</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pages.reports')}}">INFORMES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.show', $category)}}">{{$category->name}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pages.contact')}}">¿QUIENES SOMOS?</a>
            </li>
           
        </ul>
        <ul class="navbar-nav mr-2">
            <li class="nav-item">
                <!--<a class="nav-link" href="{{ route('login')}}"><i class="fas fa-user-lock"></i>
                    <font color="white" size="3px"> Login </font>
                </a> -->
                <!--<a ><i class="fas fa-user-lock"></i>
                    <font color="white" size="3px"> Buscar: </font>
                </a> -->


            </li>
        </ul>
    </div>
</nav>