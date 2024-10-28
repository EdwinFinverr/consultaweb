@extends('layout.appss')

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
                                    <th scope="col">Clabe</th>
                                    <th scope="col">Fecha de inicio</th>
                                    <th scope="col">Fecha de término</th>
                                    <th scope="col">Acciones</th>
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
                                        <td>{{ $inversion->cuenta_transferencia }}</td>

                                        <td>{{ $inversion->fecha_inicio }}</td>
                                        <td> {{ $inversion->fecha_termino }}</td>
                                        <td>
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="{{ asset('img/Recurso%20228siibal-.png') }}"
                                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                <div class="dropdown-menu border-light m-0">
                                                <a class="dropdown-item" href="{{ Route('verInversion', with($inversion)) }}"><img
                                                                    src="{{ asset('img/Recurso%20235siibal-.png') }}"
                                                                    style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiarios as $beneficiario)
                                    <tr>
                                        <th scope="row">{{ $beneficiario->name . '  ' . $beneficiario->lastName }}</th>
                                        <td>{{ $beneficiario->relationship }}</td>
                                        <td>{{ $beneficiario->percentage }}</td>
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
