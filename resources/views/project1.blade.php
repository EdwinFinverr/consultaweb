@extends('layout.app')

@section('content')
<div class="container text-center">
    <b>Torre Abi Residencial</b>
</div>
<hr>
<div class="container">
    <div class="row my-4">
        <div class="col align-self-center">
            <div class="shadow-lg p-3 mb-5 bg-dark rounded">
                <h4 class="text-justify text-white text-break">
                    Torre departamental con acceso controlado 24 horas, las amenidades que lo acompañan son alberca,
                    zona de descanso, área infantil y salón de eventos exclusivo con terraza.
                </h4>
            </div>

        </div>
        <div class="col">
            <img src="{{asset('img/rendersAbi/r1.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <img src="{{asset('img/rendersAbi/r2.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
        <div class="col align-self-center">
            <div class="shadow-lg p-3 mb-5 bg-dark rounded">
                <h4 class="text-justify text-white text-break">
                Los departamentos tienen
                    acabados de lujo que hacen resaltar el minimalismo y belleza junto con el entorno.                 Así mismo ya
                    vienen domotizados lo que hace que todo lo puedas controlar desde smartphone.
                </h4>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col align-self-center">
            <div class="shadow-lg p-3 mb-5 bg-dark rounded">
                <h4 class="text-justify text-white text-break">
 El edificio cuenta con
                    Roofgarden en donde también se tiene albercas, jacuzzi, mesas de billar y una terraza donde se van a
                    poder relajar a cualquier hora del día.
                </h4>
            </div>
        </div>
        <div class="col">
            <img src="{{asset('img/rendersAbi/r3.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
    <div class="row my-4">
    <div class="col">
            <img src="{{asset('img/rendersAbi/r4.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
        <div class="col">
            <img src="{{asset('img/rendersAbi/r5.webp')}}" alt="render Torre villa" class="img-fluid h-100 w-100">
        </div>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-8 offset-md-2 align-self-center">
            <img src="{{asset('img/rendersAbi/r6.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
    <div class="row my-4">
    <div class="col">
            <img src="{{asset('img/rendersAbi/ri1.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
        <div class="col">
            <img src="{{asset('img/rendersAbi/ri2.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
    <div class="row my-4">
    <div class="col">
            <img src="{{asset('img/rendersAbi/ri3.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
        <div class="col">
            <img src="{{asset('img/rendersAbi/ri4.webp')}}" alt="render Torre villa" class="img-fluid">
        </div>
    </div>
</div>
@endsection('content')
