@extends('layout.app')

@section('content')

    <body>
        <div class="container">
            <div><img></div>
            <div><img></div>
            <div><img></div>
            <div><img></div>

            <div class="carousel slide" data-bs-ride="carousel" id="carousel-1">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img class="w-100 d-block" src="{{ asset('img/trigales1.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales2.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales3.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales4.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales5.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales6.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales7.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales8.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales9.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales10.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales11.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/trigales12.png') }}"
                            alt="Slide Image"></div>

                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span
                                class="carousel-control-prev-icon"></span><span
                                class="visually-hidden">Previous</span></a><a class="carousel-control-next"
                            href="#carousel-1" role="button" data-bs-slide="next"><span
                                class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a>
                    </div>

                    <ol class="carousel-indicators">
                        <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="3"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="4"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="5"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="6"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="7"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="8"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="9"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="10"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="11"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="12"></li>
                    </ol>
                </div>
            </div>
            <div><img></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="https://trigales.mx/">
                            <h1><br>Trigales<br><br></h1>
                        </a>
                        <p>Torre departamental de lujo.<br>2021<br></p>
                    </div>
                    <div class="col-md-6">
                        <h1><br>Aguascalientes, Ags.<i class="fa fa-map-marker"></i><br><br></h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <p style="text-align: center;font-size: 30px;"><br>La vanguardia llega a la ciudad de Aguascalientes, un
                    concepto innovador e inteligente.
                    Su diseño arquitectónico, sus acabados de lujo, la ubicación premiere al norte de la ciudad, acompañado
                    de amenidades exclusivas, creará un nivel que eleve tus sentidos.
                    <br><br>
                </p>
            </div>
            <div><img></div>
            <div>
                <div class="container">
                    <h1>Amenidades del Proyecto<br></h1>
                    <div><img></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Cardio Room</li>
                                <li>Skypool</li>
                                <li>Roof Top</li>
                                <li>Biblioteca de Herramientas</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Área de Asadores</li>
                                <li>Celdas Solares</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
