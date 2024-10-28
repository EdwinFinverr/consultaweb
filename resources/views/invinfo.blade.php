@extends('layout.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Inversiones</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body style="background: url('img/Recurso%2049siibal-.png') top / cover no-repeat;">
        <div class="container"
            style="background-color: rgba(255, 255, 255, 0.349); display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div>
                <h1>Simulación de Inversión</h1>

                @if (isset($rendimientoTotal))
                    <div class="results">
                        <h2>Resultados de la simulación</h2>
                        <p>Cantidad de inversión: ${{ number_format($cantidad, 2) }}</p>
                        <p>Tasa aplicada: {{ $tasa }}%</p>
                        <p>Rendimiento total ({{ $duracion }} años): ${{ number_format($rendimientoTotal, 2) }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('calcular-rendimiento') }}" onsubmit="handleSubmit(event)">
                    @csrf

                    <div class="form-group">
                        <label for="cantidad">Cantidad de Inversión:</label>
                        <input type="text" id="cantidad" name="cantidad" min="50000" required class="form-control" onblur="formatCurrency(this)" oninput="validateInvestment(this)">
                    </div>

                    <div class="form-group">
                        <label for="duracion">Plazo de Inversión (en años):</label>
                        <select id="duracion" name="duracion" class="form-control" required>
                            <option value="1">1 año</option>
                            <option value="2">2 años</option>
                            <option value="3">3 años</option>
                            <option value="5">5 años</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Calcular rendimiento</button>
                </form>
            </div>
        </div>

        <script>
            function formatCurrency(input) {
                var value = input.value.replace(/[^\d.]/g, '');
                input.dataset.value = value; // Almacenar el valor sin formato en el atributo data-value
                input.value = '$' + Number(value).toLocaleString('es-MX', {
                    minimumFractionDigits: 2
                });
            }

            function validateInvestment(input) {
                var cantidad = parseFloat(input.value.replace(/[^\d.]/g, ''));

                if (cantidad < 50000) {
                    input.setCustomValidity("La inversión no puede ser menor a $50,000");
                } else {
                    input.setCustomValidity("");
                }
            }

            function handleSubmit(event) {
                event.preventDefault();
                var cantidadInput = document.getElementById('cantidad');
                cantidadInput.value = cantidadInput.dataset.value; // Asignar el valor sin formato al campo antes de enviar el formulario
                event.target.submit();
            }
        </script>
    </body>

    </html>
@endsection
