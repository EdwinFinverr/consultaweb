@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center my-3 display-2"> Usuario </h3>
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
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Subir documentos
                                    </button>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-signin" action="{{ Route('update', [$usuario->user_id]) }}" method="POST"
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
                        <div class="form-label-group">
                            <input type="file" style="overflow: hidden !important" name="idphoto" required />
                            <label for="idphoto">Selecciona una imagen de tu IFE,INE( Parte delantera)</label>
                        </div>
                        <div class="form-label-group">
                            <input type="file" style="overflow: hidden !important" class="form-control-file"
                                name="idphotoback" required />
                            <label for="idphoto">Selecciona una imagen de tu IFE,INE(Parte trasera)</label>
                        </div>
                        <div class="form-label-group">
                            <input type="file" style="overflow: hidden !important" class="form-control-file"
                                name="addressphoto" required />
                            <label for="addressphoto">Selecciona una imagen de un comprobante de domicilio </label>
                        </div>
                        <hr>
                        <div>

                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"
                            value="Upload">Subir</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
