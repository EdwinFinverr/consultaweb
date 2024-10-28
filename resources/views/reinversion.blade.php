@extends('layout.appcliente')
<link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">

@section('content')
    <div class="container">
        <div class="row row-cols-sm-1 row-cols-md-2 cols-lg-2  min-vh-100 d-flex justify-content-around align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6 h-100">
                <div class="col ">
                    <div class="card border-secondary my-3" style="height: 70vh;">
                        <div class="card-header text-center">Folio: P{{ $inversion->empresa_inversion_id == 1 ? 'C' : 'F' }}
                            - {{ $inversion->folio }}</div>
                        <div class="card-body text-secondary text-center  d-flex flex-column justify-content-around">
                            <h2 class="card-title text-primary">{{ $inversion->cantidad }}</h2>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Vigencia: <br> Desde
                                    {{ \Carbon\Carbon::parse($inversion->fecha_inicio)->format('d/m/Y') }}
                                </li>
                                <li
                                    class="list-group-item {{ $inversion->estado_inversion_id == 4 ? 'text-danger' : ' ' }}">
                                    Hasta {{ \Carbon\Carbon::parse($inversion->fecha_termino)->format('d/m/Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 h-100">
            @foreach ($usuarios as $usuario)
                <form method="POST" action="{{ route('postReinversion', [$usuario->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="id" value="{{ $inversion->id }}">
                    <div class="form-group">
                        <label for="cantidadInversion">Cantidad a reinvertir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input class="form-control form-control" type="text" onkeypress="return isNumberKey(event)"
                                placeholder="Cantidad a invertir (mínimo $50,000.00)" name="cantidadInversion"
                                id="cantidadInversion" title="hola" required
                                style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cantidadInversionConfirm">Confirma cantidad a reinvertir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input class="form-control form-control" type="text" name="cantidadInversion_confirmation"
                                id="cantidadInversionConfirm"onkeypress="return isNumberKey(event)"
                                placeholder="Confirma cantidad" onchange="validacion(this.value);" required
                                style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
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
                    <div class="form-group mb-5">
                        <label for="percentageInput">Plazo de reinversión</label>
                        <select class="form-control" name="plazoInversion" id="plazo"
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
                    <div class="form-group">
                        <label for="cantidadInversion">Clabe interbancaria</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="lni lni-credit-cards"></i></div>
                            </div>
                            <input type="text" class="form-control" name="cuentaTransferencia" id="cuentaTransferencia"
                                placeholder="Clabe interbancaria (18 digitos)" minlength="18" maxlength="18"
                                pattern="[0-9]+" onkeypress="return isNumberKey(event)" title="solo se permiten números"
                                onchange="validacion(this.value);" value="{{ $inversion->cuenta_transferencia }}" required
                                style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="lni lni-credit-cards"></i></div>
                            </div>
                            <input type="text" class="form-control" name="cuentaTransferencia_confirmation"
                                id="cuentaTransferenciaConfirm" onkeypress="return isNumberKey(event)"
                                placeholder="Confirmar clabe interbancaria" minlength="18" maxlength="18" pattern="[0-9]+"
                                title="solo se permiten números" value="{{ $inversion->cuenta_transferencia }}" required
                                style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        </div>
                    </div>
                    <div>
                        
                        <label for="addImage">Si tu inversion fue mayor a la original da click aqui para subir tu comprobante de trasferencia <input type="checkbox" id="addImage" name="addImage"
                            onchange="toggleImageField()"></label>
                        
                    </div>

                    <div id="addImageField" style="display: none; text-align: center;" >
                    <div class="form-group" style="overflow: hidden !important">
                                                <input type="file" name="comprobanteImg"  />
                                                <label for="fiscalphoto" style="color: red">Selecciona tu Comprobante de
                                                    pago</label>
                                            </div>
                    </div>
                    <script>
                        function toggleImageField() {
                            var imageField = document.getElementById("addImageField");
                            if (document.getElementById("addImage").checked) {
                                imageField.style.display = "block";
                            } else {
                                imageField.style.display = "none";
                            }
                        }
                    </script>
                    <button class="btn btn-primary d-block w-100" type="submit" id="submit-btn" disable
                        style="background: url(&quot;assets/img/Recurso%2043siibal-.png&quot;) left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
                        <img src="{{ asset('img/Recurso%20225siibal-.png') }}"
                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; margin-left: -300px;">
                    </button>
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCambiarClabe"
                        style="rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
                        Cambiar CLABE
                    </button>
                    <br>
                    <span id="mensaje" style="color: red"></span>
                    <script>
                        const input1 = document.getElementById('cantidadInversion');
                        const input2 = document.getElementById('cantidadInversionConfirm');
                        const input3 = document.getElementById('cuentaTransferencia');
                        const input4 = document.getElementById('cuentaTransferenciaConfirm');
                        const input5 = document.getElementById('plazo');
                        const submitBtn = document.getElementById('submit-btn');
                        const mensajeSpan = document.getElementById("mensaje");
                        var moneyInput = document.getElementById("cantidadInversion");

                        $(document).ready(function() {
                            $('#cantidadInversion, #cantidadInversionConfirm, #cuentaTransferencia, #cuentaTransferenciaConfirm, #plazo')
                                .on(
                                    'input',
                                    function() {
                                        if ($('#cantidadInversion').val() && $('#cantidadInversionConfirm').val() && $(
                                                '#cuentaTransferencia').val() && $('#cuentaTransferenciaConfirm').val() && $(
                                                '#plazo').val()) {
                                            if (input3.value === input4.value) {
                                                mensajeSpan.textContent = "";
                                                if (input1.value === input2.value) {
                                                    submitBtn.disabled = false;
                                                    mensajeSpan.textContent = "";
                                                    if (input1.value > 49999 && input2.value > 49999) {
                                                        // Darle formato de moneda a input1

                                                        if (calcularDigitoControl(input3.value.slice(0, 17)) === parseInt(input3
                                                                .value.slice(17))) {
                                                            input1.value = parseInt(input1.value).toLocaleString('es-MX', {
                                                                style: 'currency',
                                                                currency: 'MXN'
                                                            });
                                                            // Darle formato de moneda a input2
                                                            input2.value = parseInt(input2.value).toLocaleString('es-MX', {
                                                                style: 'currency',
                                                                currency: 'MXN'
                                                            });
                                                            // Mensaje de dígito control correcto
                                                            mensajeSpan.textContent = " ";
                                                        } else {
                                                            input1.value = input1.value.replace(/[^\d.-]/g, '');
                                                            // Quitar formato de moneda a input2
                                                            input2.value = input2.value.replace(/[^\d.-]/g, '');
                                                            submitBtn.disabled = true;
                                                            // Mensaje de dígito control incorrecto
                                                            mensajeSpan.textContent =
                                                                "Error en el dígito control de la cuenta clabe";
                                                        }
                                                    } else {
                                                        input1.value = input1.value.replace(/[^\d.-]/g, '');
                                                        // Quitar formato de moneda a input2
                                                        input2.value = input2.value.replace(/[^\d.-]/g, '');
                                                        submitBtn.disabled = true;
                                                        mensajeSpan.textContent = "la cantidad no puede ser menor a $50,000";
                                                    }
                                                } else {
                                                    input1.value = input1.value.replace(/[^\d.-]/g, '');
                                                    // Quitar formato de moneda a input2
                                                    input2.value = input2.value.replace(/[^\d.-]/g, '');
                                                    submitBtn.disabled = true;
                                                    mensajeSpan.textContent = "la cantidad no coincide";
                                                }
                                            } else {
                                                input1.value = input1.value.replace(/[^\d.-]/g, '');
                                                // Quitar formato de moneda a input2
                                                input2.value = input2.value.replace(/[^\d.-]/g, '');
                                                mensajeSpan.textContent = "la cuenta clabe no coincide";
                                                submitBtn.disabled = true;
                                            }
                                        } else {
                                            $('#submit-btn').prop('disabled', true);
                                            input1.value = input1.value.replace(/[^\d.-]/g, '');
                                            // Quitar formato de moneda a input2
                                            input2.value = input2.value.replace(/[^\d.-]/g, '');
                                        }
                                    });
                        });

                        function calcularDigitoControl(cantidad) {
                            // Convertir la cantidad a cadena de caracteres y quitar los caracteres no numéricos
                            const cantidadStr = cantidad.toString().replace(/[^0-9]/g, '');

                            // Calcular el dígito control utilizando el algoritmo deseado
                            let suma = 0;
                            for (let i = 0; i < cantidadStr.length; i++) {
                                const factorPeso = (i % 3 === 0) ? 3 : (i % 3 === 1) ? 7 : 1; // Calcular el factor de peso
                                const producto = parseInt(cantidadStr.charAt(i)) *
                                    factorPeso; // Multiplicar el dígito por el factor de peso
                                suma += producto % 10; // Tomar el módulo 10 del producto y sumarlo a la suma acumulada
                            }
                            const digitoControl = (10 - (suma % 10)) % 10; // Restar la suma a 10, tomar el módulo 10

                            // Retornar el dígito control calculado
                            return digitoControl;
                        }
                    </script>
                </form>
                @endforeach
                <div class="modal fade" id="modalCambiarClabe" tabindex="-1" role="dialog"
                    aria-labelledby="modalCambiarClabeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCambiarClabeLabel">Cambiar CLABE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @foreach ($usuarios as $usuario)
                            <div class="modal-body">
                                <form action="{{ Route('postCambiarClabe', [$usuario->user_id]) }}" method="POST" enctype="multipart/form-data">
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
                                            @csrf
                                            @method('PUT')
                                    <input type="hidden" name="id" value="{{ $inversion->id }}">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nuevaClabe">Nueva CLABE</label>
                                        <input type="text" class="form-control" id="nuevaClabe" name="nuevaClabe"
                                            placeholder="Clabe interbancaria (18 dígitos)" minlength="18" maxlength="18"
                                            pattern="[0-9]+" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmarClabe">Confirmar nueva CLABE</label>
                                        <input type="text" class="form-control" id="confirmarClabe"
                                            name="confirmarClabe" placeholder="Confirmar clabe interbancaria"
                                            minlength="18" maxlength="18" pattern="[0-9]+" required>
                                    </div>
                                    <div>
                                        <label for="estadodecuenta">Estado de cuenta</label>
                                        <input type="file" style="overflow: hidden !important; padding-left: 30px;"
                                            class="form-control-file" name="estadodecuenta"required />
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
