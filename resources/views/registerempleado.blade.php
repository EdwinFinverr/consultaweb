@extends('layout.apps')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-10 mx-auto">
                <div class="card card-signin flex-row my-5">

                    <div class="card-body">
                        <h5 class="card-title text-center">Alta Cliente</h5>
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
                            <div class="form-label-group">
                                <input value="{{ old('name') }}" type="text" id="inputNombre" class="form-control"
                                    placeholder="Nombre(s)" name="name" required autofocus>
                                <label for="inputNombre"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">Nombre</label>
                            </div>
                            <div class="form-label-group">
                                <input value="{{ old('lastName') }}" type="text" id="inputApellidos" class="form-control"
                                    placeholder="Apellido(s)" name="lastName" required autofocus>
                                <label for="inputApellidos"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">Apellidos</label>
                            </div>
                            <div class="form-label-group">
                                <input value="{{ old('email') }}" type="email" id="inputEmail" class="form-control"
                                    placeholder="Email address" name="email" required>
                                <label for="inputEmail">Correo electrónico</label>
                            </div>
                            <hr class="my-4">
                            <div class="form-label-group">
                                <input value="{{ old('address') }}" type="text" id="inputAddress" class="form-control"
                                    placeholder="Direccion" name="address" required
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputAddress">Dirección</label>
                            </div>
                            <div class="form-label-group">
                                <input value="{{ old('postalcode') }}" type="text" id="inputPostalCode"
                                    class="form-control" placeholder="Codigo Postal" name="postalcode" required
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputPostalCode">Código postal</label>
                            </div>
                            <div class="form-label-group">
                                <input value="{{ old('telephone') }}" type="text" id="inputTelephone"
                                    class="form-control" placeholder="Telefono" name="telephone" required
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputTelephone">Teléfono</label>
                            </div>
                            <div class="form-label-group">
                                <input value="{{ old('inputBirthDay') }}" type="date" id="inputBirthDay"
                                    class="form-control" required name="birthday"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputBirthDay">Fecha de nacimiento</label>
                            </div>
                            <div class="form-label-group">
                                <input value="{{ old('rfc') }}" type="text" id="inputRFC" class="form-control"
                                    placeholder="RFC" name="rfc" required
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputRFC">RFC</label>
                            </div>
                            <hr>
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"
                                    name="password" required
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputPassword">Contraseña</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputConfirmPassword" class="form-control"
                                    name="password_confirmation" placeholder="Confirmar contraseña" required
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <label for="inputConfirmPassword">Confirma tu contraseña</label>
                            </div>

                            <div>

                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"
                                value="Upload">Registrar cliente</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
