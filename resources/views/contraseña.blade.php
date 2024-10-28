@extends('layout.appss')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cambiar Contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cambiar-contrasena') }}">
                        @csrf

                        <div class="form-group">
                            <label for="password">{{ __('Nueva Contraseña') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Cambiar Contraseña') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
