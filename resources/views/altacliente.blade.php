@extends('layout.apps')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

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

    <body>
        <div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <form class="form-signin" action="{{ url('postRegistrationCliente') }}" method="POST" id="regForm"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
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
                        <h2><img src="{{ asset('img/Recurso%20189siibal-.png') }}" style="width: 500px;"></h2>
                        <div class="mb-3"><input value="{{ old('name') }}" type="text" name="name"
                                id="inputNombre" placeholder="Nombre(s)"
                                style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;width: 300px;height: 40px;">
                        </div>
                        <div class="mb-3"><input value="{{ old('lastName') }}" type="text" id="inputApellidos"
                                placeholder="Apellido(s)" name="lastName" required autofocus
                                style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                        </div>
                        <div class="mb-3"><input value="{{ old('email') }}" type="email" id="inputEmail"
                                placeholder="Correo electronico" name="email" required
                                style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                        </div>
                        <div class="mb-3"><input type="password" id="inputPassword" placeholder="Contraseña"
                                name="password" required
                                style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                        </div>
                        <div class="mb-3"><input type="password" id="inputConfirmPassword" name="password_confirmation"
                                placeholder="Confirmar contraseña" required
                                style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                        </div>
                        <div><button class="btn btn-primary" type="submit" value="Upload"
                                style="border-style: none;background: url(&quot;img/Recurso%20191siibal-.png&quot;) top / contain no-repeat;width: 588px;height: 45px;"></button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
