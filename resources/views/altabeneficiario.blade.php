@extends('layout.appcliente')

@section('content')
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
    <br>

    </div>


    <div class="container">
        <div id="progress">
            <div class="part on">
                <div class="desc"><a href="/registro/lobby" style="color: black"><span>Home</span></div>
                <div class="circle"><span>1</span></div>
            </div>
            <div class="part on">
                <div class="desc"><span>Beneficiario</span></div>
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
    <br>
    <div class="col-md-8 col-xl-6 text-center mx-auto">
    <p>Para registrar los beneficiarios, has clic en el botón "Añadir Beneficiario". Ten en cuenta que puedes registrar un máximo de 4 beneficiarios.
                                    </p>
    </div>
    <div class="container">
    <div style="padding-top: 50px;"><a data-toggle="modal" data-target="#exampleModal"
                        style="color: white;"><img src="{{ asset('img/Recurso 238siibal-.png') }}"
                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                    <div class="modal fade" id="#agregarUsuario" tabindex="-1" role="dialog"
                        aria-label="exampleModalLabel" aria>
                        <div class="modal-dialog" role="document">
                        
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-tittle" id="impleModalLabel">
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="">
                                        <span aria-label="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
    </div>
<br>
<br>
<br>
<br>
<form method="POST" action="{{ route('save_data') }}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row my-2">
                    <div class="col-12">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <div>
                                <p>Por favor, selecciona uno o más beneficiarios para tu inversión actual. Asegúrate de que la suma de los porcentajes asignados a cada beneficiario sea equivalente al 100%.</p>
                                <input type="hidden" id="total-inputs" value="0">
                            </div>
                        </div>

                        <div class="table-responsive d-flex flex-column justify-content-center align-items-center">
                            <table id="tabla-suma" class="table" style="background: rgba(209, 209, 209, 0); border-style: none;">
                                <thead class="tablas" style="border-style: none; background: rgb(16, 41, 64); color: rgb(255, 255, 255);">
                                    <tr>
                                        <th scope="col" style="text-align: center">Nombre</th>
                                        <th scope="col" style="text-align: center">Apellido (s)</th>
                                        <th scope="col" style="text-align: center">Parentesco</th>
                                        <th scope="col" style="text-align: center">Edad</th>
                                        <th scope="col" style="text-align: center">Porcentaje</th>
                                    </tr>
                                </thead>
                                <tbody style="border-style: none;">
                                    @foreach ($beneficiarios as $beneficiario)
                                        <tr>
                                            <td style="text-align: center">{{ $beneficiario->name }}</td>
                                            <td style="text-align: center">{{ $beneficiario->lastName }}</td>
                                            <td style="text-align: center">{{ $beneficiario->relationship }}</td>
                                            <td style="text-align: center">{{ $beneficiario->edad }}</td>
                                            <td style="text-align: center">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text icon-container" style="background: rgb(16,41,64);">
                                                                <i style="color: rgb(255,255,255);">%</i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control mi-input"
                                                            name="porcentaje[{{ $beneficiario->id }}]" placeholder="Porcentaje"
                                                            style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; text-align: center;"
                                                            pattern="[0-9]+" max="100" step="1"
                                                            onchange="SumarAutomatico(this.value);" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $beneficiarios->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <div>
                        <span id="porcentaje"></span><br>
                        <span id="percentagemal"></span>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn save_btn" type="submit" id="submit-btn" disabled>
                                <img src="{{ asset('img/Recurso%20226siibal-.png') }}"
                                    style="background: left / contain no-repeat, rgba(13,110,253,0); border-style: none; height: 45px; border-radius: 0;">
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

    <br>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="border-style: none; ">
                <div class="modal-dialog" style="border-style: none; ">
                    <div class="modal-content" style="border-style: none; ">
                        <div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="font-size: 80px;   position: relative;
                                right: 30px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <div class="modal-header" style="border-style: none;">
                        <h2><img src="{{ asset('img/Recurso%2088siibal-.png') }}" style="width: 300px;;"></h2>
                    </div>
                    <div class="modal-body" style="border-style: none;">
                      
                    <form action="{{ route('postBeneficiario') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
        <span class="red" style="padding-left: 630px; color: red;">*</span>
        <input type="text" class="form-control" name="nombreBeneficiario" id="nameInput" placeholder="Nombre (s)"
            style="border-radius: 10px;">
    </div>
    <div class="form-group">
        <span class="red" style="padding-left: 630px; color: red;">*</span>
        <input type="text" class="form-control" name="apellidoBeneficiario" id="lastNameInput" placeholder="Apellido (s)"
            style="border-radius: 10px;">
    </div>
    <div class="form-group">
        <span class="red" style="padding-left: 630px; color: red;">*</span>
        <input type="text" class="form-control" name="edadBeneficiario" id="edadInput" placeholder="Edad" 
            style="border-radius: 10px;" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
    </div>

    <script>
        document.getElementById("nameInput").addEventListener("input", function() {
            this.value = this.value.toUpperCase();
        });
        document.getElementById("nameInput").addEventListener("input", function() {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
        });
        document.getElementById("lastNameInput").addEventListener("input", function() {
            this.value = this.value.toUpperCase();
        });
        document.getElementById("lastNameInput").addEventListener("input", function() {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
        });
    </script>

    <div class="form-group">
        <div class="mb-3">
            <span class="red" style="padding-left: 630px; color: red;">*</span>
            <select class="form-control" name="parentescoBeneficiario" id="parentescoInput">
                <option value="" disabled selected hidden>Parentesco</option>
                <option>Madre</option>
                <option>Padre</option>
                <option>Esposo (a)</option>
                <option>Concubino (a)</option>
                <option>Hijo (a)</option>
                <option>Hermano (a)</option>
                <option>Otros</option>
            </select>
        </div>
        <div class="form-group" id="otrosInputGroup" style="display: none;">
            <span class="red" style="padding-left: 630px; color: red;">*</span>
            <input type="text" class="form-control" name="especificarOtros" id="especificarOtrosInput" placeholder="Especifique" 
                style="border-radius: 10px;">
        </div>
    </div>

    <button class="btn btn-primary d-block w-100" type="submit" id="beneficiario" disabled
        style="background: url(&quot;assets/img/Recurso%2043siibal-.png&quot;) left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;">
        <img src="{{ asset('img/agregar.png') }}"
            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;">
    </button>
    <br>
    <span id="mensajebene" style="color: red"></span>

    <script>
        const name = document.getElementById('nameInput');
        const lastname = document.getElementById('lastNameInput');
        const parentesco = document.getElementById('parentescoInput');
        const edad = document.getElementById('edadInput');
        const submitneficiario = document.getElementById('beneficiario');
        const mensajeben = document.getElementById("mensajebene");
        const otrosInputGroup = document.getElementById('otrosInputGroup');
        const especificarOtrosInput = document.getElementById('especificarOtrosInput');

        // Mostrar el campo para especificar "Otros" si "Otros" es seleccionado
        parentesco.addEventListener('change', function() {
            if (this.value === 'Otros') {
                otrosInputGroup.style.display = 'block';
            } else {
                otrosInputGroup.style.display = 'none';
                especificarOtrosInput.value = ''; // Limpiar el campo si se oculta
            }
            checkInputs(); // Revisa los inputs cada vez que cambie el parentesco
        });

        // Función para comprobar si todos los campos están llenos y si la edad es válida
        function checkInputs() {
            const edadValue = edad.value.trim(); // Obtén el valor de edad sin espacios en blanco
            const especificarOtrosValue = especificarOtrosInput.value.trim(); // Obtén el valor de "especificar otros"
            const isOtrosSelected = parentesco.value === 'Otros';

            if (name.value !== '' && lastname.value !== '' && edadValue !== '' && parentesco.value !== '' && (!isOtrosSelected || especificarOtrosValue !== '')) {
                if (!isNaN(edadValue)) { // Verifica si la edad es un número
                    if (parseInt(edadValue) >= 18) { // Verifica si la edad es mayor o igual a 18
                        submitneficiario.disabled = false; // Activa el botón
                        mensajeben.textContent = ""; // Limpia el mensaje de error
                    } else {
                        submitneficiario.disabled = true; // Desactiva el botón
                        mensajeben.textContent = "La edad debe ser mayor o igual a 18 años"; // Muestra el mensaje de error
                    }
                } else {
                    submitneficiario.disabled = true; // Desactiva el botón
                    mensajeben.textContent = "La edad debe ser un número válido"; // Muestra el mensaje de error
                }
            } else {
                submitneficiario.disabled = true; // Desactiva el botón
                mensajeben.textContent = "Por favor complete todos los campos"; // Muestra el mensaje de error
            }
        }

        // Agrega el evento 'input' a los inputs para comprobar continuamente
        name.addEventListener('input', checkInputs);
        lastname.addEventListener('input', checkInputs);
        edad.addEventListener('input', checkInputs);
        parentesco.addEventListener('change', checkInputs);
        especificarOtrosInput.addEventListener('input', checkInputs);
    </script>
