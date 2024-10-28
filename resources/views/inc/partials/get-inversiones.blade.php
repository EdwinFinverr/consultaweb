<div class="col-12">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3" style="min-height: 75vh;">
        @forelse ($inversionesActivas as $inversion)
            @if ($inversion->estado_inversion_id !== 2 && $inversion->estado_inversion_id !== 3 && $inversion->estado_inversion_id !== 10)
                <div class="col ">
                    <div class="card  {{ $inversion->estado_inversion_id == 4 || $inversion->estado_inversion_id == 5 ? 'border-danger' : 'border-secondary' }} my-3"
                        style="height: 70vh;">
                        <div class="card-header text-center">Folio:
                        @if ($inversion->pre_folio_estado)
                             MOD {{ $inversion->pre_folio }}
                        @else
                            P{{ $inversion->empresa_inversion_id == 1 ? 'C' : 'F' }} - {{ $inversion->folio }}
                        @endif</div>
                        <div class="card-body text-secondary text-center  d-flex flex-column justify-content-around">
                            <h2 class="card-title text-primary">{{ $inversion->cantidad }}</h2>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Vigencia: <br> Desde
                                    {{ \Carbon\Carbon::parse($inversion->fecha_inicio)->format('d/m/Y') }}
                                </li>
                                <li
                                    class="list-group-item {{ $inversion->estado_inversion_id == 4 ? 'text-danger' : ' ' }}">
                                    Hasta {{ \Carbon\Carbon::parse($inversion->fecha_termino)->format('d/m/Y') }}</li>
                                <li class="list-group-item">
                                    @if ($inversion->contrato_inversion_id == 1)
                                        <a href="{{ route('customerControl.printpdf', [$inversion->id]) }}"
                                            target="_blank" class="btn btn-outline-secondary"
                                            style="border-style: none;"><img
                                                src="{{ asset('img/Recurso%20129siibal-.png') }}"
                                                style="background: top / contain no-repeat, rgba(13,110,253,0);width: 150px;height:
                                    50px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius:
                                    0px;border-style: none;"></a>
                                    @elseif ($inversion->contrato_inversion_id == 2 || 3 || 4)
                                            @if ($inversion->pre_folio_estado == 'si')
                                                    <a href="{{ route('customer.precontrato', [$inversion->id]) }}"
                                                    target="_blank" class="btn btn-outline-secondary"
                                                    style="border-style: none;"><img
                                                        src="{{ asset('img/precontrato.png') }}"
                                                        style="background: top / contain no-repeat, rgba(13,110,253,0);width: 250px;height:
                                            50px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius:
                                            0px;border-style: none;"></a>
                                                @elseif ($inversion->pre_folio_estado == null)
                                                <a href="{{ route('reinversionControl.pdf', [$inversion->id]) }}"
                                                    target="_blank" class="btn btn-outline-secondary"
                                                    style="border-style: none;"><img
                                                        src="{{ asset('img/Recurso%20129siibal-.png') }}"
                                                        style="background: top / contain no-repeat, rgba(13,110,253,0);width: 150px;height:
                                            50px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius:
                                            0px;border-style: none;"></a>
                                                @endif
                                    @endif
                                </li>
                                @if ($inversion->estado_inversion_id == 4)
                                    <li class="list-group-item">
                                        <a href="{{ route('reinversion', ['id' => $inversion->id]) }}"
                                            class="btn btn-lg btn-block btn-outline-success">Reinvertir</a>
                                        <button type="button" class="btn btn-lg btn-block btn-outline-secondary"
                                            data-toggle="modal" data-target="#modalRetirar">
                                            Retirar Inversión
                                        </button>
                                        <div class="modal fade" id="modalRetirar" tabindex="-1"
                                            aria-labelledby="modalRetirarLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalRetirarLabel">¡Sigue ganando
                                                            con Finverr!
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>¿Estas seguro qué quieres dejar de ganar con Finverr?</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('patchInversion', $inversion->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-outline-secondary">Retirar
                                                                Inversion</button>
                                                        </form>
                                                        <a href="{{ route('reinversion', ['id' => $inversion->id]) }}"
                                                            class="btn btn-primary">Seguir ganando</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                @elseif ($inversion->estado_inversion_id == 5)
                                    <li class="list-group-item">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $inversion->id }}">
                                            </div>
                                            <button type="button" class="btn btn-lg btn-block btn-outline-secondary"
                                                data-toggle="modal" data-target="#modalTransferencia"
                                                style="border-style: none;">
                                                <img src="{{ asset('img/Recurso%20135siibal-.png') }}"
                                                    style="background: top / contain no-repeat, rgba(13,110,253,0);width: 260px;height:
                                                        50px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius:
                                                        0px;border-style: none;">
                                                <br></br>
                                            </button>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-lg btn-block btn-outline-danger" id="abrirModal"
                                                    style="border-style: none;"><img
                                                        src="{{ asset('img/Recurso%20134siibal-.png') }}"
                                                        style="background: top / contain no-repeat, rgba(13,110,253,0);width: 260px;height:
                                        50px;border-top-left-radius: 0px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;border-bottom-left-radius:
                                        0px;border-style: none;"></button>
                                         <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" id="closeModalX" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form method="post" action="{{ route('postProcedencia') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $inversion->id }}">

                                                                <!-- Instrucciones -->
                                                                <div class="alert alert-info" role="alert">
                                                                    <h4 class="alert-heading">Instrucciones para la Carga de Archivos</h4>
                                                                    <p>Para finalizar el proceso, necesitas cargar los comprobantes de transferencia y/o depósito bancario (voucher) y el estado de cuenta que respalde la procedencia de tu capital de inversión. Aquí te dejamos las instrucciones para cada tipo de archivo:</p>
                                                                    
                                                                    <ul>
                                                                        <li><strong>Comprobantes de Transferencia y/o Depósito Bancario:</strong> Estos deben ser los comprobantes de las transferencias o depósitos que realizaste. Asegúrate de que los archivos sean legibles y estén en formatos aceptables (como PDF, JPG, PNG), y que no excedan los 3MB.</li>
                                                                        <li><strong>Estado de Cuenta:</strong> Puedes cargar hasta 3 archivos que deben incluir el estado de cuenta de tu institución financiera, mostrando la clabe interbancaria de 18 dígitos y el origen de los fondos para esta inversión. Verifica que los archivos sean legibles y estén en formatos aceptables (PDF, JPG, PNG), sin exceder los 3MB.</li>
                                                                    </ul>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="comprobantes">Comprobantes de Transferencia y/o Depósito Bancario:</label>
                                                                    <input type="file" id="comprobantes" name="comprobantes[]" multiple class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="estado_cuenta">Estado de cuenta de procedencia de capital (máximo 3 archivos):</label>
                                                                    <input type="file" id="estado_cuenta" name="estado_cuenta[]" multiple class="form-control">
                                                                </div>

                                                                <div class="form-group mt-3">
                                                                    <button id="submit" type="submit" class="btn btn-primary" style="background: none; border: none; padding: 0;">
                                                                        <img src="{{ asset('img/enviar.png') }}" style="background: left / contain no-repeat, rgba(13,110,253,0); border-style: none; height: 45px; border-radius: 0;">
                                                                    </button>
                                                                </div>
                                                            </form>

                                                            <script>
                                                                function validateFile(input, maxSize, allowedTypes) {
                                                                    var files = input.files;
                                                                    if (files.length > 3 && input.id === 'estado_cuenta') {
                                                                        alert('Solo puede subir un máximo de 3 archivos para el Estado de Cuenta.');
                                                                        input.value = ''; // Clear the input
                                                                        return;
                                                                    }
                                                                    for (var i = 0; i < files.length; i++) {
                                                                        var fileType = files[i].type;
                                                                        var fileSize = files[i].size;

                                                                        if (fileSize > maxSize) {
                                                                            alert('El archivo no debe ser mayor de ' + maxSize / 1024 / 1024 + ' MB.');
                                                                            input.value = ''; // Clear the input
                                                                            return;
                                                                        }

                                                                        if (!allowedTypes.includes(fileType)) {
                                                                            alert('El archivo debe ser de tipo: ' + allowedTypes.join(', ') + '.');
                                                                            input.value = ''; // Clear the input
                                                                            return;
                                                                        }
                                                                    }
                                                                }

                                                                $(document).ready(function() {
                                                                    $('#estado_cuenta').on('change', function() {
                                                                        validateFile(this, 3 * 1024 * 1024, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'application/pdf']);
                                                                    });

                                                                    $('#comprobantes').on('change', function() {
                                                                        validateFile(this, 3 * 1024 * 1024, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'application/pdf']);
                                                                    });
                                                                });
                                                                $(document).ready(function() {
                                                                    $('#closeModalBtn').click(function() {
                                                                        $('#mensajeModal').modal('hide');
                                                                    });

                                                                    $('#closeModalX').click(function() {
                                                                        $('#mensajeModal').modal('hide');
                                                                    });
                                                                });
                                                            </script>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" id="closeModalBtn">Cerrar</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="modalTransferencia" tabindex="-1" aria-labelledby="modalTransferenciaLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content border-0" style="width: 5000px">
                                                            <div class="modal-header bg-dark text-white">
                                                                <h3 class="modal-title" id="modalTransferenciaLabel">
                                                                    Realiza tu transferencia
                                                                </h3>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row my-2">
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-bordered">
                                                                                <thead class="thead-dark">
                                                                                    <tr>
                                                                                        <th scope="col">Banco</th>
                                                                                        <th scope="col">No. de Cuenta</th>
                                                                                        <th scope="col">CLABE</th>
                                                                                        <th scope="col">Titular</th>
                                                                                        <th scope="col">Correo</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        @if ($inversion->empresa_inversion_id == 1)
                                                                                        <th scope="row">Santander</th>
                                                                                        <td>65-50738036-8</td>
                                                                                        <td>014010655073803681</td>
                                                                                        <td>CALFKA CAPITAL DISEÑO Y CONSTRUCCIÓN S DE RL DE CV</td>
                                                                                        <td>inversiones@finverr.com</td>
                                                                                        @else
                                                                                        <th scope="row">Santander</th>
                                                                                        <td>65-50604975-6</td>
                                                                                        <td>014010655060497563</td>
                                                                                        <td>FINVERR CORPORATIVO GLOBAL SA de CV</td>
                                                                                        <td>inversiones@finverr.com</td>
                                                                                        @endif
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h4 >
                                                            RECUERDA QUE DEBES CAPTURAR COMO CONCEPTO DE TRANFERENCIA TU NOMBRE COMPLETO
                                                                </h4>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                    </li>
                                @else
                                    @switch($inversion->estado_inversion_id)
                                        @case(8)
                                            <li class="list-group-item text-primary">
                                                <p> Se recibió la solicitud de devolución, recibirás tu dinero 30 dias habiles
                                                    después de finalizar la inversión </p>
                                            </li>
                                        @break

                                        @case(6)
                                            <li class="list-group-item text-primary">
                                                <p> Se recibió la solicitud de Reinversión, tu dinero se reinvertirá al
                                                    finalizar la inversión </p>
                                            </li>
                                        @break

                                        @case(7)
                                            <li class="list-group-item text-primary">
                                                <p> Se recibió la solicitud de Reinversión, tu dinero se reinvertirá al
                                                    finalizar la inversión </p>
                                                <br>
                                                <p> recibirás tu dinero excedente 30 dias habiles después de finalizar la
                                                    inversión </p>
                                            </li>
                                        @break

                                        @default
                                            <li class="list-group-item text-primary">
                                                <p> Se recibió el comprobante </p>
                                            </li>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" style="width: 150px;margin-left: 29%;" data-bs-target="#cancelModal">
                                                Cancelar
                                            </button>
                                    @endswitch
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
                            <h5 class="card-title">Aún no has invertido.</h5>
                            <p class="card-text">¡Invierte aquí para comenzar a ganar!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $inversionesActivas->links() }}
            </div>
        </div>
    </div>
    @foreach ($inversionesActivas as $inversion)
