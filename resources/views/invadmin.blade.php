@extends('layout.apps')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <h2><img src="{{ asset('img/Recurso%20210siibal-.png') }}" style="width: 300px;"></h2>
                    <form class="form-inline ml-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-responsive" style="margin-left: 100px;">
                        <thead style="border-top: 5px solid rgb(0,121,198); background: #D1DDE5;">
                            <tr>
                                <th scope="col" style="text-align: center;">Folio</th>
                                <th scope="col" style="text-align: center;">Cantidad</th>
                                <th scope="col" style="text-align: center;">Cuenta</th>
                                <th scope="col" style="text-align: center;">Fecha Inicio</th>
                                <th scope="col" style="text-align: center;">Fecha Termio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inversiones as $inversion)
                                <tr>
                                    <td style="text-align: center;">{{ $inversion->folio }}</td>
                                    <td style="text-align: center;">{{ $inversion->cantidad }}</td>
                                    <td style="text-align: center;">{{ $inversion->cuenta_transferencia }}</td>
                                    <td style="text-align: center;">{{ $inversion->fecha_inicio }}</td>
                                    <td style="text-align: center;">{{ $inversion->fecha_termino }}</td>
                                </tr>
                            @endforeach
                    </table>
                    {{ $inversiones->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
