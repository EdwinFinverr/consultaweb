@extends('layout.appcliente')

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
                    <form method="POST" action="{{ route('actualizarinformacion', with($usuarios)) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-6">
                            <label for="folio">Folio</label>
                            <input type="text" class="form-control" id="folio" name="folio"
                                value="{{ $datos->rfc }}">
                        </div>


                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
