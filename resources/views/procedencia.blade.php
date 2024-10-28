@extends('layout.appcliente')

@section('content')
    <br>
    <div class="container">
        <div id="progress">
            <div class="part on">
                <div class="desc"><a  style="color: black"><span>Home</span></div>
                <div class="circle"><span>1</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a  style="color: black"><span>Beneficiario</span></a>
                </div>
                <div class="circle"><span>2</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a  style="color: black"><span>Documentos</span></a></div>
                <div class="circle"><span>3</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a  style="color: black"><span>Carátula de Inversión</span></a></div>
                <div class="circle"><span>4</span></div>
            </div>
            <div class="part on">
                <div class="desc"><span>Procedencia de tu Capital</span></div>
                <div class="circle"><span>5</span></div>
            </div>
            <div class="part">
                <div class="desc"><a  style="color: black"><span>Inversión</span></a></div>
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
    <br>
    <br>

        <div class="container">
        <form method="post" action="{{ route('procedencia.inversion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $inversion->id }}">
    
    <!-- Instrucciones -->
    <div class="alert alert-info" role="alert">
    <h4 class="alert-heading">Especificación de la Procedencia del Capital de Inversión</h4>
    <p>Especifica el origen de tu capital para la inversión de {{ $inversion->cantidad }}. Puedes proporcionar información sobre una, dos o hasta tres fuentes. Para cada fuente necesitas incluir los siguientes datos:</p>
    <ul>
        <li><strong>Cantidad:</strong> Indica la cantidad que proviene de esta fuente.</li>
        <li><strong>Cuenta CLABE:</strong> Ingresa el número de cuenta CLABE (18 dígitos) de donde proviene el dinero.</li>
        <li><strong>Institución:</strong> Por favor, indícanos el nombre de la institución financiera.</li>
    </ul>

    
    <p class="mb-0"><strong>Nota:</strong> Estos campos son obligatorios para cada fuente que uses. Si solo tienes una o dos, deja en blanco las demás.</p>
</div>

    <br>
        <h1><strong>Trasferencia Bancaria</strong></h1>
    <!-- Sección 1 -->
    <div class="form-section row">
        <div class="col">
            <label for="campo1_cantidad">Cantidad:</label>
            <input type="text" id="campo1_cantidad" name="campo1_cantidad" class="form-control" onblur="formatearCantidad(this)">
        </div>
        <div class="col">
            <label for="campo1_cuentaclabe">Cuenta Clabe:</label>
            <input type="text" id="campo1_cuentaclabe" name="campo1_cuentaclabe" class="form-control" maxlength="18" onblur="validarCuentaLongitud(this)">
            <p id="mensaje1" style="color: red;"></p>
        </div>
        <div class="col">
            <label for="campo1_institucion">Institución:</label>
            <input type="text" id="campo1_institucion" name="campo1_institucion" class="form-control">
        </div>
    </div>

    <!-- Sección 2 -->
    <div class="form-section row">
        <div class="col">
            <label for="campo2_cantidad">Cantidad:</label>
            <input type="text" id="campo2_cantidad" name="campo2_cantidad" class="form-control" onblur="formatearCantidad(this)">
        </div>
        <div class="col">
            <label for="campo2_cuentaclabe">Cuenta Clabe:</label>
            <input type="text" id="campo2_cuentaclabe" name="campo2_cuentaclabe" class="form-control" maxlength="18" onblur="validarCuentaLongitud(this)">
            <p id="mensaje2" style="color: red;"></p>
        </div>
        <div class="col">
            <label for="campo2_institucion">Institución:</label>
            <input type="text" id="campo2_institucion" name="campo2_institucion" class="form-control">
        </div>
    </div>

    <!-- Sección 3 -->
    <div class="form-section row">
        <div class="col">
            <label for="campo3_cantidad">Cantidad:</label>
            <input type="text" id="campo3_cantidad" name="campo3_cantidad" class="form-control" onblur="formatearCantidad(this)">
        </div>
        <div class="col">
            <label for="campo3_cuentaclabe">Cuenta Clabe:</label>
            <input type="text" id="campo3_cuentaclabe" name="campo3_cuentaclabe" class="form-control" maxlength="18" onblur="validarCuentaLongitud(this)">
            <p id="mensaje3" style="color: red;"></p>
        </div>
        <div class="col">
            <label for="campo3_institucion">Institución:</label>
            <input type="text" id="campo3_institucion" name="campo3_institucion" class="form-control">
        </div>
    </div>
    <br>
    <h1><strong>Sección de Depósito Bancario</strong></h1>
    <!-- Sección de Depósito Bancario -->
    <div class="form-section row">
        <div class="col">
            <label for="deposito_bancario">Depósito Bancario:</label>
            <input type="text" id="deposito_bancario" name="deposito_bancario" class="form-control" onblur="formatearCantidad(this)">
        </div>
    </div>
    <p id="mensajeGeneral" style="color: red;"></p>
    <div class="form-group mt-3">
        <button id="submit-button" type="submit" class="btn btn-primary" style="background: none; border: none; padding: 0;" disabled>
            <img src="{{ asset('img/Recurso 225siibal-.png') }}" style="background: left / contain no-repeat, rgba(13,110,253,0); border-style: none; height: 45px; border-radius: 0;">
        </button>
    </div>


