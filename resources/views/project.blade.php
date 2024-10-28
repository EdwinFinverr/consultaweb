@extends('layout.app')

@section('content')
<div class="container text-center">
    <b>Torre Villa Campestre</b>
</div>
<hr>
<div class="container">
    <div class="row my-4">
        <div class="col align-self-center">
            <div class="shadow-lg p-3 mb-5 bg-dark rounded">
                <h4 class="text-justify text-white text-break">
                    Torre departamental cuenta con un amplio estacionamiento y una recepción en planta baja. La altura
                    es de
                    8 niveles,
                    así mismo tiene 3 departamentos por piso, un plus en el lado sur-poniente del edificio donde se
                    encuentran 3 departamentos más.
                </h4>
            </div>

        </div>
        <div class="col">
            <img src="{{asset('img/rendersVilla/R1.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <img src="{{asset('img/rendersVilla/R2.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
        <div class="col align-self-center">
        <div class="shadow-lg p-3 mb-5 bg-dark rounded">
        <h4 class="text-justify text-white text-break">
        Y por si fuera poco los departamentos se encuentran automatizados para que todo lo controles desde
                    tu
                    celular.
        Una hermosa zona de descanso en la parte posterior de la torre con vista hacia el sur de la ciudad.
        </h4>
        </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col align-self-center">
        <div class="shadow-lg p-3 mb-5 bg-dark rounded">
        <h4 class="text-justify text-white text-break">
        Elaborada con los materiales
                    de la más alta calidad de la construcción: Estructura metálica, muros de concreto aparentes, piedra,
                    tiene materiales como madera
                    tratada para exteriores y volúmenes que hace verse al edificio simétrico y estético.
                    Cuenta con una gran variedad de vegetación y áreas verdes.
        </h4>
        </div>
        </div>
        <div class="col">
            <img src="{{asset('img/rendersVilla/R3.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
    <div class="row justify-content-center my-4">
    <div class="col-md-8 offset-md-2 align-self-center">
    <img src="{{asset('img/rendersVilla/R4.webp')}}" alt="render Torre villa" class="img-fluid">
    </div>
    </div>
</div>
@endsection('content')
