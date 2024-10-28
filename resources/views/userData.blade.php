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
                <div class="container">
                    <div class="col">
                        <h3 class="text-center my-3 display-2"> Inversiones </h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Folio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Cuenta</th>

                                    <th scope="col">Fecha de inicio</th>
                                    <th scope="col">Fecha de término</th>
                                    <th scope="col">Estado del contrato</th>
                                    <th scope="col">CFDI</th> <!-- Columna modificada -->
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inversiones as $inversion)
                                    <tr>
                                        <th scope="row">{{ $inversion->id }}</th>
                                        <th>
                                            P{{ $inversion->empresa_inversion_id == 1 ? 'C' : 'F' }}
                                            {{ $inversion->folio }}</th>
                                        <td>{{ $inversion->cantidad }}</td>
                                        <td>{{ $inversion->cuenta_pago_rendimientos }}</td>

                                        <td>{{ $inversion->fecha_inicio }}</td>
                                        <td>{{ $inversion->fecha_termino }}</td>
                                        <td>
                                            @if ($inversion->contratofirmado == 'si')
                                                Contrato firmado
                                            @else
                                                Contrato no firmado
                                            @endif
                                        </td>
                                        <td>{{ $inversion->cfdi }}</td>
                                        <td>
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="{{ asset('img/Recurso%20228siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                <div class="dropdown-menu border-light m-0">
                                                <a class="dropdown-item" href="{{ Route('verInversion', with($inversion)) }}"><img
                                                                    src="{{ asset('img/Recurso%20235siibal-.png') }}"
                                                                    style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                <a class="dropdown-item" href="{{ Route('editarInversion', with($inversion)) }}"><img
                                                                    src="{{ asset('img/Recurso%20223siibal-.png') }}"
                                                                    style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                                    <a class="dropdown-item" href="{{ route('eliminarInversion', $inversion->id) }}"
                                                    onclick="event.preventDefault();
                                                                if (confirm('¿Estás seguro de eliminar esta inversión?')) {
                                                                    document.getElementById('delete-form-{{ $inversion->id }}').submit();
                                                                }">
                                                        <img src="{{ asset('img/Recurso%20234siibal-.png') }}" style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; ">
                                                    </a>

                                                <!-- Formulario para enviar la solicitud de eliminación -->
                                                <form id="delete-form-{{ $inversion->id }}" action="{{ route('eliminarInversion', $inversion->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                </div>
                                            </div>   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="container">
                    <div class="col">
                        <h3 class="text-center my-3 display-2"> Beneficiarios </h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Relación</th>
                                    <th scope="col">Porcentaje</th>
                                    <th scope="col">inversion</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiarios as $beneficiario)
                                    <tr>
                                        <th>{{ $beneficiario->name . '  ' . $beneficiario->lastName }}</th>
                                        <td>{{ $beneficiario->relationship }}</td>
                                        <td>{{ $beneficiario->porcentaje }}</td>
                                        <td>{{ $beneficiario->id_inversion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
