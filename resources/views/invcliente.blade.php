@extends('layout.appcliente')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="border-style: none;">
                        <a class="nav-link active" id="nav-inversiones-tab" data-toggle="tab" href="#nav-inversiones"
                            role="tab" aria-controls="nav-inversiones" aria-selected="true" style="border-style: none;">
                            <img src="{{ asset('img/Recurso%20126siibal-.png') }}"
                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height:
                         45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;"></a>
                        <a class="nav-link" id="nav-inversiones-pendientes-tab" data-toggle="tab"
                            href="#nav-inversiones-pendientes" role="tab" aria-controls="nav-inversiones-pendientes"
                            aria-selected="false" style="border-style: none;"><img
                                src="{{ asset('img/Recurso%20127siibal-.png') }}"
                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height:
                     45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;"></a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                            aria-controls="nav-contact" aria-selected="false"><img src="{{ asset('img/finalizadas.png') }}"
                                style="background: left / contain no-repeat, rgba(13,110,253,0);border-style: none;height:
                 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;"></a>
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
                    <div class="tab-pane fade" id="nav-inversiones-pendientes" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        @include('inc.partials.get-inversiones-pendientes')
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @include('inc.partials.get-inversiones-finalizadas')
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