</form>

<script>
    const inversionCantidad = parseFloat('{{ $inversion->cantidad }}'.replace(/[^0-9.-]+/g,""));

    function formatearCantidad(input) {
        let value = input.value.replace(/[^0-9.-]+/g,"");
        if(value) {
            let formattedValue = new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(value);
            input.value = formattedValue;
        }
        validarFormulario();
    }

    function validarCuentaLongitud(input) {
    const id = input.id.split('_')[0].replace('campo', ''); // Extrae el número de la sección
    const cantidadInput = document.getElementById(`campo${id}_cantidad`); // Obtiene el campo de cantidad
    const cantidadValue = cantidadInput.value.replace(/\D/g, ''); // Solo números

    // Verifica si el campo "Cantidad" tiene un valor
    if (cantidadValue === "") {
        document.getElementById(`mensaje${id}`).textContent = ""; // Elimina el mensaje de alerta
        desactivarBoton(); // Desactiva el botón si no hay cantidad
        return; // Salir de la función si no hay cantidad
    }

    const clabe = input.value.replace(/\D/g, ''); // Solo números

    if (clabe.length !== 18) {
        document.getElementById(`mensaje${id}`).textContent = "El número de cuenta CLABE debe tener exactamente 18 dígitos.";
        desactivarBoton();
    } else {
        document.getElementById(`mensaje${id}`).textContent = ""; // Elimina el mensaje si la longitud es válida
        validarCuentaFormato(input);
    }
}



    function validarCuentaFormato(input) {
        const clabe = input.value.replace(/\D/g, ''); // Solo números
        const id = input.id.split('_')[0].replace('campo', '');
        if (!esCuentaClabeValida(clabe)) {
            document.getElementById(`mensaje${id}`).textContent = "El número de cuenta CLABE no es válido.";
            desactivarBoton();
        } else {
            document.getElementById(`mensaje${id}`).textContent = "";
            validarFormulario();
        }
    }

    function esCuentaClabeValida(clabe) {
        // Verifica que CLABE sea válida
        const multipliers = [3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1, 3, 7, 1];
        let total = 0;
        for (let i = 0; i < clabe.length - 1; i++) {
            total += parseInt(clabe[i]) * multipliers[i];
        }
        let checkDigit = (10 - (total % 10)) % 10;
        return checkDigit === parseInt(clabe[17]);
    }

    function validarFormulario() {
        let suma = 0;
        let camposValidos = false;
        let cuentaClabeValida = true;

        for(let i = 1; i <= 3; i++) {
            let cantidad = document.getElementById(`campo${i}_cantidad`).value.replace(/[^0-9.-]+/g,"");
            if(cantidad) {
                suma += parseFloat(cantidad);
                camposValidos = true;
            }
            let clabe = document.getElementById(`campo${i}_cuentaclabe`).value.replace(/\D/g, '');
            if(clabe.length === 18 && !esCuentaClabeValida(clabe)) {
                cuentaClabeValida = false;
            }
        }

        let depositoBancario = document.getElementById('deposito_bancario').value.replace(/[^0-9.-]+/g, '');
        if(depositoBancario) {
            suma += parseFloat(depositoBancario);
            camposValidos = true;
        }

        if(suma !== inversionCantidad) {
            mostrarMensaje("La suma de las cantidades debe ser igual a la cantidad de la inversión.");
            desactivarBoton();
        } else if(!camposValidos) {
            mostrarMensaje("Debe llenar al menos una sección.");
            desactivarBoton();
        } else if(!cuentaClabeValida) {
            mostrarMensaje("Algunas cuentas CLABE no son válidas.");
            desactivarBoton();
        } else {
            mostrarMensaje("");
            activarBoton();
        }
    }

    function mostrarMensaje(mensaje) {
        document.getElementById('mensajeGeneral').textContent = mensaje;
    }

    function desactivarBoton() {
        document.getElementById('submit-button').disabled = true;
    }

    function activarBoton() {
        document.getElementById('submit-button').disabled = false;
    }
</script>




    </div>
 
</div>

@endsection
