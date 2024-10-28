@extends('layout.appss')


@section('content')
    <div class="container-fluid min-vh-100">
        <div class="d-flex justify-content-around align-items-center flex-grow-1 flex-wrap">
            <div class="row row-cols-2">
                @forelse($fotos as $foto)
                    <div class="col d-flex justify-content-center">


                        <div class="card mx-5 my-5" style="width: 20rem;">
                            <p>{{ $foto->path }}</p>
                            @if (pathinfo($foto->path, PATHINFO_EXTENSION) === 'pdf')
                                <embed class="embed-responsive-item" src="{{ asset($foto->path) }}" type="application/pdf"
                                    width="100%" height="600px">
                                <a href="{{ asset($foto->path) }}" download="{{ $foto->path }}">Descargar PDF</a>
                            @else
                                <img class="card-img-top" src="{{ asset($foto->path) }}" alt="img-usuario">
                            @endif
                            <form action="{{ route('eliminar.foto', $foto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                            </form>
                        </div>



                    </div>
                @empty
                    <p> Usuario sin fotos, previo o previo a actualizacion</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
