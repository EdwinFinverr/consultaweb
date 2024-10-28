@extends('layout.appcliente')

@section('content')
<style>
        body {
            background-image: url('/img/PORTADA-VERIFICACION.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        #cancelacion {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semitransparente */
            padding: 20px;
            margin-top: 70px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

    </style>
<div class="container" id="cancelacion">
    <h2>Verificación de Cancelación</h2>
    <form method="POST" action="{{ route('cancelar.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <button type="submit" class="btn btn-primary">Validar</button>
    </form>
</div>
@endsection

