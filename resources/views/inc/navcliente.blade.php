<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inversiones</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Hero-Clean-Reverse.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Navbar-Right-Links.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="whats.css">
    <meta name="google-site-verification" content="ktCtQN1LJvkrBt7A8H7NM8F9LfPw31qwnFgWYw1o1CA" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7CZ34PQLK2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-7CZ34PQLK2');
    </script>
</head>

<nav class="navbar navbar-expand-lg navbar-light" style="background: rgb(16,41,64);">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="{{ asset('img/Recurso%20104siibal-.png') }}" style="width: 190px; height: 50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="color: rgb(255,255,255);">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/registro/lobby" style="color: rgba(255,255,255,0.9);font-size: 30px;">Inversión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/registro/datoscliente" style="color: rgba(255,255,255,0.9);font-size: 30px;">Datos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}" style="color: rgba(255,255,255,0.9);font-size: 30px;">Cerrar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: rgba(255,255,255,0.9);font-size: 20px;"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: rgba(255,255,255,0.9);font-size: 20px;"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: rgba(255,255,255,0.9);font-size: 30px;">
                        @if(Auth::check())
                            <?php
                                // Obtener el nombre y apellido completo
                                $nombreCompleto = Auth::user()->name;
                                $apellidoCompleto = Auth::user()->datosUsuario ? Auth::user()->datosUsuario->lastName : '';

                                // Obtener la primera palabra de cada uno
                                $primerNombre = explode(' ', $nombreCompleto)[0];
                                $primerApellido = explode(' ', $apellidoCompleto)[0];
                            ?>
                            {{ $primerNombre }} {{ $primerApellido }}
                        @else
                            Invitado
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>