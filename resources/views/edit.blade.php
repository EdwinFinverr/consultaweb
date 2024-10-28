@extends('layout.app')

@section('content')


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


    <body style="background: url(&quot;img/Recurso%2050siibal-.png&quot;) top / cover no-repeat;">
        <form class="form-signin" action="{{ url('postRegistration') }}" method="POST" id="regForm"
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
            <div class="container" style="width: 1193px;height: 650px;">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6" style="text-align: center;">
                        <div><img></div>
                        <div><img></div>
                        <div><img></div>
                        <p><img src="{{ asset('img/Recurso%2051siibal-.png') }}" style="width: 500px;text-align: center;">
                        </p><input value="{{ old('name') }}" type="text" id="inputNombre" class="form-control"
                            placeholder="Nombre(s)" name="name" required autofocus
                            style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;"
                            value="{{ $users->name }}">
                        <div>
                            <div><img></div><input value="{{ old('lastName') }}" type="text" id="inputApellidos"
                                class="form-control" placeholder="Apellido(s)" name="lastName" required autofocus
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('email') }}" type="email" id="inputEmail"
                                class="form-control" placeholder="Correo Electrónico" name="email" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('address') }}" type="text" id="inputAddress"
                                class="form-control" placeholder="Número de Cuenta" name="address" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('address') }}" type="text" id="inputAddress"
                                class="form-control" placeholder="Dirección" name="address" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('postalcode') }}" type="text" id="inputPostalCode"
                                class="form-control" placeholder="Código Postal" name="postalcode" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('telephone') }}" type="text" id="inputTelephone"
                                class="form-control" placeholder="Teléfono" name="telephone" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('inputBirthDay') }}" type="date" id="inputBirthDay"
                                class="form-control" required name="birthday"
                                style="width: 500px;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input value="{{ old('rfc') }}" type="text" id="inputRFC"
                                class="form-control" placeholder="RFC" name="rfc" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <hr>
                        <div>
                            <input type="file" style="overflow: hidden !important" class="form-control-file"
                                name="idphoto" required />
                            <label for="idphoto">Selecciona una imagen de tu IFE,INE( Parte delantera)</label>
                        </div>
                        <div>
                            <input type="file" style="overflow: hidden !important" class="form-control-file"
                                name="idphotoback" required />
                            <label for="idphoto">Selecciona una imagen de tu IFE,INE(Parte trasera)</label>
                        </div>
                        <div>
                            <input type="file" style="overflow: hidden !important" class="form-control-file"
                                name="addressphoto" required />
                            <label for="addressphoto">Selecciona una imagen de un comprobante de domicilio </label>
                        </div>
                        <hr>
                        <div>
                            <div><img></div><input type="password" id="inputPassword" class="form-control"
                                placeholder="Contraseña" name="password" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div>
                            <div><img></div><input type="password" id="inputConfirmPassword" class="form-control"
                                name="password_confirmation" placeholder="Confirmar contraseña" required
                                style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                        <div><img>
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="terms"
                                    value="yes" id="terminosycondiciones">
                                <label class="form-check-label" for="terminosycondiciones"
                                    style="color: rgb(0,0,0);font-size: 20px;">He leído y acepto los <a
                                        href="{{ url('terms') }}" target="_blank" rel="noopener noreferrer">términos y
                                        condiciones de uso</a></label>
                            </div>
                        </div>
                        <div><img></div>
                        <div><img></div>
                        <div><img><button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"
                                value="Upload"
                                style="background: url(&quot;img/Recurso%2053siibal-.png&quot;) center / cover no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;"></button>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </form>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>


@endsection