</form>


                        </div>
                        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                        <div class="modal-footer">

                        </div>

                    </div>
                </div>
            </div>
    <script type="text/javascript">
        /* Funcion suma. */
        const porcentajeSpan = document.querySelector('#porcentaje');
        const porcentajemal = document.querySelector('#percentagemal');





        $(document).ready(function() {
            var total = 0;

            // Función para sumar los valores de los inputs y mostrar el porcentaje
            function sumar() {
                total = 0;
                $("input[type='number']").each(function() {
                    var valor = $(this).val() ? parseFloat($(this).val()) : 0;
                    total += valor;
                });
                $("#porcentaje").text(total + "%");
                if (total > 100) {
                    $("#porcentaje").css("color", "red");
                    $('#percentagemal').text('El total no puede ser mayor a 100').css("color", "red");
                } else
                if (total < 100) {
                    $("#porcentaje").css("color", "red");
                    $('#percentagemal').text('El total no puede ser menor a 100').css("color", "red");
                } else {
                    $('#percentagemal').text('');
                    $("#porcentaje").css("color", "black");
                }
                habilitarBoton();
            }

            // Función para habilitar o deshabilitar el botón según el valor de total
            function habilitarBoton() {
                if (total == 100) {
                    $("#submit-btn").prop("disabled", false);
                } else {
                    $("#submit-btn").prop("disabled", true);
                }
            }

            // Detectar cambios en los inputs
            $("input[type='number']").on("input", function() {
                sumar();
            });

            // Detectar cambios en el checkbox

            // Resetear automáticamente la suma cuando se borra un input
            $("input[type='number']").on("keyup", function() {
                if ($(this).val() == "") {
                    $(this).val();
                }
                sumar();
            });
        });
    </script>

    <script></script>


    <script src="{{ 'https://code.jquery.com/jquery-3.5.1.js' }}"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

@endsection
