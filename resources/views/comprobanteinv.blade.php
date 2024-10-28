@extends('layout.appcliente')

@section('content')
    <br>
    <div class="container">
        <!-- Aquí va el mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        @endif

        <!-- Progreso de las secciones -->
        <div id="progress">
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Home</span></a></div>
                <div class="circle"><span>1</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Beneficiario</span></a></div>
                <div class="circle"><span>2</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Documentos</span></a></div>
                <div class="circle"><span>3</span></div>
            </div>
            <div class="part on">
                <div class="desc"><a style="color: black"><span>Carátula de Inversión</span></a></div>
                <div class="circle"><span>4</span></div>
            </div>
            <div class="part on">
                <div class="desc"><span>Procedencia de tu Capital</span></div>
                <div class="circle"><span>5</span></div>
            </div>
            <div class="part on">
                <div class="desc"><span>Inversión</span></div>
                <div class="circle"><span>6</span></div>
            </div>
        </div>
    </div>

    <!-- Aquí el resto de tu contenido -->
    <style>
        /* Estilos del progreso */
        #progress {
            overflow: hidden;
            padding-bottom: 2em;
            text-align: center;
        }

        #progress .part {
            border-bottom: 3px solid #999;
            float: left;
            margin-bottom: 0.75em;
            position: relative;
            width: 16%;
        }

        #progress .desc {
            height: 1.1875em;
            padding-bottom: 1em;
        }

        #progress .desc span {
            font-size: 0.75em;
        }

        #progress .circle {
            left: 0;
            position: absolute;
            right: 0;
            top: 1.5em;
        }

        #progress .circle span {
            background: none repeat scroll 0 0 #666;
            border-radius: 2em 2em 2em 2em;
            color: #FFFFFF;
            display: inline-block;
            font-size: 0.75em;
            height: 2em;
            line-height: 2;
            width: 2em;
        }

        #progress .step {
            position: absolute;
        }

        #progress .on {
            border-bottom-color: #102940;
        }

        #progress .on .desc {
            font-weight: bold;
        }

        #progress .on .circle span {
            font-weight: bold;
            background-color: #102940;
        }
    </style>

   <div class="container">
    <div class="row">
        <div class="col">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="border-style: none;">
                    <a class="nav-link active" id="nav-inversiones-tab" data-toggle="tab" href="#nav-inversiones"
                        role="tab" aria-controls="nav-inversiones" aria-selected="true" style="border-style: none;">
                        <img src="{{ asset('img/Recurso%20126siibal-.png') }}"
                            style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height:
                     45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">
                    </a>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-inversiones" role="tabpanel"
                    aria-labelledby="nav-inversiones-tab">
                    <div class="container-fluid">
                        @include('inc.partials.get-inversiones')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
