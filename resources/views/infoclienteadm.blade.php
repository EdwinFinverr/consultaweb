@extends('layout.apps')

@section('content')
    <section class="position-relative py-4 py-xl-5">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center" style="border-style: none;">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4" style="width: 650px;border-style: none;">
                    <div class="row mb-5" style="text-align: center;">
                        @foreach ($usuarios as $usuario)
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <form method="POST" action="{{ route('updateDatoscliente', [$usuario->id]) }}"
                                    id="regForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    {{ csrf_field() }}
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
                                    <div><img></div>
                                    <p><img src="{{ asset('img/Recurso%20105siibal-.png') }}""
                                            style="width: 300px;text-align: center;">
                                    </p>
                                    <div>
    <label for="asesor_id">Selecciona Asesor:</label>
    <select name="asesor_id" id="asesor_id" class="form-control" required>
        <option value="">-- Selecciona un asesor --</option>
        @foreach ($asesores as $asesor)
            <option value="{{ $asesor->id }}" {{ $usuario->asesor_id == $asesor->id ? 'selected' : '' }}>
                {{ $asesor->clave_asesor }} - {{ $asesor->name }} <!-- Asegúrate de incluir el nombre o detalles del asesor -->
            </option>
        @endforeach
    </select>
</div>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style="  color: red;">*</span><input
                                            value="{{ $usuario->rfc }}" type="text" id="inputRFC" class="form-control"
                                            placeholder="RFC" name="rfc" required minlength="13" maxlength="13"
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style="  color: red;">*</span><input
                                            value=" {{ \Carbon\Carbon::parse($usuario->birthday)->format('d-m-Y') }} "
                                            type="text" id="inputBirthDay" class="form-control"
                                            placeholder="Fecha de nacimiento :" required name="birthday"
                                            style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>

                                    <br />
                                    <div>

                                        <div>
                                            
                                            <strong >Dirección</strong>
                                            <br>
                                            <span clase="red" style="  color: red;">*</span><input
                                                value="{{ $usuario->address }}" type="text" id="inputAddress"
                                                class="form-control" placeholder="Calle" name="address" required
                                                style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">

                                        </div>
                                        <script>
                                            document.getElementById("inputAddress").addEventListener("input", function() {
                                                this.value = this.value.toUpperCase();
                                            });
                                            document.getElementById("inputAddress").addEventListener("input", function() {
                                                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                            });
                                        </script>
                                    </div>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style="  color: red;">*</span><input
                                            value="{{ $usuario->numero_ext }}" type="text" id="inputNumext"
                                            class="form-control" placeholder="Número Ext." name="numero_ext" required
                                            style="border-width: 1px;border-color: rgb(179,179,179;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputNumext").addEventListener("input", function() {
                                            this.value = this.value.replace(/[^0-9]/g, '');
                                        });
                                    </script>
                                    <div>
                                        <div><img></div>
                                        </span><input value="{{ $usuario->num_int }}" type="text" id="inputNumint"
                                            class="form-control" placeholder="Número Int. (Opcional)" name="numero_int"
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputNumint").addEventListener("input", function() {
                                            this.value = this.value.replace(/[^0-9]/g, '');
                                        });
                                    </script>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style="  color: red;">*</span><input
                                            value="{{ $usuario->colonia }}" type="text" id="inputColonia"
                                            class="form-control" placeholder="Colonia" name="colonia"
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputColonia").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                    </script>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style=" color: red;">*</span><input
                                            value="{{ $usuario->postalcode }}" type="text" minlength="5" maxlength="5"
                                            id="inputPostalCode" class="form-control" placeholder="Código Postal"
                                            name="postalcode" required
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputPostalCode").addEventListener("input", function() {
                                            this.value = this.value.replace(/[^0-9]/g, '');
                                        });
                                    </script>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style="  color: red;">*</span><input
                                            value="{{ $usuario->municipio }}" type="text" id="inputMunicipio"
                                            class="form-control" placeholder="Municipio" name="municipio" required
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputMunicipio").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                        document.getElementById("inputMunicipio").addEventListener("input", function() {
                                            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                        });
                                    </script>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style=" ; color: red;">*</span><input
                                            value="{{ $usuario->ciudad }}" type="text" id="inputCiudad"
                                            class="form-control" placeholder="Ciudad" name="ciudad" required
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputCiudad").addEventListener("input", function() {
                                            this.value = this.value.toUpperCase();
                                        });
                                        document.getElementById("inputCiudad").addEventListener("input", function() {
                                            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                                        });
                                    </script>
                                    <div>
                                        <div><img></div>
                                        <span clase="red" style="  color: red;">*</span><input
                                            value="{{ $usuario->telephone }}" type="text" id="inputTelephone"
                                            class="form-control" placeholder="Teléfono" name="telephone" required
                                            minlength="10" maxlength="10"
                                            style="border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                    </div>
                                    <script>
                                        document.getElementById("inputTelephone").addEventListener("input", function() {
                                            this.value = this.value.replace(/[^0-9]/g, '');
                                        });
                                    </script>
                                    <div><img></div>

                            </div>
                            <div><button class="btn btn-primary" type="submit" value="Upload"
                                    style="border-style: none;background: url(&quot;img/Recurso%20119siibal-.png&quot;) top / contain no-repeat;width: 300px;height: 45px;"><img
                                        src="{{ asset('img/Recurso%20119siibal-.png') }}"
                                        style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0; "></button>
                            </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
