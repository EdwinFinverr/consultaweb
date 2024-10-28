@extends('layouts.app')

@section('content')
    <h1>Cambio de Contraseña</h1>

    @if (session('passwordUpdate'))
        <!-- Mostrar el formulario de cambio de contraseña aquí -->
        <form action="{{ route('guardar-contrasena') }}" method="POST">
            @csrf

            <!-- Campos del formulario (nueva contraseña, confirmación, etc.) -->

            <button type="submit">Guardar Contraseña</button>
        </form>
    @else
        <p>No se ha solicitado cambio de contraseña.</p>
    @endif
@endsection
