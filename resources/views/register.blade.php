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

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }

        #helpIcon {
            cursor: pointer;
        }
    </style>

    <body
        class="img_fluid"style="background: url(&quot;img/registrocorregido.jpg&quot;); background-position: center center;background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
       

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
            
            <div class="container" >
           
                <div class="row">
                
                    <div class="col-md-6">
                        <div><img></div>
                        <div><img></div>
                        <div><img></div>

                        
                        <img class="img-fluid" src="{{ asset('img/Recurso%2051siibal-.png') }}" style="width: 500px;">
                        <p style="font-size: 90%; color: red;">Todos los campos son Obligatorios
                        </p>
                        <p style="font-size: 90%; color: red;">Llenar información conforme a documentos oficiales  
                        </p>
                        </p>
                        <div class="container">
                            <div class="row">
                            <div class="col-md-6">
                            <label for="inputNombre"> <span style="color: red;">*</span></label>
                            <input value="{{ old('name') }}" type="text" id="inputNombre" class="form-control"
                                placeholder="Nombre (s)" name="name" required autofocus style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                        </div>
                        <div class="col-md-6">
                        <label for="inputNombre"> <span style="color: red;">*</span></label>
                            <input value="{{ old('lastName') }}" type="text" id="inputApellidos"
                                class="form-control" placeholder="Apellido (s)" name="lastName" required autofocus style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                        </div>

                            </div>
                            <script>
                                const nombre = document.getElementById("inputNombre");
                                const apellidos = document.getElementById("inputApellidos");

                                nombre.addEventListener("input", function() {
                                    this.value = this.value.toUpperCase();
                                    const patron = /^[A-ZÁÉÍÓÚÑ\s]+$/;

                                    if (!patron.test(this.value)) {
                                        this.value = this.value.slice(0, -1);
                                    }
                                });

                                apellidos.addEventListener("input", function() {
                                    this.value = this.value.toUpperCase();
                                    const patron = /^[A-ZÁÉÍÓÚÑ\s]+$/;

                                    if (!patron.test(this.value)) {
                                        this.value = this.value.slice(0, -1);
                                    }
                                });
                            </script>

                        </div>

                        <div class="container">
                            <div class="row">

                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label>
                                    <input value="{{ old('inputBirthDay') }}" type="date" id="inputBirthDay"
                                        class="form-control" required name="birthday"
                                        c>
                                </div>
                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label>
                                    <input value="{{ old('rfc') }}" type="text" class="form-control" placeholder="RFC"
                                        name="rfc" required minlength="13" maxlength="13" id="rfcInput"
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                    <span id="mensajeSpan" style="color: red;"></span>
                                </div>

                                <script>
                                    function validarRFC() {
                                        var inputRFC = document.getElementById("rfcInput").value.toUpperCase();
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
                                            document.getElementById("rfcInput").value = "";
                                        } else {
                                            mensajeSpan.style.color = "green";
                                            mensajeSpan.innerText = "";
                                        }
                                    }

                                    document.getElementById("rfcInput").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                        const patron = /^[A-Z0-9]+$/;

                                        if (!patron.test(this.value)) {
                                            this.value = this.value.slice(0, -1);
                                        }
                                    });

                                    document.getElementById("rfcInput").addEventListener("blur", validarRFC);
                                </script>


                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div class="row">

                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label>
                                    <input
                                        value="{{ old('email') }}" type="email" id="inputEmail" class="form-control"
                                        placeholder="Correo Electrónico" name="email" required
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-element">
                                        <div class="pw-meter">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label for="inputNombre" class="d-flex align-items-center mb-0">
                                                    <span style="color: red;">*</span>
                                                    <span id="helpIcon" class="material-icons ms-1">help_outline</span>
                                                </label>
                                                <div class="pw-display-toggle-btn ms-auto" >
                                                    <i class="fa fa-eye"></i>
                                                    <i class="fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control mt-2" placeholder="Contraseña"
                                                name="password" id="password" required
                                                style="border-radius: 10px;">
                                            <div class="pw-strength mt-2">
                                                <span>Bajo</span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div id="modal" class="modal"
                                    style="align-items: center; justify-content: flex-start;">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <p>La contraseña debe contener al menos:</p>
                                        <ul>
                                            <li>Un símbolo</li>
                                            <li>Una mayúscula</li>
                                            <li>Una minúscula</li>
                                            <li>Un número</li>
                                            <li>Mínimo de 8 caracteres</li>
                                        </ul>
                                    </div>
                                </div>

                                <style>
                                    .modal {
                                        display: none;
                                        /* Ocultar el modal por defecto */
                                        position: fixed;
                                        /* Posición fija */
                                        z-index: 9999;
                                        /* Capa superior */
                                        left: 0;
                                        top: 0;
                                        width: 100%;
                                        height: 100%;
                                        overflow: auto;
                                        background-color: rgba(0, 0, 0, 0.4);
                                        /* Fondo semi-transparente */
                                    }

                                    .modal-content {
                                        background-color: #fefefe;
                                        margin: 15% auto;
                                        /* Margen para centrar verticalmente */
                                        padding: 20px;
                                        border: 1px solid #888;
                                        width: 400px;
                                        max-width: 80%;
                                        /* Ancho máximo del modal */
                                    }

                                    .close {
                                        float: right;
                                        font-size: 28px;
                                        font-weight: bold;
                                        cursor: pointer;
                                    }
                                    /* Estilos para pantallas más grandes (por defecto) */
                                    .row {
                                        display: flex;
                                        justify-content: space-between;
                                    }

                                    .column {
                                        flex: 1;
                                        padding: 10px;
                                        border: 1px solid #ccc;
                                    }

                                    /* Estilos para pantallas más pequeñas */
                                    @media screen and (max-width: 768px) {
                                        .row {
                                            flex-direction: column;
                                        }
                                    }

                                </style>

                                <script>
                                    // Abrir el modal cuando se hace clic en el icono de ayuda
                                    document.getElementById("helpIcon").addEventListener("click", function() {
                                        document.getElementById("modal").style.display = "block";
                                    });

                                    // Cerrar el modal cuando se hace clic en la 'x' de cierre
                                    document.getElementsByClassName("close")[0].addEventListener("click", function() {
                                        document.getElementById("modal").style.display = "none";
                                    });

                                    // Cerrar el modal cuando se hace clic fuera del contenido del modal
                                    window.addEventListener("click", function(event) {
                                        if (event.target == document.getElementById("modal")) {
                                            document.getElementById("modal").style.display = "none";
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputNombre">
                                        <span style="color: red;">*</span>
                                        <i class="fa fa-eye-slash" id="togglePassword" style="cursor: pointer; margin-left: 250px;"></i>
                                    </label>
                                    <div class="input-group">
                                        <input
                                            type="password" id="txtPassword" class="form-control"
                                            name="password_confirmation" placeholder="Confirmar contraseña" required
                                            style="border-radius: 10px;">
                                    </div>
                                    <div id="message" style="left: 200px"></div>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                // Cambiar el tipo de input entre 'password' y 'text'
                                $('#togglePassword').click(function() {
                                    const passwordField = $('#txtPassword');
                                    const passwordFieldType = passwordField.attr('type');
                                    const newType = passwordFieldType === 'password' ? 'text' : 'password';
                                    passwordField.attr('type', newType);

                                    // Cambiar el icono
                                    $(this).toggleClass('fa-eye fa-eye-slash');
                                });
                            });
                        </script>



                        <div class="container">
                            <div class="mb-3" style="padding-left: 3px;">
                            <label for="inputNombre"> <span style="color: red;">*</span></label>
                                <input value="{{ old('address') }}" type="text" id="inputAddress"
                                    class="form-control" placeholder="Calle" name="address" required
                                    style="width: 90%;border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                <label for="inputNombre"> <span style="color: red;">*</span></label><input
                                        value="{{ old('numero_ext') }}" type="text" id="inputNumExt"
                                        class="form-control" placeholder="Número Ext." name="numero_ext" required
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                </div>
                                <div class="col-md-4"><label for="inputNombre"><span style="background-color: transparent; color: transparent;">df</span></label><input
                                        value="{{ old('num_int') }}" type="text" id="inputAddress"
                                        class="form-control" placeholder="Número Int. (Opcional)" name="numero_int"
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                </div>
                                <div class="col-md-4"> 
                                <label for="inputNombre"> <span style="color: red;">*</span></label><input
                                        value="{{ old('postalcode') }}" type="text" id="inputPostalCode"
                                        minlength="5" maxlength="5" class="form-control" placeholder="Código Postal"
                                        name="postalcode" required
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                    <script>
                                        // Obtener el input
                                        document.getElementById("inputAddress").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                        var inputPostalCode = document.getElementById("inputPostalCode");
                                        // Agregar el evento oninput
                                        inputPostalCode.addEventListener("input", function() {
                                            // Obtener el valor actual del input
                                            var valor = this.value;
                                            // Eliminar los caracteres no numéricos
                                            valor = valor.replace(/[^0-9]/g, '');
                                            // Actualizar el valor del input
                                            this.value = valor;
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label>
                                    <input value="{{ old('colonia') }}" type="text" id="inputColonia"
                                        class="form-control" oninput="soloLetras(this)" placeholder="Colonia"
                                        name="colonia"
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">

                                </div>
                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label><input
                                        value="{{ old('municipio') }}" type="text" id="inputMunicipio"
                                        oninput="soloLetras(this)" class="form-control" placeholder="Municipio/Ciudad"
                                        name="municipio" required
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">

                                </div>
                                <script>
                                    document.getElementById("inputColonia").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    document.getElementById("inputMunicipio").addEventListener("input", function() {
                                        this.value = this.value.toUpperCase();
                                    });
                                    const inputMunicipio = document.getElementById("inputMunicipio");
                                    inputMunicipio.addEventListener("input", function() {
                                        const valor = this.value;
                                        const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

                                        if (!patron.test(valor)) {
                                            this.value = valor.slice(0, -1);
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label>
                                    <input value="{{ old('ciudad') }}" type="text" id="inputCiudad"
                                        oninput="soloLetras(this)" class="form-control" placeholder="Estado"
                                        name="ciudad" required
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">

                                </div>
                                <div class="col-md-6">
                                <label for="inputNombre"> <span style="color: red;">*</span></label><input
                                        value="{{ old('telephone') }}" type="text" id="inputNumerico"
                                        class="form-control" placeholder="Teléfono" name="telephone" required
                                        minlength="10" maxlength="10"
                                        style="border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                                    <script>
                                        // Obtener el input
                                        var inputNumerico = document.getElementById("inputNumerico");
                                        const inputCiudad = document.getElementById("inputCiudad");
                                        document.getElementById("inputCiudad").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                        // Agregar el evento oninput
                                        inputNumerico.addEventListener("input", function() {
                                            // Obtener el valor actual del input
                                            var valor = this.value;

                                            // Eliminar los caracteres no numéricos
                                            valor = valor.replace(/[^0-9]/g, '');

                                            // Actualizar el valor del input
                                            this.value = valor;
                                        });
                                        inputCiudad.addEventListener("input", function() {
                                            const valor = this.value;
                                            const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

                                            if (!patron.test(valor)) {
                                                this.value = valor.slice(0, -1);
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                        <div><img></div>
                        <div class="container">
                        <div class="g-recaptcha" data-sitekey="6Lcq3QopAAAAAHBA3gIJdkpI-irlgqUO833V8vRH"></div>
      <br/>

                        </div>

                        <div><img>
                            <div class="form-check" ><input class="form-check-input"
                                    type="checkbox" name="terms" value="yes" id="terminosycondiciones">
                                <label class="form-check-label" for="terminosycondiciones"
                                    style="color: rgb(0,0,0);font-size: 15px;">He leído y acepto los <a
                                        href="{{ url('terms') }}" target="_blank" rel="noopener noreferrer">términos y
                                        condiciones de uso</a></label>
                            </div>
                        </div>
                        <div><img></div>
                        <div class="container" >
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Upload"
                                id="submit-btn" disabled
                                style="width: 220px;background: url(&quot;img/Recurso%2053siibal-.png&quot;) center / cover no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;"></button>
                        </div>
                    </div>
                </div>
                <div><img></div>
                <script>
                    const input1 = document.getElementById('inputNombre');
                    const input2 = document.getElementById('inputApellidos');
                    const input3 = document.getElementById('rfcInput');
                    const input4 = document.getElementById('inputBirthDay');
                    const input5 = document.getElementById('inputEmail');
                    const input6 = document.getElementById('password');
                    const input7 = document.getElementById('txtPassword');
                    const input8 = document.getElementById('inputAddress');
                    const input9 = document.getElementById('inputNumExt');
                    const input10 = document.getElementById('inputPostalCode');
                    const input11 = document.getElementById('inputColonia');
                    const input12 = document.getElementById('inputMunicipio');
                    const input13 = document.getElementById('inputCiudad');
                    const input14 = document.getElementById('inputNumerico');
                    const submitBtn = document.getElementById('submit-btn');
                    const message = document.getElementById("message");

                    input1.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });

                    input2.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input3.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input4.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input5.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input6.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input7.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input8.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input9.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input10.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input11.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input12.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input13.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });
                    input14.addEventListener('input', function() {
                        if (input1.value && input2.value && input3.value && input4.value && input5.value && input6.value &&
                            input7.value && input8.value && input9.value && input10.value && input11.value && input12.value &&
                            input13.value && input14.value) {
                            submitBtn.disabled = false;
                        } else {
                            submitBtn.disabled = true;
                        }
                    });


                    function comparePasswords() {
                        if (input6.value === input7.value) {
                            // Las contraseñas coinciden
                            message.textContent = "Las contraseñas coinciden";
                            input6.style.borderColor = "green";
                            input7.style.borderColor = "green";

                        } else {
                            // Las contraseñas no coinciden
                            message.textContent = "Las contraseñas no coinciden";
                            input6.style.borderColor = "red";
                            input7.style.borderColor = "red";

                        }
                    }

                    // Agregar controladores de eventos oninput a los campos de contraseña
                    input6.addEventListener("input", comparePasswords);
                    input7.addEventListener("input", comparePasswords);
                </script>
            </div>


        </form>
        <br>
        <style>
            .pw-meter .form-element {
                position: relative;
            }

            .pw-meter label {
                display: block;
                margin-bottom: 8px;
                color: #111;
            }

            .pw-meter input {
                padding: 8px 30px 8px 10px;
                width: 100%;
                font-size: 16px;
                border: 1px solid #bbb;
                outline: none;
            }



            .pw-meter .pw-display-toggle-btn i.fa-eye {
                display: none;
                position: absolute;
            }

            .pw-meter .pw-display-toggle-btn.active i.fa-eye {
                display: block;
            }

     

            .pw-meter .pw-strength {
                position: relative;

                height: 25px;
                margin-top: 10px;

                text-align: center;
                background: #f2f2f2;
                display: none;
            }

            .pw-meter .pw-strength span:nth-child(1) {
                position: relative;
                font-size: 13px;
                color: #111;
                z-index: 2;
                font-weight: 600;
            }

            .pw-meter .pw-strength span:nth-child(2) {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 0%;
                height: 100%;
                border-radius: 5px;
                z-index: 1;
                transition: all 300ms ease-in-out;
            }
        </style>

        <script>
            function getPasswordStrength(password) {
                let s = 0;
                if (password.length > 6) {
                    s++;
                }
                if (password.length > 10) {
                    s++;
                }
                if (/[A-Z]/.test(password)) {
                    s++;
                }
                if (/[0-9]/.test(password)) {
                    s++;
                }
                if (/[^A-Za-z0-9]/.test(password)) {
                    s++;
                }
                return s;
            }
            document.querySelector(".pw-meter #password").addEventListener("focus", function() {
                document.querySelector(".pw-meter .pw-strength").style.display = "block";
            });
            document.querySelector(".pw-meter .pw-display-toggle-btn").addEventListener("click", function() {
                let el = document.querySelector(".pw-meter .pw-display-toggle-btn");
                if (el.classList.contains("active")) {
                    document.querySelector(".pw-meter #password").setAttribute("type", "password");
                    el.classList.remove("active");
                } else {
                    document.querySelector(".pw-meter #password").setAttribute("type", "text");
                    el.classList.add("active");
                }
            });

            document.querySelector(".pw-meter #password").addEventListener("keyup", function(e) {
                let password = e.target.value;
                let strength = getPasswordStrength(password);
                let passwordStrengthSpans = document.querySelectorAll(".pw-meter .pw-strength span");
                strength = Math.max(strength, 1);
                passwordStrengthSpans[1].style.width = strength * 20 + "%";
                if (strength < 2) {
                    passwordStrengthSpans[0].innerText = "Bajo";
                    passwordStrengthSpans[0].style.color = "#111";
                    passwordStrengthSpans[1].style.background = "#d13636";
                } else if (strength >= 2 && strength <= 4) {
                    passwordStrengthSpans[0].innerText = "Medio";
                    passwordStrengthSpans[0].style.color = "#111";
                    passwordStrengthSpans[1].style.background = "#e6da44";
                } else {
                    passwordStrengthSpans[0].innerText = "Fuerte";
                    passwordStrengthSpans[0].style.color = "#fff";
                    passwordStrengthSpans[1].style.background = "#20a820";
                }
            });
        </script>
        <script>
            function onSubmit(token) {
                document.getElementById("demo-form").submit();
            }
        </script>
        <style>
            input[type="date"]::before {
                color: #999999;
                content: attr(placeholder);
            }


            input[type="date"]: focus,
            input[type="date"]: valid {
                color: #666666;
            }

            input[type="date"]: focus::before,
            input[type="date"]: valid::before {
                content: "" !important;
            }
        </style>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    </body>


    </html>
    <style>
        form input:required {
            content: " *";
        }
    </style>
@endsection
