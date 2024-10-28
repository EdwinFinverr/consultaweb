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
                    <div class="carousel-item active"><img class="w-100 d-block" src="{{ asset('img/sanblas1.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas2.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas3.jpg') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas4.jpg') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas5.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas6.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas7.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas8.png') }}"
                            alt="Slide Image"></div>
                    <div class="carousel-item"><img class="w-100 d-block" src="{{ asset('img/sanblas9.png') }}"
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
                    </ol>
                </div>
            </div>
            <div><img></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h1><br>San Blas<br><br></h1>
                        <p>Residencial.<br>2023<br></p>
                    </div>
                    <div class="col-md-7">
                        <h1><br>San Francisco de los Romos,Ags.<i class="fa fa-map-marker"></i><br><br></h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <p style="text-align: center;font-size: 30px;"><br>Es un proyecto residencial ubicado al norte de la ciudad
                    de Aguascalientes.
                    Generando un entorno caminable, invitándote a vivir cada espacio de tu fraccionamiento.
                    Disfrutando de las diversas áreas de recreación, comerciales y amenidades.
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
                                <li>Alberca</li>
                                <li>Senderos Verdes</li>
                                <li>Jardines</li>
                                <li>Área de Juegos</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Casa Club</li>
                                <li>Ciclovía</li>
                                <li>Pet Friendly</li>
                                <li>Zona Deportiva</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

    </html>
@endsection
