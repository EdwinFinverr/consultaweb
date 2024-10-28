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
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">RFC</th>
                            <th scope="col">Validacion de documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{ $usuario->name . '  ' . $usuario->lastName }}</th>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->address . '  CP :  ' . $usuario->postalcode }}</td>
                                <td>{{ $usuario->telephone }}</td>
                                <td> {{ $usuario->birthday }}</td>
                                <td>{{ $usuario->rfc }}</td>
                                <td>
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
                                            class="btn btn-outline-secondary">Fotos</a>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
