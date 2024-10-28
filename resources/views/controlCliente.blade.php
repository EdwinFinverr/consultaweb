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



    <div class="container">
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

        <div class="container py-4">
        </div>
        <div id="progress">
            <div class="part on">
                <div class="desc"><span>Home</span></div>
                <div class="circle"><span>1</span></div>
            </div>
            <div class="part">
                <div class="desc"><a style="color: black"><span>Beneficiario</span></a></div>
                <div class="circle"><span>2</span></div>
            </div>
            <div class="part">
                <div class="desc"><a style="color: black"><span>Documentos</span></a></div>
                <div class="circle"><span>3</span></div>
            </div>
            <div class="part">
                <div class="desc"><a style="color: black"><span>Carátula de Inversión</span></a></div>
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

        <body>
            <section class="position-relative py-4 py-xl-5">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center" style="border-style: none;">
                        <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4" style="width: 650px;border-style: none;">
                            <div class="card mb-5" style="border-style: none;">

                                <div class="card-body p-sm-5" style="border-style: none;">
                                    <div class="col-md-8 col-xl-6 text-center mx-auto;">
                                        <div><img></div>
                                        <div><img></div>
                                        <div><img></div>
                                        <div><img></div>
                                        <h2 ><img src="{{ asset('img/Recurso%2077siibal-.png') }}"
                                                style="width: 300px;">
                                        </h2>
                                    </div>
                                    <h1 style="font-size: 20px;">Realiza una inversión por un período de hasta 5 años.</h1>


                                    <form action="{{ route('postInversion') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="mb-3"><span clase="red"
                                                style=" padding-left: 510px; color: red;">*</span>
                                            <p>Cantidad a invertir (mínimo $50,000.00)</p>
                                            <div class="input-group">

                                                <div class="input-group-prepend"><span
                                                        class="input-group-text icon-container"
                                                        style="background: rgb(16,41,64);"><i class="fa fa-dollar"
                                                            style="background: rgba(23,21,21,0);color: rgb(255,255,255);"
                                                            style="border-bottom-left-radius: 10px;border-top-left-radius: 10px;"></i></span>
                                                </div>
                                                <input class="form-control form-control" type="text"
                                                    onkeypress="return isNumberKey(event)"
                                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"
                                                    placeholder="Cantidad a invertir (mínimo $50,000.00)"
                                                    name="cantidadInversion" id="cantidadInversion" title="hola" required>
                                            </div>

                                        </div>
                                        <div class="mb-3"><span clase="red"
                                                style=" padding-left: 510px; color: red;">*</span>
                                            <p>Confirma cantidad</p>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text icon-container"
                                                        style="background: rgb(16,41,64);"><i class="fa fa-dollar"
                                                            style="color: rgb(255,255,255);"
                                                            style="border-bottom-left-radius: 10px;border-top-left-radius: 10px;"></i></span>
                                                </div>

                                                <input class="form-control form-control" type="text"
                                                    name="cantidadInversion_confirmation"
                                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"
                                                    id="cantidadInversionConfirm"onkeypress="return isNumberKey(event)"
                                                    placeholder="Confirma cantidad" onchange="validacion(this.value);"
                                                    required>
                                                <script>
                                                    function isNumberKey(evt) {
                                                        var charCode = (evt.which) ? evt.which : event.keyCode;
                                                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                            return false;
                                                        }
                                                        return true;
                                                    }
                                                </script>
                                            </div>

                                        </div>
                                        
                                        <div class="form-group">
                                            <span clase="red" style=" padding-left: 510px; color: red;">*</span>
                                            <p>Cuenta Clabe para pago de rendimientos</p>
                                            <input type="text" value="{{ old('rendimiento') }}" id="inputarendimiento"
                                                class="form-control" placeholder="Clabe interbancaria (18 digitos)"
                                                name="rendimiento" minlength="18" maxlength="18" pattern="[0-9]+"
                                                style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;"
                                                onkeypress="return isNumberKey(event)" title="solo se permiten números"
                                                onchange="validacion(this.value);" required>

                                        </div>
                                        <div class="form-group"><span clase="red"
                                                style=" padding-left: 510px; color: red;">*</span>
                                            <div class="mb-3"><input type="text" id="inputConfirmarendimiento"
                                                    class="form-control" name="rendimiento_confirmation"
                                                    onkeypress="return isNumberKey(event)"
                                                    placeholder="Confirmar clabe interbancaria" minlength="18"
                                                    maxlength="18" pattern="[0-9]+" title="solo se permiten números"
                                                    required
                                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="mb-3"> <span clase="red"
                                                    style=" padding-left: 510px; color: red;">*</span>
                                                <p> Plazo a invertir</p><select class="form-control" name="plazoInversion"
                                                    placeholder="-" id="plazo"
                                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                                    <option value="" disabled selected hidden style="">Plazo
                                                        invertir
                                                    </option>
                                                    <option>5 años</option>
                                                    <option>3 años</option>
                                                    <option>2 años</option>
                                                    <option>1 año</option>
                                                </select>
                                            </div>

                                        </div>
                                        <br>

                                        @csrf
                                        <div class="form-group">
                                        <span clase="red"
                                        style=" padding-left: 510px; color: red;">*</span>
                                            <h3>Requiere que se le emita el CFDI del rendimiento mensual?</h3>

                                            
                                                <input type="radio" id="opcion1" name="cfdi" value="Si">
                                                <label for="opcion1">Sí</label><br>
                                                <input type="radio" id="opcion2" name="cfdi" value="No">
                                                <label for="opcion2">No</label><br>
                                           
                                        </div>
                                        <div>
                                            <span class="red" style="padding-left: 510px; color: red;">*</span>
                                            <label for="image">Subir constancia de situación fiscal:</label>
                                            <input type="file" name="image" id="image">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <button class="btn btn-primary d-block w-100" type="submit" id="submit-btn"disabled
                                                
                                                style="background: url(&quot;assets/img/Recurso%2043siibal-.png&quot;) left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
                                                <img src="{{ asset('img/Recurso%20225siibal-.png') }}"
                                                    style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
                                            </button>
                                            <br>
                                            <span id="mensaje" style="color: red"></span>
                                        </div>

                                        <script>
                                            const input1 = document.getElementById('cantidadInversion');
                                            const input2 = document.getElementById('cantidadInversionConfirm');
                                            const input3 = document.getElementById('inputarendimiento');
                                            const input4 = document.getElementById('inputConfirmarendimiento');
                                            const input5 = document.getElementById('plazo');
                                            const inputImage = document.getElementById('image');
                                            const cfdiOptions = document.getElementsByName('cfdi');
                                            const submitBtn = document.getElementById('submit-btn');
                                            const mensajeSpan = document.getElementById("mensaje");

                                            $(document).ready(function () {
                                                $('#cantidadInversion, #cantidadInversionConfirm, #inputarendimiento, #inputConfirmarendimiento, #plazo, #image, input[name="cfdi"]').on('input change', function () {
                                                    if ($('#cantidadInversion').val() && $('#cantidadInversionConfirm').val() &&
                                                        $('#inputarendimiento').val() && $('#inputConfirmarendimiento').val() &&
                                                        $('#plazo').val() && $('#image').val() && isCfdiSelected()) {

                                                        let cantidadValida = validarCantidad();
                                                        let cuentasValidas = validarCuentas();

                                                        if (cantidadValida && cuentasValidas) {
                                                            mensajeSpan.textContent = "";
                                                            submitBtn.disabled = false;
                                                        } else {
                                                            submitBtn.disabled = true;
                                                        }
                                                    } else {
                                                        submitBtn.disabled = true;
                                                        mensajeSpan.textContent = "Por favor, complete todos los campos.";
                                                    }
                                                });
                                            });

                                            function validarCantidad() {
                                                let cantidad1 = parseFloat(input1.value.replace(/[^\d.-]/g, ''));
                                                let cantidad2 = parseFloat(input2.value.replace(/[^\d.-]/g, ''));

                                                if (cantidad1 !== cantidad2) {
                                                    mensajeSpan.textContent = "Las cantidades no coinciden.";
                                                    return false;
                                                }

                                                if (cantidad1 < 50000 || cantidad2 < 50000) {
                                                    mensajeSpan.textContent = "La cantidad no puede ser menor a $50,000.";
                                                    return false;
                                                }

                                                input1.value = cantidad1.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
                                                input2.value = cantidad2.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });

                                                return true;
                                            }

                                            function validarCuentas() {
                                                if (input3.value !== input4.value) {
                                                    mensajeSpan.textContent = "La clabe interbancaria no coincide.";
                                                    return false;
                                                }

                                                if (!validarDigitoControl(input3.value)) {
                                                    mensajeSpan.textContent = "Clabe interbancaria no válida.";
                                                    return false;
                                                }

                                                return true;
                                            }

                                            function validarDigitoControl(cuenta) {
                                                return calcularDigitoControl(cuenta.slice(0, 17)) === parseInt(cuenta.slice(17));
                                            }

                                            function calcularDigitoControl(cantidad) {
                                                const cantidadStr = cantidad.toString().replace(/[^0-9]/g, '');
                                                let suma = 0;
                                                for (let i = 0; i < cantidadStr.length; i++) {
                                                    const factorPeso = (i % 3 === 0) ? 3 : (i % 3 === 1) ? 7 : 1;
                                                    const producto = parseInt(cantidadStr.charAt(i)) * factorPeso;
                                                    suma += producto % 10;
                                                }
                                                const digitoControl = (10 - (suma % 10)) % 10;
                                                return digitoControl;
                                            }

                                            function isCfdiSelected() {
                                                for (let i = 0; i < cfdiOptions.length; i++) {
                                                    if (cfdiOptions[i].checked) {
                                                        return true;
                                                    }
                                                }
                                                return false;
                                            }

                                            function isNumberKey(evt) {
                                                var charCode = (evt.which) ? evt.which : event.keyCode;
                                                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                    return false;
                                                }
                                                return true;
                                            }
                                            function isNumberKey(evt) {
                                                var charCode = (evt.which) ? evt.which : event.keyCode;
                                                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                    return false;
                                                }
                                                return true;
                                            }

                                            function validateFile(input, maxSize, allowedTypes) {
                                                var file = input.files[0];
                                                var fileType = file.type;
                                                var fileSize = file.size;

                                                if (fileSize > maxSize) {
                                                    alert('El archivo no debe ser mayor de ' + maxSize / 1024 / 1024 + ' MB.');
                                                    input.value = ''; // Clear the input
                                                    return;
                                                }

                                                if (!allowedTypes.includes(fileType)) {
                                                    alert('El archivo debe ser de tipo: ' + allowedTypes.join(', ') + '.');
                                                    input.value = ''; // Clear the input
                                                    return;
                                                }
                                            }

                                            $(document).ready(function() {
                                                $('#image').on('change', function() {
                                                    validateFile(this, 3 * 1024 * 1024, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'application/pdf']);
                                                });
                                            });
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <span style="visibility: hidden;">El porcentaje es: </span><span style="visibility: hidden;"
                id="MiTotal"></span>
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        </body>
    </div>
@endsection
<script>
    
    function comprobar(obj) {
        if (obj.checked) {

            document.getElementById('boton').style.display = "";
        } else {

            document.getElementById('boton').style.display = "none";
        }
    }

    function inter(obj) {
        if (obj.checked) {

            document.getElementById('boto').style.display = "";
        } else {

            document.getElementById('boto').style.display = "none";
        }
    }
</script>

<script>
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") {
            return;
        }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "$" + left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "$" + input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ".00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>
