@extends('layout.app')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show my-3">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <span class="text-uppercase"> {{ $error }} </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>inversiones</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/Contact-form-simple.css">
        <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
        <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body body style="background: url(&quot;img/fondologin.png&quot;) top / cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <section class="position-relative py-4 py-xl-5">
                        <div class="container">
                            <div class="row mb-5">
                                <div class="col">
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                </div>
                            </div><img class="img-fluid" src="{{ asset('img/Recurso%2040siibal-.png') }}" style="width: 400px;">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                    <form class="text-center" method="post" style="text-align: left;" action="">
                                        @csrf
                                        <div class="mb-3">
                                        
                                            <input
                                                class="form-control" type="email" name="email"
                                                placeholder="Correo electrónico"
                                                style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                        </div>
                                        <div class="mb-3"><input
                                                class="form-control" type="password" name="password" ID="txtPassword"
                                                placeholder="Contraseña"
                                                style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                            <div class="input-group-append">
                                                <button class="btn btn" type="button" onclick="mostrarPassword()"
                                                    style="right: -540px; top: -39px;">
                                                    <span class="fa fa-eye-slash icon"></span>
                                                </button>
                                            </div>
                                            <script type="text/javascript">
                                                function mostrarPassword() {
                                                    var cambio = document.getElementById("txtPassword");
                                                    if (cambio.type == "password") {
                                                        cambio.type = "text";
                                                        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                                                    } else {
                                                        cambio.type = "password";
                                                        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                                                    }
                                                }

                                                $(document).ready(function() {
                                                    //CheckBox mostrar contraseña
                                                    $('#ShowPassword').click(function() {
                                                        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                                                    });
                                                });
                                            </script>
                                        </div>
                                        @error('message')
                                            <p
                                                class="border border-red-500 rounded-md bg-red-100 w-full
                                                 text-red-600 p-2 my-2">
                                                * {{ $message }}
                                            </p>
                                        @enderror
                                        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit"
                                                style="background: url(&quot;img/Recurso%2043siibal-.png&quot;) left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;"></button>
                                        </div>
                                        <div class="mb-3">
                                            <div style=" float: left;">
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="formCheck-1"><label class="form-check-label" for="formCheck-1"
                                                        style="color: rgb(255,255,255);font-size: 25px;">Recuérdame</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}"
                                                style="color: white;font-size:20px">
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6">
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div><img class="img-fluid" src="{{ asset('img/Recurso%20239siibal-.png') }}" style="width: 500px;"
                        alt="500px">
                </div>
            </div>
        </div>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>
   
@endsection('content')
