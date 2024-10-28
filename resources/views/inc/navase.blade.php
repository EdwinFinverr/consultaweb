<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>inversiones</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Hero-Clean-Reverse.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Navbar-Right-Links.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <meta name="google-site-verification" content="ktCtQN1LJvkrBt7A8H7NM8F9LfPw31qwnFgWYw1o1CA" />
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
        <a class="navbar-brand" href="/registro/administrador">
            <img src="{{ asset('img/Recurso%20104siibal-.png') }}" alt="Logo" style="width: 190px; height: 50px;">
        </a>
        <span style="color: white; font-size: 25px; font-weight: bold;">(Admin)</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon custom-icon" ></span>
</button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/registro/asesoralta"  style="color: rgba(255,255,255,0.9);font-size: 30px;">Asesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/registro/clienteadmin"  style="color: rgba(255,255,255,0.9);font-size: 30px;">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}"  style="color: rgba(255,255,255,0.9);font-size: 30px;">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

