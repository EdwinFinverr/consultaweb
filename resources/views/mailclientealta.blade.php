<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <p>Te damos la Bienvenida: {{ $user->name }}!</p>
    <p>Tu cuenta ha sido creada exitosamente. A continuación, encontrarás los detalles de tu cuenta:</p>
    <ul>
        <li>Nombre de usuario: {{ $user->email }}</li>
        <li>Contraseña temporal: {{ $passwordTemporal }}</li>
    </ul>
    <img src="{{ $message->embed(public_path('img/firma.png')) }}" alt="Firma">
</body>

</html>
