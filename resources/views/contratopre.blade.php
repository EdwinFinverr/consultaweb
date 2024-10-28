@extends('layout.appcliente')

@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>inversiones</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/Contact-form-simple.css">
        <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
        <link rel="stylesheet" href="assets/css/Icon-Input.css">
        <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <br>
    <div class="container">
        <div id="progress">
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Home</span></div>
                <div class="circle"><span>1</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Beneficiario</span></a></div>
                <div class="circle"><span>2</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Documentos</span></a></div>
                <div class="circle"><span>3</span></div>
            </div>
            <div class="part on">
                <div class="desc"><span>Carátula de Inversión</span></div>
                <div class="circle"><span>4</span></div>
            </div>
            <div class="part">
                <div class="desc"><a style="color: black"><span>Procedencia de tu Capital</span></a></div>
                <div class="circle"><span>5</span></div>
            </div>
            <div class="part">
                <div class="desc"><a style="color: black"><span>Inversión</span></a></div>
                <div class="circle"><span>6</span></div>
            </div>
        </div>
    </div>






    <style>
        #progress {
            overflow: hidden;
            padding-bottom: 2em;
            text-align: center;
        }

        #progress .part {
            border-bottom: 3px solid #999;
            float: left;
            margin-bottom: 0.75em;
            position: relative;
            width: 16%;
        }

        #progress .desc {
            height: 1.1875em;
            padding-bottom: 1em;
        }

        #progress .desc span {
            font-size: 0.75em;
        }

        #progress .circle {
            left: 0;
            position: absolute;
            right: 0;
            top: 1.5em;
        }

        #progress .circle span {
            background: none repeat scroll 0 0 #666;
            border-radius: 2em 2em 2em 2em;
            color: #FFFFFF;
            display: inline-block;
            font-size: 0.75em;
            height: 2em;
            line-height: 2;
            width: 2em;
        }

        #progress .step {
            position: absolute;
        }

        #progress .on {
            border-bottom-color: #102940;
        }

        #progress .on .desc {
            font-weight: bold;
        }

        #progress .on .circle span {
            font-weight: bold;
            background-color: #102940;
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
                                        <span class="text-uppercase"> {{ $error }} </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="card-title">¡Ya casi terminamos!</h2>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 d-flex flex-column justify-content-center my-3">
                            <p class="card-text">Aquí tienes la carátula de tu inversión para que revises tu información.</p>
                            <p class="card-text">El contrato final se enviará a tu correo para que lo firmes una vez finalizado tu proceso y validada tu información.</p>
                            <a type="submit" href="{{ route('customer.printpdfpre', Session::get('inversion')) }}" target="_blank" class="btn btn-outline-secondary">Ver Carátula</a>
                            <br>
                            <form action="{{ route('postContratopre') }}" method="post">
                                @csrf
                                <button type="submit" class="btn">
                                    <img src="{{ asset('img/Recurso%20225siibal-.png') }}" style="background: left / contain no-repeat, rgba(13,110,253,0); border-style: none; height: 45px; border-radius: 0;">
                                </button>
                            </form>
                        </div>
                    </div>
                    <p>Si necesitas actualizar tu información, haz clic en “Actualizar información”.</p>
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn" data-toggle="modal" data-target="#actualizarModal">
                        <img src="{{ asset('img/BOTON ACTUALIZAR DATOS.png') }}" style="background: left / contain no-repeat, rgba(13,110,253,0); border-style: none; height: 45px; border-radius: 0;">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para actualizar información -->
