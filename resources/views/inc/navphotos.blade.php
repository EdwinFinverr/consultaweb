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

<nav class="navbar navbar-light navbar-expand-md py-3" style="background: rgb(16,41,64);">

    <div class="container">


        <a class="navbar-brand d-flex align-items-center" href="asesor"><img
                src="{{ asset('img/Recurso%20104siibal-.png') }}" style="width: 190px;height: 50px;"></a>

        <span style="color: rgb(255,255,255);font-size: 25px;font-weight: bold;">(Asesor)</span><button
            data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span
                class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navcol-2" style="color: rgb(255,255,255);">
            </ul>
            <ul class="navbar-nav ms-auto">

                <li class="nav-item" href="altaclientease">
                    <a class="nav-link active" href="altaclientease"
                        style="color: rgba(255,255,255,0.9);font-size: 30px;">Registrar Cliente
                    </a>
                </li>
                <li class="nav-item" href="">
                <li class="nav-item" href="{{ url('informacioncliente') }}">
                    <a class="nav-link active" href="{{ url('informacioncliente') }}"
                        style="color: rgba(255,255,255,0.9);font-size: 30px;margin-left: 10px; ">Información
                        Cliente</a>
                </li>
                </li>
                <li class="nav-item">
                <li class="nav-item" href="{{ url('logout') }}">
                    <a class="nav-link active" href="{{ url('logout') }}"
                        style="color: rgba(255,255,255,0.9);font-size: 30px;  margin-left: 10px;">Cerrar Sesión</a>
                </li>
                </li>


            </ul>

        </div>
    </div>
</nav>
