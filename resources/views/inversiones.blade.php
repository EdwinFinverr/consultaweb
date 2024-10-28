@extends('layout.appcliente')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="p-2"><a href="{{ Route('lobby') }}" class="btn btn-outline-secondary">Atrás</a></div>
        </div>
        @include('inc.partials.get-inversiones')
    </div>
@endsection
