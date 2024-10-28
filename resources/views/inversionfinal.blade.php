@extends('layout.app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="icon" href="https://finverr.com/img/isotipo.png" type="image/png">

    <!-- Enlaces a tus hojas de estilo -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Contact-form-simple.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Hero-Clean-Reverse.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Icon-Input.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar-Right-Links.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <title>Finverr</title>

    <!-- Estilos específicos para móviles si es necesario -->
    <style>
        body {
            background-image: url('{{ asset('img/procesofinal.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            body {
                background-size: contain; /* Ajusta la imagen para que quepa completamente */
                min-height: 50vh;
            }
        }

        @media (max-width: 480px) {
            body {
                background-size: contain;
                background-position: top;
                min-height: 40vh;
            }
        }
    </style>
</head>

<body>
    <!-- Contenido de tu página aquí -->

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Beautiful-Contact-from-animated.js"></script>
    <script src="assets/js/Smooth-Scrollto-button-read-Description-1.js"></script>
    <script src="assets/js/Smooth-Scrollto-button-read-Description.js"></script>
</body>

