<div class="container" style="min-height: 50vh">
    <div class="row my-3">
        <button type="button" data-toggle="modal" data-target="#Modal-crearEstado" class="btn btn-outline-success">Crear
            estado de inversion</button>
    </div>

    <div class="row row-cols-3">
        @forelse ($estados as $estado)
        <div class="col my-3">
            <div class="card text-center" style="width: 18rem; height: 8rem;">
                <div class="card-body d-flex flex-column justify-content-around">
                    <h5 class="card-title">{{$estado->estado}}</h5>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <div class="card text-center" style="width: 18rem; height: 8rem;">
                <div class="card-body d-flex flex-column justify-content-around">
                    <h5 class="card-title">No Estados de inversión</h5>
                </div>
            </div>
        </div>
        @endforelse
    </div>

</div>
<div class="modal fade" id="Modal-crearEstado" tabindex="-1" aria-labelledby="Modal-crearEstado" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-crearEstado">Crear Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('createEstado')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="estado-empresa">Estado de inversion</label>
                        <input name="estado" type="text" class="form-control" id="estado-empresa"
                            aria-describedby="estadoHelp">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
