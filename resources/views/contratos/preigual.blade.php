@php(\Jenssegers\Date\Date::setLocale('es'))
@php($fecha_inicio = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('l d F'))
@php($fecha_fin = Jenssegers\Date\Date::parse($inversion->fecha_termino)->format('l d F'))
@php($anio = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('Y'))
@php($año_fin = Jenssegers\Date\Date::parse($inversion->fecha_termino)->format('Y'))
@php($fecha = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('d'))
@php($fecha_termino = Jenssegers\Date\Date::parse($inversion->fecha_termino))
@php($plazo = $fecha_termino->diffInYears($fecha_inicio))
@php($dia = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->day)
@php($fecha_cancelacion = Jenssegers\Date\Date::parse($inversion->fecha_cancelacion)->format('l d F'))
@php($año = Jenssegers\Date\Date::parse($inversion->fecha_cancelacion)->format('Y'))
@php($fecha_principal = Jenssegers\Date\Date::parse($penultimaInversion->fecha_inicio)->format('l d F'))
@php($año_principal = Jenssegers\Date\Date::parse($penultimaInversion->fecha_inicio)->format('Y'))
@php($fecha_re = Jenssegers\Date\Date::parse($inversion->fecha_reinversion)->format('l d F'))
@php($año_re = Jenssegers\Date\Date::parse($inversion->fecha_reinversion)->format('Y'))
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Adendum</title>
</head>


<body>
<style>  
.watermark {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: -1; /* Para colocar la marca de agua detrás de todo el contenido */
  opacity: 1; /* Puedes ajustar la opacidad según tu preferencia */
  font-size: 5em; /* Tamaño del texto de la marca de agua */
  color: #ccc; /* Color del texto de la marca de agua */
  pointer-events: none; /* Para evitar que la marca de agua interfiera con la interacción del usuario */
}
    </style>  
