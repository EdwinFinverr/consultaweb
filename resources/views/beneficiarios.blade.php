@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">Nombre (s)</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Relación</th>
                        <th scope="col">Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beneficiarios as $beneficiario )
                    <tr>
                        <th scope="row">{{$beneficiario->name}}</th>
                        <td>{{$beneficiario->lastName}}</td>
                        <td>{{$beneficiario->relationship}}</td>
                        <td>{{$beneficiario->percentage}}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
