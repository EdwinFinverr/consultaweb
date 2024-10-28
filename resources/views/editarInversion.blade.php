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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="container">

                    <h3 class="text-center my-3 display-2"> Actualizar inversión </h3>
                    <form method="POST" action="{{ route('actualizarInversion', with($inversion)) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="folio">Folio</label>
                                <input type="text" class="form-control" id="folio" name="folio"
                                    value="{{ $inversion->folio }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cantidad">Monto invertido</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad"
                                    value="{{ $inversion->cantidad }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tasa_mensual">Tasa de porcentaje</label>
                                <input type="text" class="form-control" id="tasa_mensual" name="tasa_mensual"
                                    value="{{ $inversion->tasa_mensual }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cuenta_pago_rendimientos">Cuenta pago de rendimientos</label>
                                <input type="text" class="form-control" id="cuenta_pago_rendimientos"
                                    name="cuenta_pago_rendimientos" value="{{ $inversion->cuenta_pago_rendimientos}}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                    value="{{ $inversion->fecha_inicio }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fecha_termino">Fecha de término</label>
                                <input type="date" class="form-control" id="fecha_termino" name="fecha_termino"
                                    value="{{ $inversion->fecha_termino }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputState">Empresa</label>
                                <select id="inputState" class="form-control" name="empresa_inversion_id"
                                    placeholder="{{ $inversion->empresa_inversion_id }}"
                                    style=";border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    @foreach ($empresas as $empresa)
                                        <option {{ $inversion->empresa_inversion_id == $empresa->id ? 'selected' : '' }}
                                            value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Contratos</label>
                                <select id="inputState" class="form-control" name="contrato_inversion_id"
                                    placeholder="{{ $inversion->contrato_inversion_id }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    @foreach ($contratos as $contrato)
                                        <option {{ $inversion->contrato_inversion_id == $contrato->id ? 'selected' : '' }}
                                            value="{{ $contrato->id }}">{{ $contrato->tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Estado inversion</label>
                                <select id="inputState" class="form-control" name="estado_inversion_id"
                                    placeholder="{{ $inversion->estado_inversion_id }}"
                                    style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    @foreach ($estados as $estado)
                                        <option {{ $inversion->estado_inversion_id == $estado->id ? 'selected' : '' }}
                                            value="{{ $estado->id }}">{{ $estado->estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
