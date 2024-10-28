@extends('layout.apps')

@section('content')
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
                    <h2><img src="{{ asset('img/Recurso%20193siibal-.png') }}" style="width: 300px;"></h2>
                </div>
                <table class="table table-responsive">
                    <thead style="border-top: 5px solid rgb(0,121,198); background: #D1DDE5;">
                        <tr>
                            <th scope="col" style="text-align: center;">Nombre</th>
                            <th scope="col" style="text-align: center;">Correo</th>
                            <th scope="col" style="text-align: center;">Direccion</th>
                            <th scope="col" style="text-align: center;">Telefono</th>
                            <th scope="col" style="text-align: center;">Fecha de Nacimiento</th>
                            <th scope="col" style="text-align: center;">RFC</th>
                            <th scope="col" style="text-align: center;">Validacion de documentos</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
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
                                    <div class="d-flex flex-grow-1 justify-content-center">
                                        <a href="{{ Route('documentacion', [$usuario->user_id]) }}"
                                            class="btn btn-outline-secondary"
                                            style="border-top-left-radius: 15px;
                                            border-top-right-radius: 15px;
                                            border-bottom-right-radius: 15px;
                                            border-bottom-left-radius: 15px;">Fotos</a>
                                    </div>
                                </td>
                                <td>

                                </td>

                                <td>

                                </td>

                                <td>

                                </td>
                                <td>
                                    <a class="btn btn-outline-secondary"
                                        href="{{ Route('informacioninversiones', [$usuario->user_id]) }}"
                                        style="border-top-left-radius: 15px;
                                        border-top-right-radius: 15px;
                                        border-bottom-right-radius: 15px;
                                        border-bottom-left-radius: 15px;
                                        border: 2px solid #072a40;">Inversiones</a>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
