<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Validar Información</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('/img/PORTADA-FIRMA.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semitransparente */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: justify;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button:disabled {
            background-color: #ccc;
        }

        p {
            text-align: center;
            color: #ff0000;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
        }

        .error-messages ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        input[type="password"], input[type="text"] {
    width: 100%; 
    padding-right: 40px; 
    box-sizing: border-box;
    font-size: 16px; /* Asegura que el tamaño de la fuente no cambie */
}

#togglePassword {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

    </style>
</head>

<body>
    <div class="container">
        <H1>FIRMA ELECTRÓNICA<H1>
        <h2>Para completar el proceso, por favor introduce tu usuario y contraseña. Esta información servirá como tu firma digital, garantizando la seguridad y validez del proceso.</h2>
        <h2 style=" text-align: center;">¡Gracias por tu apoyo!</h2>

        @php
            $attempts = session('login_attempts', 0);
            $blocked = $attempts >= 3;
        @endphp

        <form action="{{ route('validar.firma.post', ['user_id' => $user_id]) }}" method="POST">
    @csrf
    <div>
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" required {{ $blocked ? 'disabled' : '' }}>
    </div>
    <div>
        <label for="password">Contraseña:</label>
        <div style="position: relative;">
    <input type="password" id="password" name="password" required {{ $blocked ? 'disabled' : '' }} style="width: 100%; padding-right: 40px;">
    <i class="fa fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
</div>

    </div>
    <button type="submit" {{ $blocked ? 'disabled' : '' }}>Validar</button>
</form>

<script>
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    // Si la clase 'show-password' está activa, oculta la contraseña
    if (password.classList.contains("show-password")) {
        password.classList.remove("show-password");
        password.setAttribute("type", "password");
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
    } else {
        password.classList.add("show-password");
        password.setAttribute("type", "text");
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
    }
});
</script>

        @if ($blocked)
            <p>Has alcanzado el número máximo de intentos. Por favor, <a href="{{ route('password.request') }}" style="color: #007bff; text-decoration: none; font-weight: bold;">restablece tu contraseña</a>.</p>
        @endif

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>

</html>
