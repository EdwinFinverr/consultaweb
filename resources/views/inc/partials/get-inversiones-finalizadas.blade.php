<div class="col-12">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3" style="min-height: 75vh;">
        @forelse ($inversionesTerminadas as $inversion)
            @if ($inversion->estado_inversion_id == 3 || $inversion->estado_inversion_id == 10)
                <div class="col">
                    <div class="card border-secondary my-3" style="height: 70vh;">
                        <div class="card-header text-center">Folio:
                            P{{ $inversion->empresa_inversion_id == 1 ? 'C' : 'F' }} - {{ $inversion->folio }}</div>
                        <div class="card-body text-secondary text-center  d-flex flex-column justify-content-around">
                            <h2 class="card-title text-primary"> {{ $inversion->cantidad }}</h2>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Vigencia: <br> Desde
                                    {{ \Carbon\Carbon::parse($inversion->fecha_inicio)->format('d/m/Y') }}
                                </li>
                                <li class="list-group-item">
                                    Hasta {{ \Carbon\Carbon::parse($inversion->fecha_termino)->format('d/m/Y') }}</li>
                                <li class="list-group-item">
                                    @if ($inversion->contrato_inversion_id == 1)
                                        <a href="{{ route('customerControl.printpdf', [$inversion->id]) }}"
                                            target="_blank" class="btn btn-outline-secondary">Contrato</a>
                                    @elseif ($inversion->contrato_inversion_id == 2 || 3 || 4)
                                        <a href="{{ route('reinversionControl.pdf', $inversion->id) }}" target="_blank"
                                            class="btn btn-outline-secondary">Contrato</a>
                                    @elseif($inversion->contrato_inversion_id == 5)
                                        <a href="{{ route('reinversionControl.pdf', $inversion->id) }}" target="_blank"
                                            class="btn btn-outline-secondary">Contrato</a>
                                    @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="container" style="min-height: 40vh;">
                <div class="card bg-dark text-white">
                    <img src="https://images.unsplash.com/photo-1593642532400-2682810df593?ixid=MXwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        class="card-img"
                        alt="https://images.unsplash.com/photo-1593642532400-2682810df593?ixid=MXwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        style="opacity: 0.4; ">
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title">Aún no hay inversiones pendientes.</h5>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $inversionesTerminadas->links() }}
        </div>
    </div>
</div>
