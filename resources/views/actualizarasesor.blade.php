@extends('layout.appss')

@section('content')
    <div class="modal-dialog" style="border-style: none;">
        <div class="modal-content" style="border-style: none; ">
            @foreach ($usuarios as $usuario)
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <form method="POST" action="{{ route('updateDatosinicioase', [$usuario->id]) }}" id="regForm">
                            @csrf
                            @method('PUT')
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
                            <p><img src="{{ asset('img/Recurso%20105siibal-.png') }}"
                                    style="width: 300px;text-align: center;"></p>

                            <div>
                                <div><img></div>
                                <span class="red" style="padding-left: 510px; color: red;">*</span>
                                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"
                                    name="password" required minlength="8"
                                    style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <i id="showPassword1" class="fa fa-eye"
                                    style="padding-left: 520px; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                            <div>
                                <div><img></div>
                                <span class="red" style="padding-left: 510px; color: red;">*</span>
                                <input type="password" id="inputConfirmPassword" class="form-control"
                                    placeholder="Confirmar Contraseña" name="password_confirmation" required minlength="8"
                                    style="width: 500px;border-width: 1px;border-color: rgb(179,179,179);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
                                <i id="showPassword2" class="fa fa-eye"
                                    style="padding-left: 520px; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" value="Upload"
                                    style="border-style: none;background: url(&quot;img/Recurso%20119siibal-.png&quot;) top / contain no-repeat;width: 588px;height: 45px;">
                                    <img src="{{ asset('img/Recurso%20119siibal-.png') }}"
                                        style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <div class="modal-footer">
        <script>
            document.getElementById('showPassword1').addEventListener('click', function() {
                togglePasswordVisibility('inputPassword');
            });

            document.getElementById('showPassword2').addEventListener('click', function() {
                togglePasswordVisibility('inputConfirmPassword');
            });

            function togglePasswordVisibility(inputId) {
                var input = document.getElementById(inputId);
                var icon = document.getElementById('show' + inputId.charAt(0).toUpperCase() + inputId.slice(1));

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    </div>
@endsection
