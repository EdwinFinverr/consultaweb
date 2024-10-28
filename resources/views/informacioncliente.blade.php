@extends('layout.appss')

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
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2><img src="{{ asset('img/Recurso%20193siibal-.png') }}" style="width: 300px;"></h2>

                </div>
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
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
                            <th scope="col"></th>

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
                                <td style="text-align: center;"> {{ $usuario->birthday }}</td>
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
                                        <a class="dropdown-item" href="{{ Route('documentacionase', [$usuario->user_id]) }}"><img
                                                                src="{{ asset('img/Recurso%20219siibal-.png') }}"
                                                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                        <a class="dropdown-item" href="{{ Route('clienteData', [$usuario->user_id]) }}"><img
                                                            src="{{ asset('img/Recurso%20220siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>

                                        </div>
                                    </div>
                                    
                                </td>
                        @endforeach
                    </tbody>
                </table>
                {{ $usuarios->links() }}
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="border-style: none;">
                <div class="modal-dialog" style="border-style: none;">
                    <div class="modal-content" style="border-style: none; ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <form class="form-signin" action="{{ url('postRegistrationClienteAsesor') }}"
                                    method="POST" id="regForm" enctype="multipart/form-data">
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
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <div><img></div>
                                    <h2><img src="{{ asset('img/Recurso%20189siibal-.png') }}" style="width: 500px;">
                                    </h2>
                                    <div class="mb-3"><input value="{{ old('name') }}" type="text" name="name"
                                            id="inputNombre" placeholder="Nombre(s)"
                                            style="background: #D1DDE5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border: 1px none #c1d7e5;width: 300px;height: 40px;">
                                    </div>
                                    <div class="mb-3"><input value="{{ old('lastName') }}" type="text"
                                            id="inputApellidos" placeholder="Apellido(s)" name="lastName" required autofocus
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                                    </div>
                                    <div class="mb-3"><input value="{{ old('email') }}" type="email" id="inputEmail"
                                            placeholder="Correo electronico" name="email" required
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                                    </div>
                                    <div class="mb-3">
                                        @foreach ($usuarios as $usuario)
                                            <input type="text" id="asesor" name="asesor"
                                                style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;"
                                                value="{{ $usuario->clave_asesor }}">
                                        @endforeach
                                    </div>

                                    <div class="mb-3"><input type="password" id="inputPassword"
                                            placeholder="Contraseña" name="password" required
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                                    </div>
                                    <div class="mb-3"><input type="password" id="inputConfirmPassword"
                                            name="password_confirmation" placeholder="Confirmar contraseña" required
                                            style="background: #d1dde5;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-width: 1px;border-style: none;width: 300px;height: 40px;">
                                    </div>
                                    <div><button class="btn btn-primary" type="submit" value="Upload"
                                            style="border-style: none;background: url(&quot;img/Recurso%20191siibal-.png&quot;) top / contain no-repeat;width: 588px;height: 45px;"></button>
                                    </div>
                            </div>
                            </form>
                        </div>
                        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
