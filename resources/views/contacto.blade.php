@extends('layout.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>inversiones</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/Contact-form-simple.css">
        <link rel="stylesheet" href="assets/css/Hero-Clean-Reverse.css">
        <link rel="stylesheet" href="assets/css/Navbar-Right-Links.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body style="background: url(&quot;img/Recurso%2049siibal-.png&quot;) top / cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img class="img-fluid" src="{{ asset('img/Recurso%2047siibal-.png') }}" ></div>
                    <br>
                    <div><input type="email" name="email" placeholder="Nombre"
                            style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-style: none;width: 350px;height: 38px;">
                    </div>
                    <div><img></div>
                    <div><input type="email" name="email" placeholder="Dirección"
                            style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-style: none;width: 350px;height: 38px;">
                    </div>
                    <div><img></div>
                    <div><input type="email" name="email" placeholder="Correo electrónico"
                            style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-style: none;width: 350px;height: 38px;">
                    </div>
                    <div><img></div>
                    <div><input type="email" name="email" placeholder="Teléfono"
                            style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-style: none;width: 350px;height: 38px;">
                    </div>
                    <div><img></div>

                    <div>
                        <select name="select"
                            style="background: rgba(255,255,255,0.73);border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;border-style: none;width: 350px;height: 38px;">
                            <option value="value1">Quiero invertir</option>
                            <option value="value2" selected>Necesito asesoría</option>
                            <option value="value3">Quejas o sugerencia</option>
                            <option value="value3">Ya soy cliente</option>
                            <option value="value3">Otros</option>
                        </select>
                    </div>
                    <div><img></div>
                    <div>
                        <textarea name="asunto" placeholder="Asunto" style="width: 350px;height: 180px;">
                            </textarea>
                    </div>
                    <div><img></div>
                    <div class="g-recaptcha" data-sitekey="6Ld6wsYjAAAAANImvnskvXwl7qJIeg6RoyxAwpAT"></div>
                    <br />
                    <div><img></div>
                    <div><button class="btn btn-primary d-block w-100" type="submit"
                            style="background: url(&quot;img/Recurso%2048siibal-.png&quot;) left / contain no-repeat, rgba(13,110,253,0);border-style: none;height: 45px;border-top-left-radius: 0px;border-top-right-radius: 0;border-bottom-right-radius: 0;border-bottom-left-radius: 0;text-align: left;"></button>
                        <br>
                    </div>
                </div>
                <div class="col-md-6">
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>
                    <div><img></div>

                    <p style="text-align: right;color: rgb(255,255,255);font-size: 20px;"><br>Información de
                        Contacto:<br>Centro Comercial Galerías 111B, Jardines de la Concepción II,<br>C.P. 20120
                        Aguascalientes,
                        Ags.<br>+52 (449) 925 0280<br>contacto@finverr.com<br><br></p>
                </div>
                <br>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3701.3018934710226!2d-102.2957103845886!3d21.9229426620255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429efaa363ced99%3A0x8d4aa77896128bf9!2sFINVERR!5e0!3m2!1ses-419!2smx!4v1672344474176!5m2!1ses-419!2smx"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        </div>

        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
