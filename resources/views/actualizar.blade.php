@extends('layout.appact')

@section('content')

<div class="container " >
           
                @foreach ($usuarios as $usuario)
                    <div class="col-md-8 col-xl-6  mx-auto">
                        <form method="POST" action="{{ route('updateDatosinicio', [$usuario->id]) }}" id="regForm"
                            enctype="multipart/form-data"  >
                            @csrf
                            @method('PUT')
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
                            <h2><img src="{{ asset('img/Recurso%20105siibal-.png') }}"
                                    style="width: 250px;">
                            </h2>
                            <div class="mb-3">
                            <p style="font-size: 90%; color: red;">Llenar información conforme a documentos oficiales  <span
                                clase="red" style="color: red;">*</span>
                        </p>
                            <span clase="red"
                                            style="  color: red;font-size: 25px;">*</span>
                                <input value="{{ $usuario->birthday }}" type="date" id="inputBirthDay"
                                    class="form-control" placeholder="Fecha de nacimiento :" required name="birthday"
                                    style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                            </div>
                            <div class="mb-3">
                                
                            <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                    value="{{ $usuario->rfc }}" type="text" id="inputRFC" class="form-control"
                                    placeholder="RFC" name="rfc" required minlength="13" maxlength="13"
                                    style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;>
                                <span id="mensajeSpan" style="color: red;"></span>
                                <script>
                                    function validarRFC() {
                                        var inputRFC = document.getElementById("inputRFC").value.toUpperCase();
                                        var inputBirthDay = document.getElementById("inputBirthDay").value;

                                        // Extraer el día, mes y año de la fecha de nacimiento
                                        var day = inputBirthDay.substring(8, 10);
                                        var month = inputBirthDay.substring(5, 7);
                                        var year = inputBirthDay.substring(0, 4);

                                        // Formar el RFC con los datos de la fecha de nacimiento
                                        var rfc = inputRFC.substring(0, 4) + year.substring(2, 4) + month + day + inputRFC.substring(10, 13);

                                        var mensajeSpan = document.getElementById("mensajeSpan");

                                        // Eliminar mensajes anteriores
                                        mensajeSpan.innerText = "";

                                        // Validar que el RFC ingresado sea igual al RFC formado con la fecha de nacimiento
                                        if (inputRFC !== rfc) {
                                            mensajeSpan.innerText = "El RFC ingresado no coincide con la fecha de nacimiento.";
                                            mensajeSpan.style.color = "red";
                                            document.getElementById("inputRFC").value = "";
                                        } else {
                                            mensajeSpan.style.color = "green";
                                            mensajeSpan.innerText = "";
                                        }
                                    }

                                    document.getElementById("inputRFC").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });

                                    document.getElementById("inputRFC").addEventListener("blur", validarRFC);
                                </script>
                                <br />

                                <div class="mb-3">
                                    
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span>
                                        <strong>Dirección</strong><input value="{{ $usuario->address }}" type="text"
                                            id="inputAddress" class="form-control" placeholder="Calle" name="address"
                                            required
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">

                                    
                                </div>
                                <script>
                                    document.getElementById("inputAddress").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    document.getElementById("inputAddress").addEventListener("input", function() {
                                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                    });
                                </script>
                                <div class="mb-3">
                                    
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                        value="{{ $usuario->numero_ext }}" type="text" id="inputNumext"
                                        class="form-control" placeholder="Número Ext." name="numero_ext" required
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputNumext").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    
                                </script>
                                <div class="mb-3">
                                    
                                    </span><input value="{{ $usuario->num_int }}" type="text" id="inputNumint"
                                        class="form-control" placeholder="Número Int. (Opcional)" name="numero_int"
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputNumint").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    
                                </script>
                                <div class="mb-3">
                                  
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                        value="{{ $usuario->colonia }}" type="text" id="inputColonia"
                                        class="form-control" placeholder="Colonia" name="colonia"
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputColonia").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                </script>
                                <div class="mb-3">
                                    
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                        value="{{ $usuario->postalcode }}" type="text" minlength="5" maxlength="5"
                                        id="inputPostalCode" class="form-control" placeholder="Código Postal"
                                        name="postalcode" required
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputPostalCode").addEventListener("input", function() {
                                        this.value = this.value.replace(/[^0-9]/g, '');
                                    });
                                </script>
                                <div class="mb-3">
                                    
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                        value="{{ $usuario->municipio }}" type="text" id="inputMunicipio"
                                        class="form-control" placeholder="Municipio" name="municipio" required
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputMunicipio").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    document.getElementById("inputMunicipio").addEventListener("input", function() {
                                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                    });
                                </script>
                                <div class="mb-3">
                                    
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                        value="{{ $usuario->ciudad }}" type="text" id="inputCiudad" class="form-control"
                                        placeholder="Ciudad" name="ciudad" required
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputCiudad").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    document.getElementById("inputCiudad").addEventListener("input", function() {
                                        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                    });
                                </script>
                                <div class="mb-3">
                                    
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input
                                        value="{{ $usuario->telephone }}" type="text" id="inputTelephone"
                                        class="form-control" placeholder="Teléfono" name="telephone" required
                                        minlength="10" maxlength="10"
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                </div>
                                <script>
                                    document.getElementById("inputTelephone").addEventListener("input", function() {
                                        this.value = this.value.replace(/[^0-9]/g, '');
                                    });
                                </script>
                            
                                <div class="mb-3">
                                
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span>
                                            <i id="showPassword1" class="fa fa-eye"
                                        style=" transform: translateY(-50%); cursor: pointer;"></i>
                                    <input type="password" id="inputPassword" class="form-control"
                                        placeholder="Contraseña" name="password" required minlength="8"
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                    
                                </div>
                                <div class="mb-3">
                                
                                <span clase="red"
                                            style=" color: red; font-size: 25px;">*</span>
                                            <i id="showPassword2" class="fa fa-eye"
                                        style=" transform: translateY(-50%); cursor: pointer;"></i>
                                    <input type="password" id="inputConfirmPassword" class="form-control"
                                        placeholder="Confirmar Contraseña" name="password_confirmation" required
                                        minlength="8"
                                        style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;">
                                   
                                </div>

                            </div>
                            <div><button class="btn btn-primary" type="submit" value="Upload"
                                    style="border-style: none;background: url(&quot;img/Recurso%20119siibal-.png&quot;) top / contain no-repeat;"><img
                                        src="{{ asset('img/Recurso%20119siibal-.png') }}"
                                        style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></button>
                            </div>
                        </form>
                        <!-- Modal -->
                        <div id="modalInfo" class="modal">
                            <div class="modal-content2">
                                <span class="close" id="cerrarModal">&times;</span>
                                <p>La contraseña debe contener al menos:

                        Un símbolo,
                        Una mayúscula,
                        Una minúscula,
                        Un número,
                        Mínimo de 8 caracteres.</p>
                            </div>
                        </div>
                                        @endforeach
                                    </div>
                                    <script>
                        // scripts.js
                        // Obtener referencias a los campos de entrada de contraseña
                        const campoContraseña1 = document.getElementById("inputPassword");
                        const campoContraseña2 = document.getElementById("inputConfirmPassword");

                        // Obtener referencia al modal
                        const modal = document.getElementById("modalInfo");

                        // Agregar un event listener de clic a cada campo de contraseña
                        let modalAbierto = false; // Variable para rastrear si el modal ya se ha abierto

                        campoContraseña1.addEventListener("click", () => {
                            if (!modalAbierto) {
                                abrirModal();
                                modalAbierto = true;
                            }
                        });

                        campoContraseña2.addEventListener("click", () => {
                            if (!modalAbierto) {
                                abrirModal();
                                modalAbierto = true;
                            }
                        });

                        // Función para abrir el modal
                        function abrirModal() {
                            modal.style.display = "block";
                        }

                        // Obtener referencia al icono de cerrar modal
                        const cerrarModalIcono = document.getElementById("cerrarModal");

                        // Agregar event listener para cerrar el modal
                        cerrarModalIcono.addEventListener("click", () => {
                            modal.style.display = "none";
                        });

                        // Alternar la visibilidad de la contraseña
                        const mostrarContraseña1Icono = document.getElementById("mostrarContraseña1");
                        const mostrarContraseña2Icono = document.getElementById("mostrarContraseña2");

                        mostrarContraseña1Icono.addEventListener("click", () => {
                            campoContraseña1.type = campoContraseña1.type === "password" ? "text" : "password";
                        });

                        mostrarContraseña2Icono.addEventListener("click", () => {
                            campoContraseña2.type = campoContraseña2.type === "password" ? "text" : "password";
                        });

                        </script>
                        <style>
                            /* styles.css */
                        /* Estilos existentes */

                        /* Nuevos estilos para el modal */
                        .modal {
                            display: none;
                            position: fixed;
                            z-index: 1;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.4);
                        }

                        .modal-content2 {
                            background-color: #fefefe;
                            margin: 15% auto;
                            padding: 20px;
                            border: 1px solid #888;
                            width: 80%;
                            max-width: 500px;
                            position: relative;
                            border-radius: 10px;
                        }

                        .close {
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            font-size: 20px;
                            font-weight: bold;
                            color: #aaa;
                            cursor: pointer;
                        }

                        </style>
                        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                        <div class="modal-footer">
                            <script>
                                document.getElementById('showPassword1').addEventListener('click', function() {
                                    togglePasswordVisibility('inputPassword');
                                });

                                document.getElementById('showPassword2').addEventListener('click', function() {
                                    togglePasswordVisibility('inputConfirmPassword');
                                });

                                function togglePasswordVisibility(inputId) {
                                    var input = document.getElementById(inputId);
                                    var icon = document.getElementById('show' + inputId.charAt(0).toUpperCase() + inputId.slice(1));

                                    if (input.type === 'password') {
                                        input.type = 'text';
                                        icon.classList.remove('fa-eye');
                                        icon.classList.add('fa-eye-slash');
                                    } else {
                                        input.type = 'password';
                                        icon.classList.remove('fa-eye-slash');
                                        icon.classList.add('fa-eye');
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
@endsection