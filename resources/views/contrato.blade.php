@extends('layout.appcliente')


@section('content')

    <div class="contrainer my-5">
        <div class="row">
            <div class="col-lg-10 col-xl-10 mx-auto text-center">
                <div class="card">
                    <div class="card-body">
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
                        <h2 class="card-title">Ya casi está listo</h2>
                        <div class="row">
                            <div
                                class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 d-flex flex-column justify-content-center my-3 ">
                                <p class="card-text">A continuación tienes el contrato para tu revisión</p>
                                <a type="submit" href="{{ route('customer.printpdf', Session::get('inversion')) }}"
                                    target="_blank" class="btn btn-outline-secondary">Ver Contrato </a>
                                <form action="{{ route('postContrato') }}" method="post">


                                    @csrf
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="contrato"
                                            id="aceptarContraro">
                                        <label class="form-check-label" for="aceptarContraro">
                                            He leído y acepto los términos y condiciones del contrato
                                        </label>
                                    </div>

                                    <div><img></div>
                                    <button type="submit" class="btn btn-primary my-2"><img
                                            src="{{ asset('img/Recurso%20224siibal-.png') }}"
                                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
