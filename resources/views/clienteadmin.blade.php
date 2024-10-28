@extends('layout.apps')

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
                <div style="padding-top: 50px;"><a data-toggle="modal" data-target="#exampleModal"
                        style="color: white;"><img src="{{ asset('img/Recurso%20218siibal-.png') }}"
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
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2><img src="{{ asset('img/Recurso%20193siibal-.png') }}" style="width: 300px;"></h2>

                </div>
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search"
                            aria-label="Search"
                            style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <table>
                    <thead style="border-top: 5px solid rgb(0,121,198); background: #D1DDE5;">
                        <tr>
                            <th scope="col" style="text-align: center;">Nombre</th>
                            <th scope="col" style="text-align: center;">Correo</th>
                            <th scope="col" style="text-align: center;">Clave asesor</th>
                            <th scope="col" style="text-align: center;">Télefono</th>
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
                                <td style="text-align: center;">{{ $usuario->asesor }}</td>
                                <td style="text-align: center;">{{ $usuario->telephone }}</td>
                                <td style="text-align: center;">
                                    {{ $usuario->birthday }} </td>
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
                                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="{{ asset('img/Recurso%20228siibal-.png') }}"
                                                    style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                        <div class="dropdown-menu border-light m-0">
                                            <a class="dropdown-item"><div class="d-flex flex-grow-1 justify-content-center">
                                                        <a href="{{ Route('documentacion', [$usuario->user_id]) }}"><img
                                                                src="{{ asset('img/Recurso%20219siibal-.png') }}"
                                                                style="padding-right: 60px; background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                    </div></a>
                                            <a  class="dropdown-item" style="padding-left: 25px;">
                                                <form action="{{ Route('aprobado', [$usuario->id]) }}" method="POST"
                                                        style="border-style: none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" value="Upload"
                                                            style="border-style: none; background: rgba(255,255,255,0)"><img
                                                                src="{{ asset('img/Recurso%20227siibal-.png') }}"
                                                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></button>
                                                    </form></a>
                                            <a class="dropdown-item"><button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal2-{{ $usuario->id }}"
                                                        style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "><img
                                                            src="{{ asset('img/Recurso%20229siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></button></a>
                                            <a  class="dropdown-item" > <a href="{{ Route('userData', [$usuario->user_id]) }}" style="padding-left: 30px;"><img
                                                            src="{{ asset('img/Recurso%20220siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a></a>
                                            <a  class="dropdown-item"><div class="d-flex flex-grow-1 justify-content-center">
                                                        <a href="{{ Route('infoclienteadm', [$usuario->user_id]) }}"><img
                                                                src="{{ asset('img/Recurso%20246siibal-.png') }}"
                                                                style="padding-right: 65px;background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                    </div></a>
                                        </div>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
                {{ $usuarios->links() }}
            </div>
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
                                <form class="form-signin" action="{{ url('postRegistrationCliente') }}" method="POST"
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
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <h2><img src="{{ asset('img/Recurso%20189siibal-.png') }}" style="width: 250px;">
                                    </h2>
                                    <div class="mb-3"><span clase="red"
                                            style=" color: red; font-size: 25px;">*</span><input 
                                            value="{{ old('name') }}" type="text" name="name" id="inputNombre"
                                            placeholder="Nombre (s)"
                                            style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;width: 250px;height: 40px;">
                                    </div>
                                    <div class="mb-3"><span clase="red"
                                            style="  color: red;font-size: 25px;">*</span><input
                                            value="{{ old('lastName') }}" type="text" id="inputApellidos"
                                            placeholder="Apellido (s)" name="lastName" required autofocus
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 250px;height: 40px;">
                                    </div>
                                    <div class="mb-3"><span clase="red"
                                            style="  color: red;font-size: 25px;">*</span><input
                                            value="{{ old('email') }}" type="email" id="inputEmail"
                                            placeholder="Correo electrónico" name="email" required
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 250px;height: 40px;">
                                    </div>

                                    <div><button class="btn btn-primary" type="submit" value="Upload" disabled
                                            id="submit-btn"
                                            style="border-style: none;background: none;width: 300px;height: 45px;">
                                            <img src="{{ asset('img/Recurso%20191siibal-.png') }}" style="width: 588px%; height: 45px;"></button>
                                    </div>
                                    <span id="mensaje" style="color: red"></span>
                                    <script>
                                        document.getElementById("inputNombre").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                        document.getElementById("inputApellidos").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                        const inputPassword = document.getElementById('inputPassword');
                                        const inputConfirmPassword = document.getElementById('inputConfirmPassword');
                                        const mensaje = document.getElementById('mensaje');
                                        $(document).ready(function() {
                                            $('#inputNombre, #inputApellidos, #inputEmail').on('input',
                                                function() {
                                                    // Verificar si todos los campos de entrada tienen valores
                                                    if ($('#inputNombre').val() && $('#inputApellidos').val() && $('#inputEmail').val()) {
                                                        // Habilitar el botón
                                                        $('#submit-btn').prop('disabled', false);
                                                    } else {
                                                        // Deshabilitar el botón
                                                        $('#submit-btn').prop('disabled', true);
                                                    }
                                                });
                                        });
                                    </script>
                            </div>

                            </form>
                        </div>
                        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                        <div class="modal-footer">

                        </div>

                    </div>
                </div>
            </div>
            @foreach ($usuarios as $usuario)
                <div class="modal fade" id="exampleModal2-{{ $usuario->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Desaprobado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ Route('desaprobar', [$usuario->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <label for="reason">Razón de desaprobación:</label>
                                    <select name="reason" id="reason" >
                                        <option value="1">Mala calidad</option>
                                        <option value="2">No es el documento correcto</option>
                                        <option value="3">Falta documentacion</option>
                                        <!-- Agrega más opciones aquí según sea necesario -->
                                    </select>

                                    <label for="comments">Comentarios adicionales:</label>
                                    <br>
                                    <textarea name="comments" id="comments" style="width: 250px;height: 100px;"></textarea>

                                    <input type="hidden" name="user_id" value="{{ $usuario->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @endsection
    </div>
</div>
