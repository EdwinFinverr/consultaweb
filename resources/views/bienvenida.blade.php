@extends('layout.app')

@section('content')

    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/inicio.png" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-8">
                                 
                                    <h1 class="display-1 mb-4 animated slideInDown" style="color: white">INVIERTE, GANA </h1>
                                    <h3 class="display-1 mb-4 animated slideInDown" style="background-color: white;">¡Descubre cómo! </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

                
    <div class="container-fluid  my-5 py-5" >
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-sm-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                <a  onclick="scrollToProyectos()"><img class="fa fa-users fa-3x text-white mb-3" src="{{ asset('img/Recurso%204siibal-.png') }}"
                                        style="width: 45px;"></a>
                                        <br>
                    <a  onclick="scrollToProyectos()"><span class="fs-5 " style="color:#102940">Busco Proyectos</span></a>
                    <hr class="bg w-25 mx-auto mb-0" style="color: #102940">
                </div>
                <div class="col-sm-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.3s">
                <a href="/contacto"><img class="fa fa-users fa-3x text-white mb-3" src="img/Recurso%205siibal-.png"
                                        style="width: 45px;"></a>
                 <br>
                    <a href="/contacto"><span class= "fs-5" style="color:#102940">Quiero ser parte de FINVERR</span></a>
                    <hr class="bg w-25 mx-auto mb-0" style="color:#102940">
                </div>
                <div class="col-sm-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.5s">
                <a href="/register"><img class="fa fa-users fa-3x text-white mb-3" src="img/Recurso%206siibal-.png"
                                        style="width: 50px;"></a>
                                        <br>
                    <a href="/register"><span class="fs-5 " style="color:#102940">Empezar a Ganar</span></a>
                    <hr class="bg w-25 mx-auto mb-0" style="color:#102940">
                </div>
            </div>
        </div>
    </div>

        <script>
        function scrollToProyectos() {
            const proyectos = document.getElementById("proyectos");
            proyectos.scrollIntoView({ behavior: 'smooth' });
        }</script>
    <div class="container-xxl service py-5" style="background-image: url(&quot;img/fondoinicio.png&quot;); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" >
                <h1 class="display-5 mb-5" style="font-size: 65px">¿Quiénes Somos?</h1>
                <p class="mb-4" style="font-size: 30px; ">Finverr es una empresa que se dedica al sector financiero y de bienes raíces. Contamos con más de 15 años de experiencia y 
                    nos catalogamos como pioneros en el crowdfunding financiero. Actualmente estamos construyendo desarrollos en Aguascalientes. Nuestros colaboradores son expertos 
                    en su ramo por lo que cada proyecto construido genera gran plusvalía.</p>
                            <br>
                            <br>
            </div>
        </div>
    </div>


    <div class="container-xxl py-5 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;" id="proyectos">
            <h1 class="display-5 mb-5">Explora tus Opciones</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <img class="img-fluid rounded" src="img/fondo4.png" alt="">
                    <div class="team-text">
                        <h4 class="mb-0">TRIGALES</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <img class="img-fluid rounded" src="img/fresno.png" alt="">
                    <div class="team-text">
                        <h4 class="mb-0">REAL FRESNO</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <img class="img-fluid rounded" src="img/fondo2.png" alt="">
                    <div class="team-text">
                        <h4 class="mb-0">SAN BLAS</h4>
                    </div>
                </div>
            </div>
        </div>

<!-- Redes Sociales Comunes -->
<div class="team-social d-flex justify-content-center mt-4">
    <a class="btn btn-square rounded-circle mx-1" href="https://www.facebook.com/FinverrDesarrollos/" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-facebook-f" style="font-size: 24px;"></i>
    </a>
    <a class="btn btn-square rounded-circle mx-1" href="https://www.linkedin.com/company/finverr-desarrollos/" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-linkedin-in" style="font-size: 24px;"></i>
    </a>
    <a class="btn btn-square rounded-circle mx-1" href="https://www.instagram.com/finverrdesarrollos/" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-instagram" style="font-size: 24px;"></i>
    </a>
    <a class="btn btn-square rounded-circle mx-1" href="https://www.tiktok.com/@finverrdesarrollos?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer">
        <svg class="e-font-icon-svg e-fab-tiktok mx-1" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;">
            <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"></path>
        </svg>
    </a>
</div>


    </div>
</div>



    <div class="container-xxl service py-5" style="background-image: url(&quot;img/fondoinicio.png&quot;); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" >
                <h1 class="display-5 mb-5" style="font-size: 65px">En FINVERR <br> si buscas, encuentras.</h1>
                <p class="mb-4" style="font-size: 30px; ">Contamos con los proyectos más exclusivos en las ciudades con más plusvalía. Esto hará que tu inversión genere rendimientos mes con mes de la forma más segura.
                <br>
                <br>
                Nuestros proyectos comprenden desde una Torre Departamental de lujo hasta exclusivos lotes residenciales en la ciudad de Aguascalientes.
            </p>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">FINVERR</h4>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-3"></i>Centro Comercial Galerías 111B</p>
                    <p class="mb-2"><i class="fas fa-phone-alt me-3"></i>+449 425 50 60</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>contacto@finverr.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://x.com/finverroficial?s=11"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.facebook.com/finverr/"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.youtube.com/@finverr1230"><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.linkedin.com/company/finverr-inversiones/"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.instagram.com/finverr.oficial/"><i
                        class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Servicios</h4>
                    <a class="btn btn-link" href="{{ url('login') }}">Iniciar Sesión</a>
                    <a class="btn btn-link" href="{{ url('register') }}">Registro</a>
                    <a class="btn btn-link" href="{{ url('invinfo') }}">Simulador</a>
                    <a class="btn btn-link" href="{{ url('contacto') }}">Contacto</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Nuestras otras paginas</h4>
                    <a class="btn btn-link" href="https://www.corporativofinverr.com/">Finverr Corporativo Global</a>
                    <a class="btn btn-link" href="https://finverrseguros.com/">Finverr Seguros</a>
                    <a class="btn btn-link" href="https://calfka.com/">Calfka Bienes Raíces</a>
                    <a class="btn btn-link" href="https://www.calfkaconstrucciones.com/">Calfka Diseño y Construcción</a>
                    <a class="btn btn-link" href="https://indeinn.com/">Indeinn Metalmecánica</a>
                    <a class="btn btn-link" href="https://spacework.mx/">Spacework</a>
                    <a class="btn btn-link" href="https://finverrdesarrollos.com/">Finverr Desarrollos</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1850.6605653028726!2d-102.29716446117975!3d21.922202733254593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429efaa363ced99%3A0x8d4aa77896128bf9!2sFINVERR!5e0!3m2!1ses-419!2smx!4v1699287139844!5m2!1ses-419!2smx" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">FINVERR</a>, Todos los derechos reservados.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <a class="border-bottom" href="{{ url('privacidad') }}">Aviso de Privacidad</a> 
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
    <script src="js/main.js"></script>
@endsection
