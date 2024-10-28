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
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row my-2" style="min-height: 50vh;">
                    <div class="col-12">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <div><img></div>
                            <div><img></div>
                            <div><img></div>
                            <div><img></div>
                            <div><img></div>
                            <div><img></div>
                            <h2><img src="{{ asset('img/Recurso%2088siibal-.png') }}" style="width: 250px;;"></h2>
                        </div>
                        <div class="table-responsive d-flex flex-column justify-content-center align-items-center">
                            <table class="table" style="background: rgba(209, 209, 209, 0); border-style: none;">
                                <thead class="tablas"
                                    style="border-style: none; background: rgb(16, 41, 64); color: rgb(255, 255, 255);">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Relación</th>
                                        <th scope="col">Porcentaje</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">ID Inversión</th>
                                    </tr>
                                </thead>
                                <tbody style="border-style: none;">
                                    @foreach ($beneficiarios as $beneficiario)
                                        <tr>
                                            <th scope="row">{{ $beneficiario->name }}</th>
                                            <td>{{ $beneficiario->relationship }}</td>
                                            <td>{{ $beneficiario->porcentaje }}%</td>
                                            <td>{{ $beneficiario->edad }} años</td>
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
    </div>
@endsection
