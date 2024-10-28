@extends('layout.appcliente')

@section('content')
<style>
        /* Estilos generales para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        /* Cambia la apariencia de la tabla en pantallas pequeñas */
        @media screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }

            th, td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            th {
                text-align: center;
            }

            /* Agregar estilos para resaltar encabezados */
            th:nth-child(1), td:nth-child(1) {
                background-color: #f2f2f2;
                font-weight: bold;
            }
        }

        /* Estilo para el encabezado pegajoso en pantallas largas */
        @media screen and (min-width: 768px) {
            th {
                position: sticky;
                top: 0;
                background-color: #f2f2f2;
            }
        }
        .modal-content {
    /* Tus estilos personalizados aquí */
    /* Por ejemplo, puedes establecer todos los estilos en sus valores predeterminados */
    width: auto;
    height: auto;
    margin-left: 0;
    /* etc. */
  }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <h2><img src="{{ asset('img/Recurso%20105siibal-.png') }}" style="width: 250px;"></h2>
                </div>
                <table >
                    <thead style="border-top: 5px solid rgb(0,121,198); background: #D1DDE5;">
                        <tr>
                            <th scope="col" style="text-align: center;">Nombre</th>
                            <th scope="col" style="text-align: center;">Correo</th>
                            <th scope="col" style="text-align: center;">Dirección</th>
                            <th scope="col" style="text-align: center;">Teléfono</th>
                            <th scope="col" style="text-align: center;">Fecha de Nacimiento</th>
                            <th scope="col" style="text-align: center;">RFC</th>
                            <th scope="col" style="text-align: center;">Validación de documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <th scope="row" style="text-align: center;">
                                    {{ $usuario->name . '  ' . $usuario->lastName }}</th>
                                <td style="text-align: center;">{{ $usuario->email }}</td>
                                <td style="text-align: center;">{{ $usuario->address . '  CP :  ' . $usuario->postalcode }}
                                </td>
                                <td style="text-align: center;">{{ $usuario->telephone }}</td>
                                <td style="text-align: center;">
                                    {{ $usuario->birthday }}</td>
                                <td style="text-align: center;">{{ $usuario->rfc }}</td>
                                <td style="text-align: center;">
                                    @if ($usuario->estado_fotos == '1')
                                        Aprobado
                                    @elseif ($usuario->estado_fotos == '2')
                                        Desaprobado
                                    @elseif ($usuario->estado_fotos == '3')
                                        Activa
                                    @elseif ($usuario->estado_fotos == '')
                                        Sin Validar
                                    @endif
                                </td>
                                <td>
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="{{ asset('img/Recurso 228siibal-.png') }}"
                                                    style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                        <div class="dropdown-menu border-light m-0">
                                        <a class="dropdown-item" href="{{ Route('documentacioncliente', [$usuario->user_id]) }}"><img
                                                            src="{{ asset('img/Recurso%20219siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                        <a class="dropdown-item" href="{{ Route('invcliente', [$usuario->user_id]) }}"><img
                                                            src="{{ asset('img/Recurso%20220siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                            
                                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href=""
                                                            style="color: white;"><img
                                                                src="{{ asset('img/Recurso%20221siibal-.png') }}"
                                                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                        <div class="modal fade" id="#agregarUsuario" tabindex="-1"
                                                            role="dialog" aria-label="exampleModalLabel" aria>
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-tittle" id="impleModalLabel">
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="">
                                                                            <span aria-label="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal2" href=""
                                                            style="color: white;"><img
                                                                src="{{ asset('img/cargar nuevo documento.png') }}"
                                                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                        <div class="modal fade" id="#agregarUsuario" tabindex="-1"
                                                            role="dialog" aria-label="exampleModalLabel2" aria>
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-tittle" id="impleModalLabel2">
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="">
                                                                            <span aria-label="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                            <a  class="dropdown-item" href="{{ Route('benfcliente', [$usuario->user_id]) }}"><img
                                                            src="{{ asset('img/Recurso%20222siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                         
                                        </div>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" style="border-style: none;">
                    <div class="modal-dialog" style="border-style: none;">
                        <div class="modal-content" >
                            <div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="font-size: 80px;   position: relative;
                                right: 30px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row mb-5">
                                @foreach ($usuarios as $usuario)
                                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                                        <form method="POST" action="{{ route('updateDatos', [$usuario->id]) }}"
                                            id="regForm" enctype="multipart/form-data">
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
                                                    style="width: 300px;">
                                            </h2>
                                            <div class="mb-3">
                                                
                                                    <span clase="red"
                                                        style=" color: red;">*</span>
                                                    <strong>Dirección</strong><input value="{{ $usuario->address }}"
                                                        type="text" id="inputAddress" class="form-control"
                                                        placeholder="Calle" name="address" 
                                                        style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
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
                                                    style=" color: red;">*</span><input
                                                    value="{{ $usuario->numero_ext }}" type="text" id="inputNumext"
                                                    class="form-control" placeholder="Número Ext." name="numero_ext"
                                                    
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
                                            </div>
                                            <script>
                                                document.getElementById("inputNumext").addEventListener("input", function() {
                                                    this.value = this.value.replace(/[^0-9]/g, '');
                                                });
                                            </script>
                                            <div class="mb-3">
                                                
                                                </span><input value="{{ $usuario->num_int }}" type="text"
                                                    id="inputNumint" class="form-control"
                                                    placeholder="Número Int. (Opcional)" name="numero_int"
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
                                            </div>
                                            <script>
                                                document.getElementById("inputNumint").addEventListener("input", function() {
                                                    this.value = this.value.replace(/[^0-9]/g, '');
                                                });
                                            </script>
                                            <div class="mb-3">
                                                
                                                <span clase="red"
                                                    style="  color: red;">*</span><input
                                                    value="{{ $usuario->colonia }}" type="text" id="inputColonia"
                                                    class="form-control" placeholder="Colonia" name="colonia"
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
                                            </div>
                                            <script>
                                                document.getElementById("inputColonia").addEventListener("input", function() {
                                                    this.value = this.value.toUpperCase();
                                                });
                                            </script>
                                            <div class="mb-3">
                                                
                                                <span clase="red"
                                                    style="  color: red;">*</span><input
                                                    value="{{ $usuario->postalcode }}" type="text" minlength="5"
                                                    maxlength="5" id="inputPostalCode" class="form-control"
                                                    placeholder="Código Postal" name="postalcode" 
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
                                            </div>
                                            <script>
                                                document.getElementById("inputPostalCode").addEventListener("input", function() {
                                                    this.value = this.value.replace(/[^0-9]/g, '');
                                                });
                                            </script>
                                            <div class="mb-3">
                                                
                                                <span clase="red"
                                                    style="  color: red;">*</span><input
                                                    value="{{ $usuario->municipio }}" type="text" id="inputMunicipio"
                                                    class="form-control" placeholder="Municipio" name="municipio"
                                                    
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
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
                                                    style="  color: red;">*</span><input
                                                    value="{{ $usuario->ciudad }}" type="text" id="inputCiudad"
                                                    class="form-control" placeholder="Ciudad" name="ciudad" 
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
                                            </div>
                                            <script>
                                                document.getElementById("inputCiudad").addEventListener("input", function() {
                                                    this.value = this.value.toUpperCase();
                                                });
                                                document.getElementById("inputCiudad").addEventListener("input", function() {
                                                    this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                                });
                                            </script>
                                            <div>
                                                
                                                <span clase="red"
                                                    style="  color: red;">*</span><input
                                                    value="{{ $usuario->telephone }}" type="text" id="inputTelephone"
                                                    class="form-control" placeholder="Teléfono" name="telephone" 
                                                    minlength="10" maxlength="10"
                                                    style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;">
                                            </div>
                                            <script>
                                                document.getElementById("inputTelephone").addEventListener("input", function() {
                                                    this.value = this.value.replace(/[^0-9]/g, '');
                                                });
                                            </script>
                                            <div><img></div>

                                    </div>
                                    <div><button class="btn btn-primary" type="submit" value="Upload"
                                            style="border-style: none;background: url(&quot;img/Recurso%20119siibal-.png&quot;) top / contain no-repeat;width: 300px;height: 100px;"><img
                                                src="{{ asset('img/Recurso%20119siibal-.png') }}"
                                                style="background:rgba(13,110,253,0); width: 200px;height: 60px;"></button>
                                    </div>


                                    </div>
                                    </form>
                                @endforeach
                            </div>
                            <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                    aria-hidden="true" style="border-style: none;">
                    <div class="modal-dialog" style="border-style: none;">
                        <div class="modal-content" style="border-style: none; ">
                            <div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="font-size: 80px;   position: relative;
                                right: 30px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row mb-5">
                                @foreach ($usuarios as $usuario)
                                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                                        <form class="form-signin"
                                            action="{{ Route('updatedocumentos', [$usuario->user_id]) }}" method="POST"
                                            id="regForm" enctype="multipart/form-data">
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
                                            <div><img></div>
                                            <strong>Anexar documentación</strong>
                                            <p style="font-size: 70%">Archivos permitidos (jpeg, png, jpg, gif, pdf) tamaño
                                                máximo 3MB
                                            </p>
                                            <div>
                                                <label for="addImage">Agregar Parte trasera de Identificación
                                                    oficial</label>
                                                <input type="checkbox" id="addImage" name="addImage"
                                                    onchange="toggleImageField()">
                                            </div>
                                            <div class="container">
                                                <div class="row">
                                                    <div>
                                                        <label for="idphoto">Identificación Oficial (INE, pasaporte,
                                                            cédula prof.,
                                                            ambos lados)<span clase="red" style=" color: red;">*</span>
                                                        </label>
                                                        <input type="file" style="overflow: hidden !important; "
                                                            class="form-control-file" name="idphoto" />
                                                    </div>

                                                    <div id="addImageField" style="display: none">
                                                        <div><img></div>
                                                        <div>
                                                            <label for="idphoto">Identificación
                                                                Oficial (Parte
                                                                trasera)</label>
                                                            <input type="file" style="overflow: hidden !important"
                                                                class="form-control-file" name="idphotoback" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"><span clase="red"
                                                            style=" padding-left: 260px; color: red;font-size: 25px;">*</span>
                                                        <select class="form-control" name="identificacion" 
                                                            placeholder="-" id="identificacion">
                                                            <option value="" disabled selected hidden>Identificación
                                                            </option>
                                                            <option>INE</option>
                                                            <option>Pasaporte</option>
                                                            <option>Cedula Profesional</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-md-6"><span clase="red"
                                                            style=" padding-left: 180px; color: red;font-size: 25px;">*</span><input
                                                            type="text" id="numero" placeholder="No."
                                                            name="numero"
                                                            style="background: #d1dde5;border-top-left-radius: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;border-width: 1px;border-style: none;width: 200px;height: 40px;">

                                                    </div>
                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#numero').on('keypress', function(e) {
                                                                var keyCode = e.which;
                                                                if (!(keyCode >= 48 && keyCode <= 57) && // Numeros
                                                                    !(keyCode >= 65 && keyCode <= 90) && // Letras mayúsculas
                                                                    !(keyCode >= 97 && keyCode <= 122)) { // Letras minúsculas
                                                                    e.preventDefault();
                                                                }
                                                            });
                                                        });
                                                        document.getElementById("numero").addEventListener("input", function() {
                                                            this.value = this.value.toUpperCase();
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div><img></div>
                                            <div>
                                                <label for="addressphoto">Imágen de un comprobante de domicilio (luz, gas,
                                                    internet, " no mayor a 3 meses") <span clase="red"
                                                        style=" color: red;">*</span></label>
                                                <input type="file"
                                                    style="overflow: hidden !important; padding-left: 30px;"
                                                    class="form-control-file" name="addressphoto" />

                                            </div>
                                            <div><img></div>
                                            <div>
                                                <label for="fiscalphoto">Constancia de situación fiscal<span
                                                        clase="red" style=" color: red;">*</span></label>
                                                <input type="file"
                                                    style="overflow: hidden !important; padding-left: 30px;"
                                                    class="form-control-file" name="fiscalphoto" />
                                            </div>

                                            <div>
                                                <label for="estadodecuenta">Estado de cuenta<span clase="red"
                                                        style=" color: red;">*</span></label>
                                                <input type="file"
                                                    style="overflow: hidden !important; padding-left: 30px;"
                                                    class="form-control-file" name="estadodecuenta" />
                                            </div>
                                            <hr>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6"> <button class="btn save_btn" type="submit"
                                                            value="Upload" style="">
                                                            <img src="{{ asset('img/Recurso%20226siibal-.png') }}"
                                                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; ">
                                                        </button></div>

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
                                        </form>
                                @endforeach
                            </div>
                            <script src="assets/bootstrap/js/bootstrap.min.js"></script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
