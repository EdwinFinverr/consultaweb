<div class="container" style="min-height: 50vh">
    <div class="row my-3">
        <button type="button" data-toggle="modal" data-target="#Modal-crearEmpresa" class="btn btn-outline-success">Crear
            Empresa</button>
    </div>

    <div class="row row-cols-3">
        @foreach ($empresas as $empresa)
        <div class="col">
            <div class="card {{$empresa->activa ? 'border-success' : 'border-secondary'}} text-center" style="width: 18rem; height: 8rem;">
                <div class="card-body d-flex flex-column justify-content-around">
                    <h5 class="card-title">{{$empresa->nombre}}</h5>
                    @if ( ! $empresa->activa)
                    <button type="button" data-toggle="modal" data-target="#Modal-{{$empresa->id}}"
                        class="btn btn-primary">Activar</button>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal-{{$empresa->id}}" tabindex="-1"
                        aria-labelledby="Modal-{{$empresa->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal-{{$empresa->id}}">{{$empresa->nombre}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p> Seleccionar {{$empresa->nombre}} como empresa principal</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{route('activateEmpresa')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$empresa->id}}">
                                        <button type="submit" class="btn btn-primary">Activar empresa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<div class="modal fade" id="Modal-crearEmpresa" tabindex="-1" aria-labelledby="Modal-crearEmpresa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-crearEmpresa">Crear Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('createEmpresa')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nombre-empresa">Nombre de empresa</label>
                        <input value="{{old('nombre')}}" name="nombre" type="text" class="form-control" id="nombre-empresa"
                            aria-describedby="nombreHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="titular-empresa">Titular de la empresa</label>
                        <input value="{{old('titular')}}" name="titular" type="text" class="form-control" id="titular-empresa"
                            aria-describedby="titularHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="credencial-elector">No. Credencial Elector</label>
                        <input value="{{old('CElector')}}" name="CElector" type="text" class="form-control" id="credencial-elector"
                            aria-describedby="CElectorHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="Fecha-notaria">Fecha de notaria</label>
                        <input value="{{old('FNotaria')}}" name="FNotaria" type="text" class="form-control" id="Fecha-notaria"
                            aria-describedby="FNotariaHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="numero-escritura">Numero Escritura</label>
                        <input value="{{old('NEscritura')}}" name="NEscritura" type="text" class="form-control" id="numero-escritura"
                            aria-describedby="NEscrituraHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="folio-mercantil">Folio mercantil</label>
                        <input value="{{old('FMercantil')}}" name="FMercantil" type="text" class="form-control" id="folio-mercantil"
                            aria-describedby="FMercantilHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="testimonio-notarial">Testimonio notarial</label>
                        <input value="{{old('TNotarial')}}" name="TNotarial" type="text" class="form-control" id="testimonio-notarial"
                            aria-describedby="TNotarialHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="RFC">RFC empresa</label>
                        <input value="{{old('RFCEmpresa')}}" name="RFCEmpresa" type="text" class="form-control" id="RFC"
                            aria-describedby="RFCHelp" required>
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
