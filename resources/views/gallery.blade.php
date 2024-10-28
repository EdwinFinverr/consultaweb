@extends('layout.appcliente')

@section('content')
    <div class="container-fluid min-vh-100">
        <div class="d-flex justify-content-around align-items-center flex-grow-1 flex-wrap">
            <div class="row row-cols-2">
                @forelse($fotos as $foto)
                    <div class="col d-flex justify-content-center">
                        <div class="card mx-5 my-5" style="width: 20rem;">
                            @php
                                $path = $foto->path;
                                $name = '';

                                if (strpos($path, 'Id') !== false) {
                                    $name = 'Identificación Oficial';
                                } elseif (strpos($path, 'Back') !== false) {
                                    $name = 'Identificación Oficial Trasera';
                                } elseif (strpos($path, 'address') !== false) {
                                    $name = 'Domicilio';
                                } elseif (strpos($path, 'fiscal') !== false) {
                                    $name = 'Situación Fiscal';
                                } elseif (strpos($path, 'estado') !== false) {
                                    $name = 'Estado de Cuenta';
                                } elseif (strpos($path, 'Comprobante') !== false) {
                                    $name = 'Comprobante de Pago';
                                } elseif (strpos($path, 'CFDI') !== false) {
                                    $name = 'CFDI';
                                } elseif (strpos($path, 'procedencia') !== false) {
                                    $name = 'Procedencia';
                                }
                            @endphp

                            <p>{{ $name }}</p>
                            
                            @if (pathinfo($path, PATHINFO_EXTENSION) === 'pdf')
                                <!-- Mostrar PDF usando la etiqueta <embed> -->
                                <embed class="embed-responsive-item" src="{{ asset($path) }}" type="application/pdf" width="100%" height="600px">
                                <!-- Proporcionar un enlace de descarga para el PDF -->
                                <a href="{{ asset($path) }}" download="{{ $path }}">Descargar PDF</a>
                            @else
                                <!-- Mostrar imagen usando la etiqueta <img> -->
                                <img class="card-img-top" src="{{ asset($path) }}" alt="img-usuario">
                                <!-- Proporcionar un enlace de descarga en formato PDF -->
                                <a href="{{ asset($path) }}" download="{{ $path }}">Descargar PDF</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>Usuario sin fotos, previo o previo a actualización</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