<div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarModalLabel">Actualizar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para actualizar la información -->
                <form action="{{ route('actualizar.informacion') }}" method="POST" id="formulario">
                    @csrf
                    <!-- Campos para actualizar datos del usuario -->
                    @isset($user)
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $user->name }}">
                        <span class="text-danger" id="error-nombre"></span>
                    </div>
                    <div class="form-group">
                        <label for="identificacion">Identificación:</label>
                        <input type="text" class="form-control" id="identificacion" name="identificacion" value="{{ $user->identificacion }}">
                        <span class="text-danger" id="error-identificacion"></span>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="{{ $user->numero }}">
                        <span class="text-danger" id="error-numero"></span>
                    </div>
                    @endisset

                    <!-- Campos para DatosUsuario -->
                    @isset($datosUsuario)
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $datosUsuario->lastName }}">
                        <span class="text-danger" id="error-apellido"></span>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $datosUsuario->address }}">
                        <span class="text-danger" id="error-direccion"></span>
                    </div>
                    <div class="form-group">
                        <label for="numero_ext">Número Exterior:</label>
                        <input type="text" class="form-control" id="numero_ext" name="numero_ext" value="{{ $datosUsuario->numero_ext }}">
                        <span class="text-danger" id="error-numero_ext"></span>
                    </div>
                    <div class="form-group">
                        <label for="num_int">Número Interior (Opcional):</label>
                        <input type="text" class="form-control" id="num_int" name="num_int" value="{{ $datosUsuario->num_int }}">
                        <span class="text-danger" id="error-num_int"></span>
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal">Código Postal:</label>
                        <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{ $datosUsuario->postalcode }}">
                        <span class="text-danger" id="error-codigo_postal"></span>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $datosUsuario->telephone }}">
                        <span class="text-danger" id="error-telefono"></span>
                    </div>
                    <div class="form-group">
                        <label for="rfc">RFC:</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $datosUsuario->rfc }}">
                        <span class="text-danger" id="error-rfc"></span>
                    </div>
                    @endisset


                    <!-- Campos para InversionCliente -->
                    @isset($inversionCliente)
                    <div class="form-group">
                        <label for="cantidad">Cantidad de inversión:</label>
                        <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{ $inversionCliente->cantidad }}">
                        <span class="text-danger" id="error-cantidad"></span>
                    </div>

                    <div class="form-group">
                        <label for="cuenta_pago_rendimientos">Cuenta de pago de rendimientos:</label>
                        <input type="text" class="form-control" id="cuenta_pago_rendimientos" minlength="18"
                        maxlength="18" pattern="[0-9]+" title="solo se permiten números" name="cuenta_pago_rendimientos" value="{{ $inversionCliente->cuenta_pago_rendimientos }}">
                        <span class="text-danger" id="error-cuenta_pago_rendimientos"></span>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <p> Plazo a invertir</p><select class="form-control" name="plazoInversion"
                                placeholder="-" id="plazo"
                                style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <option value="" disabled selected hidden >Plazo
                                    invertir
                                </option>
                                <option>5 años</option>
                                <option>3 años</option>
                                <option>2 años</option>
                                <option>1 año</option>
                            </select>
                            <span class="text-danger" id="error-plazo"></span>
                        </div>
                    </div>
                    @endisset

                    <!-- Campos para Beneficiario_inversion -->
                    @isset($beneficiariosInversion)
                        @foreach($beneficiariosInversion as $beneficiarioInversion)
                            <div class="form-group">
                                <label for="nombre_beneficiario_{{ $loop->index }}">Nombre del beneficiario:</label>
                                <input type="text" class="form-control" id="nombre_beneficiario_{{ $loop->index }}" name="nombre_beneficiario[]" value="{{ $beneficiarioInversion->name }}">
                                <span class="text-danger" id="error-nombre_beneficiario_{{ $loop->index }}"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="relacion_{{ $loop->index }}">Relación con beneficiario:</label>
                                <input type="text" class="form-control" id="relacion_{{ $loop->index }}" name="relacion[]" value="{{ $beneficiarioInversion->relationship }}">
                                <span class="text-danger" id="error-relacion_{{ $loop->index }}"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="edad_beneficiario_{{ $loop->index }}">Edad del beneficiario:</label>
                                <input type="number" class="form-control" id="edad_beneficiario_{{ $loop->index }}" name="edad_beneficiario[]" value="{{ $beneficiarioInversion->edad }}">
                                <span class="text-danger" id="error-edad_beneficiario_{{ $loop->index }}"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="porcentaje_{{ $loop->index }}">Porcentaje de beneficiario:</label>
                                <input type="text" class="form-control" id="porcentaje_{{ $loop->index }}" name="porcentaje[]" value="{{ $beneficiarioInversion->porcentaje }}">
                                <span class="text-danger" id="error-porcentaje_{{ $loop->index }}"></span>
                            </div>

                            <!-- Separador para distinguir cada beneficiario -->
                            <hr style="border: 1px solid #ccc;">
                        @endforeach
                    @endisset

                    <span id="mensaje" style="color: red"></span>
                    <button type="submit" class="btn btn-primary" id="botonEnviar" disabled>Actualizar</button>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const form = document.getElementById('formulario');
                        const botonEnviar = document.getElementById('botonEnviar');
                        const mensaje = document.getElementById('mensaje');

                        const inputs = form.querySelectorAll('input, select');
                        const telefono = document.getElementById('telefono');
                        const rfc = document.getElementById('rfc');
                        const cantidad = document.getElementById('cantidad');

                        function validarFormulario() {
                            let valido = true;
                            mensaje.textContent = '';

                            // Reset all error messages
                            inputs.forEach(input => {
                                const errorSpan = document.getElementById(`error-${input.id}`);
                                if (errorSpan) {
                                    errorSpan.textContent = '';
                                }
                            });
                            inputs.forEach(input => {
                                // Skip validation for "num_int"
                                if (input.id === 'num_int') {
                                    return;
                                }

                                // Validate other fields
                                if (input.value.trim() === '') {
                                    valido = false;
                                    const errorSpan = document.getElementById(`error-${input.id}`);
                                    if (errorSpan) {
                                        errorSpan.textContent = 'Este campo es obligatorio.';
                                    }
                                }
                            });

                            // Validate telefono
                            if (telefono.value.length !== 10 || isNaN(telefono.value)) {
                                valido = false;
                                const errorSpan = document.getElementById('error-telefono');
                                if (errorSpan) {
                                    errorSpan.textContent = 'El número telefónico debe tener 10 dígitos.';
                                }
                            }

                            // Validate RFC
                            if (rfc.value.length !== 13 || !/^[A-Z0-9]+$/.test(rfc.value)) {
                                valido = false;
                                const errorSpan = document.getElementById('error-rfc');
                                if (errorSpan) {
                                    errorSpan.textContent = 'El RFC debe tener 13 caracteres entre letras y números.';
                                }
                            }

                            // Validate cantidad
                            const cantidadNumerica = parseFloat(cantidad.value.replace(/[^0-9.-]+/g,""));
                            if (isNaN(cantidadNumerica) || cantidadNumerica < 50000) {
                                valido = false;
                                const errorSpan = document.getElementById('error-cantidad');
                                if (errorSpan) {
                                    errorSpan.textContent = 'La cantidad de inversión no puede ser menor a $50,000.';
                                }
                            }

                            botonEnviar.disabled = !valido;
                        }

                        inputs.forEach(input => {
                            input.addEventListener('input', function () {
                                if (input === cantidad) {
                                    const cantidadNumerica = parseFloat(cantidad.value.replace(/[^0-9.-]+/g,""));
                                    if (!isNaN(cantidadNumerica)) {
                                        input.value = cantidadNumerica.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
                                    }
                                }
                                validarFormulario();
                            });
                        });

                        validarFormulario();
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection('content')
