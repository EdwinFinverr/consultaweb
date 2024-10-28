@extends('layout.appcliente')

@section('content')
    <style>
        body {
            background-image: url('/img/PORTADA-CONTRATO.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }


    </style>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 col-xl-10 mx-auto text-center">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <span class="text-uppercase">{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h5 class="card-title">Ya casi está listo</h5>
                        <p class="card-text">A continuación tienes el contrato que te respaldará como cliente</p>
                        <a href="{{ route('reinversionpre.pdf', Session::get('inversion')) }}" target="_blank"
                            class="btn btn-outline-secondary">Ver PreContrato</a>
                        <form action="{{ route('postContrato') }}" method="post">
                            @csrf
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contrato" id="aceptarContraro">
                                <label class="form-check-label" for="aceptarContraro">
                                    He leído y acepto los términos y condiciones del contrato
                                </label>
                            </div>
                            <div id="password-loader" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i> Validando contraseña...
                            </div>
                            <div>
                                <label for="password-input">Ingrese su contraseña:</label>
                                <input type="password" name="password" id="password-input">
                                <div id="password-error" class="text-danger"
                                    style="border-radius: 10px;">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-2" id="btn-contrato" disabled>Firmar contrato</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Font Awesome library -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>

    <script>
        const passwordInput = document.getElementById('password-input');
        const contratoButton = document.getElementById('btn-contrato');
        const passwordError = document.getElementById('password-error');
        const passwordLoader = document.getElementById('password-loader');

        let validationTimeout;

        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;

            if (password.length > 0) {
                passwordLoader.style.display = 'block';
                clearTimeout(validationTimeout);

                validationTimeout = setTimeout(function() {
                    axios.post('{{ route('validar-contrasena') }}', {
                            password: password
                        })
                        .then(function(response) {
                            const isValidPassword = response.data.isValid;

                            if (isValidPassword) {
                                contratoButton.disabled = false;
                                passwordError.textContent = '';
                                passwordLoader.style.display = 'none';
                            } else {
                                contratoButton.disabled = true;
                                passwordError.textContent = 'Contraseña incorrecta';
                                passwordLoader.style.display = 'none';
                            }
                        })
                        .catch(function(error) {
                            console.error(error);
                            passwordError.textContent = 'Error al validar la contraseña';
                            passwordLoader.style.display = 'none';
                        });
                }, 1000);
            } else {
                passwordError.textContent = '';
                passwordLoader.style.display = 'none';
                clearTimeout(validationTimeout);
            }
        });
    </script>
@endsection