<div class="watermark">
    <p>CONTRATO MODELO SIN VALOR</p>
  </div>
  <h6><strong>REVISA QUE TUS DATOS SEAN CORRECTOS, YA QUE EL PRESENTE MODELO ES UNA RÉPLICA DEL CONTRATO DEFINITIVO</strong></h6>
  <div>
  <strong> <p class="text-justify
                text-break mt-5">ADENDUM DE AMPLIACIÓN DE VIGENCIA AL CONTRATO DE MUTUO CON INTERESES DE FECHA {{ Str::upper(\Jenssegers\Date\Date::parse($fecha_principal)->format('l d F')) }} DEL {{ $año_principal }}
                IDENTIFICADO 
                CON NÚMERO DE FOLIO {{ $inversion->folio }}, EN LO SUCESIVO EL CONTRATO; QUE CELEBRAN {{$empresa->nombre}}, REPRESENTADA EN ESTE 
                ACTO POR {{ $inversion->empresa_inversion_id == 1 ? 'MARIA MONSERRAT VILLEGAS MOJARRO' : 'JOSÉ ALFREDO VILLEGAS MOJARRO' }} COMO MUTUARIO, EN LO SUCESIVO EL PRESTADOR, Y POR LA OTRA PARTE, POR SU PROPIO DERECHO 
                {{ $user->name . ' ' . $user->lastName }} COMO MUTUANTE, EN LO SUCESIVO EL CLIENTE, DE CONFORMIDAD CON LOS SIGUIENTES ANTECEDENTES, DECLARACIONES Y CLÁUSULAS: 
                </p></strong>
                <h3 class="h3 text-center">ANTECEDENTES</h3>
            <p class="text-justify text-break"><strong>I.</strong> Que en fecha <u>{{ Str::upper(\Jenssegers\Date\Date::parse($fecha_principal)->format('l d F')) }} DEL {{ $año_principal }}</u> , <strong>LAS PARTES</strong> 
            celebraron el Contrato de Mutuo con Intereses identificado con el número de folio {{ $inversion->folio }}, en lo sucesivo <strong>EL CONTRATO</strong>. Del cual, han convenido 
            realizar las modificaciones aquí establecidas.
            </p>
            <p class="text-justify text-break"><strong>II.</strong> Que en fecha <u>{{ Str::upper(\Jenssegers\Date\Date::parse($fecha_inicio)->format('l d F')) }} DEL {{ $año }}</u> el <strong>CLIENTE</strong> solicitó la 
                <strong>AMPLIACIÓN DE LA VIGENCIA</strong> a 
                través de la plataforma <u>https://finverr.com.</u>
            </p>
            <h3 class="h3 text-center">DECLARACIONES</h3>
            <p class="text-justify text-break">  <strong>I.</strong> Declara el <strong>CLIENTE</strong>:</p>
            <p class="text-justify text-break"><strong>a)</strong> Que ha manifestado su voluntad de Ampliar la Vigencia de <strong>EL CONTRATO</strong> mediante el procedimiento 
            electrónico señalado en la Cláusula <strong>5.-</strong> del mismo.
            </p>
            <p class="text-justify text-break">  <strong>II.</strong> Declaran las <strong>PARTES</strong>:</p>
            <p class="text-justify text-break"><strong>a)</strong> Que es su voluntad otorgar el presente Adendum por así convenir a los intereses del <strong>CLIENTE</strong>.
            </p>
            <p class="text-justify text-break"><strong>b)</strong> Que se reconocen mutuamente la capacidad legal y personalidades en los términos más amplios, mismas 
            que al suscribir el presente Convenio no les han sido revocadas, modificadas, ni limitadas en forma alguna.
            </p>
            <h3 class="h3 text-center">CLÁUSULAS</h3>
            <p class="text-justify text-break"><strong>1.- <u>SUSCRIPCIÓN ELECTRÓNICA:</u></strong> Para el caso que el <strong>CLIENTE</strong> decida ampliar la vigencia del presente 
            Contrato deberá manifestar su voluntad por lo menos 30 días hábiles antes del vencimiento hasta 01 día hábil antes del vencimiento ingresando a la 
            página web <u>https:\\finverr.com</u> y realizar los siguientes pasos: <strong>I. INICIAR SESIÓN</strong> en <u>https:\\finverr.com</u> con su correo electrónico e ingresando 
            sus claves personales de identificación; <strong>II.</strong> Ingresar al apartado de DATOS, posteriormente desplegar la pestaña de INFORMACIÓN y dar CLIC en 
            INVERSIONES; <strong>III.</strong> Dar Clic en REINVERTIR; <strong>IV.</strong> Llenar el formulario con los datos para la ampliación de la vigencia y confirmar la ampliación 
            dando clic en la ventanilla de SI, REINVERTIR; <strong>V. El PRESTADOR</strong> enviará un correo electrónico a la dirección señalada por el <strong>CLIENTE</strong> para que 
            éste dé CILIC en FIRMAR ADENDUM; <strong>VI.</strong> Para la suscripción del Adendum, el <strong>CLIENTE</strong> deberá ingresar nuevamente su correo electrónico e ingresando 
            sus claves personales de identificación; <strong>VII.</strong> Por último, el <strong>PRESTADOR</strong> le hará llegar la copia del Adendum de Ampliación de vigencia 
            correspondiente mediante correo electrónico a la dirección señalada por el <strong>CLIENTE.</strong>
            </p>
            <p class="text-justify text-break">Con lo anterior se tiene por cierto y manifestado que ha aceptado los términos y condiciones de 
                    la cancelación; que ha leído el check-box y está conforme con el mismo; y que otorga su expresa conformidad y aceptación 
                    para realizar la Cancelación del Contrato. En caso de que el <strong>CLIENTE</strong> no acepte todos los términos y condiciones del 
                    presente Contrato, deberá abstenerse de dar clic en el recuadro de aceptación (REINVERTIR); lo anterior de conformidad 
                    con lo establecido en los artículos 80, 93, 97 y demás aplicables del Código de Comercio y en términos de lo dispuesto 
                    por el artículo 1,803 del Código Civil Federal y demás aplicables en la legislación mexicana.</p>
                    <p class="text-justify text-break">Este Contrato se suscribirá por <strong>LAS PARTES</strong> a través de medios electrónicos, 
                        para lo cual cada una de <strong>LAS PARTES</strong> aquí reconocen que los procesos informáticos utilizados, permiten expresar 
                        su voluntad y sus obligaciones en términos de este Contrato y están de acuerdo en que podrán acceder a la 
                        información generada para cualquier consulta posterior, en términos de lo establecido en el Código de Comercio.
                         La suscripción del presente Contrato se llevará a cabo mediante una firma electrónica que cumple con los 
                         requisitos señalados en el artículo 97 y demás aplicables del Código de Comercio, y la cual se verificará por 
                         medio del código en cadena que se genere por el simple hecho de hacer clic en los botones de aceptación que se presenten dentro de la página web mencionada, considerando que el <strong>PRESTADOR</strong> tiene la capacidad de establecer un 
                         sistema electrónico de acceso para el <strong>CLIENTE</strong> y entregarle una clave de usuario y acceso. Dicha clave, junto 
                         con los números de identificación personal (contraseña) determinados por el propio <strong>CLIENTE</strong>, lo identifican 
                         como el firmante y le corresponden exclusivamente, además de que le permiten detectar cualquier alteración a 
                         la firma y a la integridad de la información del mensaje de datos hecha con posterioridad. Los medios electrónicos 
                         autorizados para ser utilizados en el presente Contrato tendrán la misma validez que los medios físicos y/o autógrafos.
                         </p>
                         <p class="text-justify text-break"><strong>2.- <U>OBJETO.</U> LAS PARTES</strong> convienen modificar la Cláusula 
                <strong>4.-</strong>del Contrato, relativas a la vigencia de EL CONTRATO, la cual, se actualiza al <u>{{ $fecha_fin }} DEL {{ $año_fin }}</u>
                </p>
                <p class="text-justify text-break"><strong>3.- <u>OBLIGACIONES.</u></strong> El presente Adendum no representa una novación en las obligaciones en el 
                    Contrato Principal de Mutuo con Intereses, por lo que <strong>LAS PARTES</strong> siguen obligadas en los términos y las condiciones
                     anteriormente establecidas en el Contrato Principal.
                </p>
                <p class="text-justify text-break"><strong>4.- <u>JURISDICCIÓN.</u> LAS PARTES</strong> acuerdan que toda controversia e interpretación que se derive de 
                    este Adendum, respecto de su operación, formalización y cumplimiento, será resuelta conforme lo estipulado en <strong>EL CONTRATO.</strong> 
                </p>
                <p class="text-justify text-break">Enteradas <strong>LAS PARTES</strong> del contenido y los alcances legales del Adendum lo firman expresando que en 
                el no ocurre violencia física o moral, coacción o vicio alguno de la voluntad en Aguascalientes, Ags., el día <u>{{ $fecha_inicio }}</p>
                <h4><strong>REVISA QUE TUS DATOS SEAN CORRECTOS, YA QUE EL PRESENTE MODELO ES UNA RÉPLICA DEL CONTRATO DEFINITIVO</strong></h4>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
