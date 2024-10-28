<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>inversiones</title>
    <meta name="google-site-verification" content="ktCtQN1LJvkrBt7A8H7NM8F9LfPw31qwnFgWYw1o1CA" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Hero-Clean-Reverse.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Navbar-Right-Links.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="whats.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7CZ34PQLK2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7CZ34PQLK2');
</script>
</head>


<nav class="navbar navbar-expand-lg navbar-light" style="background: rgb(16,41,64);">
    <div class="container" >
        <a class="navbar-brand" href="/"><img src="{{ asset('img/Recurso%20104siibal-.png') }}" style="width: 190px; height: 50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="background: rgb(16,41,64);">
            <ul class="navbar-nav ml-auto" style="background: rgb(16,41,64);">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('login') }}" style="color: rgba(255,255,255,0.9);font-size: 25px;">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('register') }}" style="color: rgba(255,255,255,0.9);font-size: 25px;">Registro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('invinfo') }}" style="color: rgba(255,255,255,0.9);font-size: 25px;">Simulador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('contacto') }}" style="color: rgba(255,255,255,0.9);font-size: 25px;">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<body>
    <div class="nav-bottom">

        <div class="popup-whatsapp fadeIn">
            <div class="content-whatsapp -top"><button type="button" class="closePopup">
                    <i class="material-icons icon-font-color">close</i>
                </button>

                <p> <img src="{{ asset('img/secretary.png') }}" width="50"> Hola, ¿En qué podemos ayudarte? </p>

            </div>
            <div class="content-whatsapp -bottom">
                <input class="whats-input" id="whats-in" type="text" Placeholder="Enviar mensaje..." />




                <button class="send-msPopup" id="send-btn" type="button">
                    <i class="material-icons icon-font-color--black">send</i>
                </button>

            </div>
        </div>
        <button type="button" id="whats-openPopup" class="whatsapp-button">
            <div class="float">
                <i class="fa fa-whatsapp my-float" style="color:#ffffff"></i>
            </div>
        </button>
        <div class="circle-anime"></div>
    </div>
    <script>
        popupWhatsApp = () => {

            let btnClosePopup = document.querySelector('.closePopup');
            let btnOpenPopup = document.querySelector('.whatsapp-button');
            let popup = document.querySelector('.popup-whatsapp');
            let sendBtn = document.getElementById('send-btn');

            btnClosePopup.addEventListener("click", () => {
                popup.classList.toggle('is-active-whatsapp-popup')
            })

            btnOpenPopup.addEventListener("click", () => {
                popup.classList.toggle('is-active-whatsapp-popup')
                popup.style.animation = "fadeIn .6s 0.0s both";
            })

            sendBtn.addEventListener("click", () => {
                let msg = document.getElementById('whats-in').value;
                let relmsg = msg.replace(/ /g, "%20");

                window.open('https://wa.me/4494255060?text=' + relmsg, '_blank');

            });

            setTimeout(() => {
                popup.classList.toggle('is-active-whatsapp-popup');
            }, 3000);
        }

        popupWhatsApp();
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto");

        /* offset-x > | offset-y ^| blur-radius | spread-radius | color */
        @keyframes pulse {
            0% {
                transform: scale(1, 1);
            }

            50% {
                opacity: 0.3;
            }

            100% {
                transform: scale(1.45);
                opacity: 0;
            }
        }

        .pulse {
            -webkit-animation-name: pulse;
            animation-name: pulse;
        }

        .nav-bottom {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-content: flex-end;
            width: auto;
            height: auto;
            position: fixed;
            z-index: 8;
            bottom: 0px;
            right: 0px;
            padding: 5px;
            margin: 0px;
        }

        @media (max-width: 360px) {
            .nav-bottom {
                width: 320px;
            }
        }

        .whatsapp-button {
            display: flex;
            justify-content: center;
            align-content: center;
            width: 60px;
            height: 60px;
            z-index: 8;
            transition: .3s;
            margin: 10px;
            padding: 7px;
            border: none;
            outline: none;
            cursor: pointer;
            border-radius: 50%;
            background-color: white;
            /* offset-x > | offset-y ^| blur-radius | spread-radius | color */
            -webkit-box-shadow: 1px 1px 6px 0px rgba(68, 68, 68, 0.705);
            -moz-box-shadow: 1px 1px 6px 0px rgba(68, 68, 68, 0.705);
            box-shadow: 1px 1px 6px 0px rgba(68, 68, 68, 0.705);
        }

        .circle-anime {
            display: flex;
            position: absolute;
            justify-content: center;
            align-content: center;
            width: 60px;
            height: 60px;
            top: 15px;
            right: 15px;
            border-radius: 50%;
            transition: .3s;
            background-color: #77bb4a;
            animation: pulse 1.2s 4.0s ease 4;
        }

        .popup-whatsapp {
            display: none;
            position: absolute;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            width: auto;
            height: auto;
            padding: 10px;
            bottom: 85px;
            right: 6px;
            transition: .5s;
            border-radius: 10px;
            background-color: white;
            /* offset-x > | offset-y ^| blur-radius | spread-radius | color */
            -webkit-box-shadow: 2px 1px 6px 0px rgba(68, 68, 68, 0.705);
            -moz-box-shadow: 2px 1px 6px 0px rgba(68, 68, 68, 0.705);
            box-shadow: 2px 1px 6px 0px rgba(68, 68, 68, 0.705);
            animation: slideInRight .6s 0.0s both;
        }

        .popup-whatsapp>div {
            margin: 5px;
        }

        @media (max-width: 680px) {
            .popup-whatsapp p {
                font-size: 0.9em;
            }
        }

        .popup-whatsapp>.content-whatsapp.-top {
            display: flex;
            flex-direction: column;
        }

        .popup-whatsapp>.content-whatsapp.-top p {
            color: #585858;
            font-family: 'Roboto';
            font-weight: 400;
            font-size: 1.0em;
        }

        .popup-whatsapp>.content-whatsapp.-bottom {
            display: flex;
            flex-direction: row;
        }

        .closePopup {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 28px;
            height: 28px;
            margin: 0px 0px 15px 0px;
            border-radius: 50%;
            border: none;
            outline: none;
            cursor: pointer;
            background-color: #4cc370;
            -webkit-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
            -moz-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
            box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
        }

        .closePopup:hover {
            background-color: #3d9e5a;
            transition: .3s;
        }

        .send-msPopup {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffffff;
            margin: 0px 0px 0px 5px;
            border: none;
            outline: none;
            cursor: pointer;
            -webkit-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
            -moz-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
            box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
        }

        .send-msPopup:hover {
            background-color: #f8f8f8;
            transition: .3s;
        }

        .is-active-whatsapp-popup {
            display: flex;
            animation: slideInRight .6s 0.0s both;
            background-color: #fafafa;
        }

        input.whats-input[type=text] {
            width: 250px;
            height: 40px;
            box-sizing: border-box;
            border: 0px solid #ffffff;
            border-radius: 20px;
            font-size: 1em;
            background-color: #ffffff;
            padding: 0px 0px 0px 10px;
            -webkit-transition: width 0.3s ease-in-out;
            transition: width 0.3s ease-in-out;
            outline: none;
            transition: .3s;
        }

        @media (max-width: 420px) {
            input.whats-input[type=text] {
                width: 225px;
            }
        }

        input.whats-input::placeholder {
            /* Most modern browsers support this now. */
            color: rgba(68, 68, 68, 0.705);
            opacity: 1;
        }

        input.whats-input[type=text]:focus {
            background-color: #f8f8f8;
            -webkit-transition: width 0.3s ease-in-out;
            transition: width 0.3s ease-in-out;
            transition: .3s;
        }

        .icon-whatsapp-small {
            width: 24px;
            height: 24px;
        }

        .icon-whatsapp {
            width: 45px;
            height: 45px;
        }

        .icon-font-color {
            color: #ffffff;
        }

        .icon-font-color--black {
            color: #333333;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 15px;
            right: 16px;
            background-color: #4cc370;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .float:hover {
            text-decoration: none;
            color: #fff;
            background-color: #3d9e5a;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
</body>
