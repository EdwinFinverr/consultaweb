<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firma Digital</title>
</head>

<body>
    <h1>Firma Digital</h1>
    <p>
    Nos alegra mucho tenerte con nosotros. Adjunto encontrarás el precontrato. Además, hemos incluido el enlace para que puedas proceder con la firma electrónica del mismo.
    </p>
    <p>
    <a href="{{ route('validar.firma', ['token' => encrypt($user_id)]) }}" style="color: #007bff; text-decoration: none; font-weight: bold;">Haz Clic aqui para <strong>→</strong>
    Firmar Contrato</a>

    </p>
    <p>
        Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos. Estamos aquí para ayudarte.
    </p>
    <p>
        Atentamente,<br>
        <strong>FINVERR INVERSIONES</strong>
    </p>
    <img src="{{ $message->embed(public_path('img/firma.png')) }}" alt="Firma">
</body>

</html>