<!-- Modal de confirmación -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Confirmar Cancelación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">

            Lamentamos mucho su decisión, por lo tanto, hacemos de su conocimiento la aplicación
            de la pena convencional estipulada en la cláusula <strong>8.- <u>PENAS CONVENCIONALES.</u></strong> que implica: "30%
            del monto total de la cantidad entregada en mutuo, así como también la cantidad que resulte de la multiplicación de los intereses a 
            razón del <u>{{ $inversion->tasa_mensual }}</u>% sobre la cantidad entregada en mutuo."
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                
                <!-- Formulario de confirmación -->
                <form method="POST" action="{{ route('correocancelar') }}" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary">Sí, cancelar</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endforeach
<script>
        $(document).ready(function () {
        $('#abrirModal').click(function () {
            $('#miModal').modal('show');
        });
    });
</script>
<script>
    document.getElementById('confirmCancel').addEventListener('click', function () {
    // Aquí agregas la funcionalidad de cancelación
    console.log('Acción de cancelación confirmada');
    // Cierra el modal si es necesario
    var cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
    cancelModal.hide();
});

</script>
<style>
/* Estilos para mejorar el aspecto del modal */
.modal-content {
    border-radius: 10px;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

.modal-header {
    background-color: #343a40;
    color: #ffffff;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.modal-header .close {
    color: #ffffff;
}

.table thead {
    background-color: #343a40;
    color: #ffffff;
}

.table tbody tr th, .table tbody tr td {
    vertical-align: middle;
}

/* Centrar el modal */
.modal-dialog-centered {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Ajustar el tamaño del modal para diferentes dispositivos */
@media (max-width: 767.98px) {
    .modal-dialog {
        margin: 10px;
    }
    .modal-lg {
        max-width: 90%;
    }
}

@media (min-width: 768px) {
    .modal-lg {
        max-width: 80%;
    }
}

@media (min-width: 992px) {
    .modal-lg {
        max-width: 70%;
    }
}

@media (min-width: 1200px) {
    .modal-lg {
        max-width: 60%;
    }
}

</style>