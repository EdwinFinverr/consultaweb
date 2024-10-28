@php(\Jenssegers\Date\Date::setLocale('es'))
@php($fecha_inicio = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('l d F'))
@php($anio = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('Y'))
@php($fecha = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('d'))
@php($fecha_termino = Jenssegers\Date\Date::parse($inversion->fecha_termino))
@php($plazo = $fecha_termino->diffInYears($fecha_inicio))
@php($dia = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->day)
@php($fecha_cancelacion = Jenssegers\Date\Date::parse($inversion->fecha_cancelacion)->format('l d F'))
@php($año = Jenssegers\Date\Date::parse($inversion->fecha_cancelacion)->format('Y'))
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>CONVENIO DE TERMINACIÓN ANTICIPADA</title>
</head>


<body>

<h2 class="text-center"
        style="background: rgb(36,53,78);border-top-left-radius: 29px;border-bottom-right-radius: 29px;color: #ffffff;">
        CONVENIO DE TERMINACIÓN ANTICIPADA</h2>
        <div>
        <strong> <p class="text-justify
                text-break mt-5">CONVENIO DE TERMINACIÓN ANTICIPADA AL CONTRATO DE MUTUO CON INTERESES DE FECHA
                {{ Str::upper(\Jenssegers\Date\Date::parse($fecha_inicio)->format('l d F')) }} DEL {{ $anio }} IDENTIFICADO CON NÚMERO DE FOLIO {{ $inversion->folio }},
                 EN LO SUCESIVO EL CONTRATO; QUE CELEBRAN {{$empresa->nombre}}, REPRESENTADA EN ESTE ACTO POR {{ $inversion->empresa_inversion_id == 1 ? 'MARIA MONSERRAT VILLEGAS MOJARRO' : 'JOSÉ ALFREDO VILLEGAS MOJARRO' }} COMO MUTUARIO, 
                 EN LO SUCESIVO EL PRESTADOR, Y POR LA OTRA PARTE, POR SU PROPIO DERECHO {{ $user->name . ' ' . $user->lastName }} COMO MUTUANTE, EN LO SUCESIVO EL CLIENTE, DE CONFORMIDAD CON LOS SIGUIENTES
                  ANTECEDENTES, DECLARACIONES Y CLÁUSULAS: 
                </p></strong>
                <h3 class="h3 text-center">ANTECEDENTES</h3>
            <p class="text-justify text-break"><strong>I.</strong> En fecha <u>{{ Str::upper(\Jenssegers\Date\Date::parse($fecha_inicio)->format('l d F')) }} DEL {{ $anio }}</u> , <strong>LAS PARTES</strong> 
            celebraron un Contrato de Mutuo con Intereses.
            </p>
            <p class="text-justify text-break"><strong>II.</strong> En fecha <u>{{ Str::upper(\Jenssegers\Date\Date::parse($fecha_cancelacion)->format('l d F')) }} DEL {{ $año }}</u> el <strong>CLIENTE</strong> solicitó la 
                <strong>CANCELACIÓN DEL CONTRATO</strong> a 
                través de la plataforma <u>https://finverr.com.</u>
            </p>
            <h3 class="h3 text-center">DECLARACIONES</h3>
            <p class="text-justify text-break">  <strong>I.</strong> Declara el <strong>CLIENTE</strong>:</p>
            <p class="text-justify text-break"><strong>a)</strong> Que ha manifestado su voluntad de Cancelar el Contrato mediante el 
            procedimiento electrónico señalado en la Cláusula <strong>7.-</strong> del mismo.
            </p>
            <p class="text-justify text-break">  <strong>II.</strong> Declaran las <strong>PARTES</strong>:</p>
            <p class="text-justify text-break"><strong>a)</strong> Que es su voluntad otorgar el presente Convenio por así convenir a los intereses del <strong>CLIENTE</strong>.
            </p>
            <p class="text-justify text-break"><strong>b)</strong> Que se reconocen mutuamente la capacidad legal y personalidades en los términos más amplios, mismas que al suscribir 
            el presente Convenio no les han sido revocadas, modificadas, ni limitadas en forma alguna.
            </p>
            <p class="text-justify text-break"><strong>c)</strong> Que las Declaraciones asentadas el Contrato no sufrieron ninguna modificación. 
            </p>
            <p class="text-justify text-break"><strong>d)</strong> Que el presente Convenio no representa una novación en las obligaciones por lo que se obligan a 
            continuar cumpliéndolas en todos sus términos y en las condiciones establecidas en el Contrato.
            </p>
            <p class="text-justify text-break"><strong>e)</strong> Que a la fecha han cumplido, cada uno, con sus obligaciones estipuladas en el Contrato a entera satisfacción de la otra <strong>PARTE</strong>, 
            por lo que el presente Convenio se otorga con la intención de dar por terminada la relación contractual.  
            </p>
            <p class="text-justify text-break"><strong>f)</strong> Que en su otorgamiento no existe dolo, error, mala fe, lesión o alguna causa que pudiere invalidar o anular el presente Convenio 
            por lo que es su deseo sujetarse a lo estipulado en las siguientes Cláusulas:
            </p>
            <h3 class="h3 text-center">CLÁUSULAS</h3>
            <p class="text-justify text-break"><strong>1.- <u>SUSCRIPCIÓN ELECTRÓNICA:</u></strong> Para que el <strong>CLIENTE</strong> manifieste que es su voluntad dar por terminado el Contrato conforme al inciso g) de la 
                Cláusula anterior, deberá sujetarse a los siguientes pasos: <strong>I. INICIAR SESIÓN</strong> en <u>https:\\finverr.com</u> con su correo electrónico e ingresando sus claves personales de 
                identificación; <strong>II.</strong> Ingresar al apartado de DATOS, posteriormente desplegar la pestaña de INFORMACIÓN y dar CLIC en INVERSIONES; <strong>III.</strong> Dar Clic en CANCELAR CONTRATO; 
                <strong> IV.</strong> Confirmar la Cancelación dando clic en la ventanilla de SI, CANCELAR; <strong>V. El PRESTADOR</strong> enviará un correo electrónico a la dirección señalada por el <strong>CLIENTE</strong>
                para que éste dé CLIC en FIRMAR CONVENIO DE CANCELACIÓN; <strong>VI.</strong> Para la suscripción del Convenio, el <strong>CLIENTE</strong> deberá ingresar nuevamente su correo electrónico e 
                ingresando sus claves personales de identificación; <strong>VII.</strong> Por último, el <strong>PRESTADOR</strong> le hará llegar la copia del Convenio de Terminación correspondiente mediante 
                correo electrónico a la dirección señalada por el <strong>CLIENTE.</strong></p>
                <p class="text-justify text-break">Con lo anterior se tiene por cierto y manifestado que ha aceptado los términos y condiciones de la cancelación; que ha leído el 
                    check-box y está conforme con el mismo; y que otorga su expresa conformidad y aceptación para realizar la Cancelación del Contrato. En caso de que el <strong>CLIENTE</strong> no
                     acepte todos los términos y condiciones del presente Contrato, deberá abstenerse de dar clic en el recuadro de aceptación (CANCELAR CONTRATO); lo anterior de 
                     conformidad con lo establecido en los artículos 80, 93, 97 y demás aplicables del Código de Comercio y en términos de lo dispuesto por el artículo 1,803 del 
                     Código Civil Federal y demás aplicables en la legislación mexicana</p>
                <p class="text-justify text-break">Este Convenio se suscribirá por <strong>LAS PARTES</strong> a través de medios electrónicos, para lo cual cada una de <strong>LAS PARTES</strong> aquí reconocen que
                     los procesos informáticos utilizados, permiten expresar su voluntad y sus obligaciones en términos de este Contrato y están de acuerdo en que podrán acceder a 
                     la información generada para cualquier consulta posterior, en términos de lo establecido en el Código de Comercio. La suscripción del presente Contrato se 
                     llevará a cabo mediante una firma electrónica que cumple con los requisitos señalados en el artículo 97 y demás aplicables del Código de Comercio, y la cual 
                     se verificará por medio del código en cadena que se genere por el simple hecho de hacer clic en los botones de aceptación que se presenten dentro de la página 
                     web mencionada, considerando que el <strong>PRESTADOR</strong> tiene la capacidad de establecer un sistema electrónico de acceso para el <strong>CLIENTE</strong> y entregarle una clave de 
                     usuario y acceso. Dicha clave, junto con los números de identificación personal (contraseña) determinados por el propio <strong>CLIENTE</strong>, lo identifican como el firmante 
                     y le corresponden exclusivamente, además de que le permiten detectar cualquier alteración a la firma y a la integridad de la información del mensaje de datos 
                     hecha con posterioridad. Los medios electrónicos autorizados para ser utilizados en el presente Contrato tendrán la misma validez que los medios físicos y/o 
                     autógrafos.
                </p>
                <p class="text-justify text-break"><strong>2.- <u>OBJETO.</u> LAS PARTES</strong>, convienen dar por terminado el <strong>Contrato de Mutuo con Intereses</strong> de fecha <u>{{ $fecha_inicio }} del {{ $anio }}</u> identificado
                     con número de folio {{ $inversion->folio }} a solicitud del <strong>CLIENTE</strong> a través de la plataforma <u>https://finverr.com</u>, de conformidad con la Cláusula <strong>6.-</strong> del Contrato. 
                </p>
                <p class="text-justify text-break"><strong>3.- <u>PENA CONVENCIONAL.</u></strong> De conformidad con lo dispuesto en el inciso 
                <strong>g)</strong> la Cláusula <strong>6.-</strong> y Cláusulas <strong>7.-</strong> y <strong>8.-</strong> del Contrato, 
                <strong>EL CLIENTE</strong> se obliga a pagar al 
                </p>
                <p class="text-justify text-break"><strong>LAS PARTES</strong> convienen que, para el pago de la Pena Convencional el <strong>CLIENTE</strong> faculta para que el <strong>PRESTADOR</strong> haga las retenciones relativas al 30% (TREINTA POR CIENTO) de la cantidad entregada en mutuo, más la 
                    cantidad que resulte de la multiplicación de los intereses a razón del {{ $inversion->tasa_mensual }}% sobre la cantidad entregada en mutuo, por los meses que faltaren para el 
                    cumplimiento del plazo del <strong>CONTRATO.</strong>
                </p>
                <p class="text-justify text-break"><strong>4.- <u>DEVOLUCIÓN.</u> El PRESTADOR</strong> realizará la entrega al <strong>CLIENTE</strong> la cantidad correspondiente al 70% de la cantidad 
                    entregada en Mutuo señalada en el CONTRATO, menos la cantidad que resulte de la multiplicación de los intereses a razón del {{ $inversion->tasa_mensual }}% sobre la 
                    cantidad entregada en mutuo, por los meses que faltaren para el cumplimiento del plazo del <strong>CONTRATO</strong> dentro de los próximos 30 días naturales 
                    a partir de la fecha del presente Convenio a la cuenta de procedencia proporcionada por el <strong>CLIENTE.</strong></p>
                <p class="text-justify text-break">Por lo anterior, en este acto <strong>LAS PARTES</strong> que en este acto el <strong>CLIENTE</strong> se da por liquidado a entera satisfacción,
                        por lo que no se reserva ninguna acción en contra de el <strong>PRESTADOR.</strong>   </p>
                <p class="text-justify text-break"><strong>5.- <u>JURISDICCIÓN.</u> LAS PARTES</strong> están de acuerdo en que lo no previsto, se aplique lo dispuesto por el Código Civil 
                    del Estado de Aguascalientes, en lo relativo al Título V capítulo I y II referente al Contrato de Mutuo con Interés, así como del Código de Comercio 
                    en el título correspondiente, y que en caso de controversia o conflicto sobre la interpretación, aplicación y alcances de este Contrato se sometan a 
                    la jurisdicción de los tribunales de la ciudad de Aguascalientes.</p>
                    <p class="text-justify text-break"><strong>6.- <u>MANIFESTACIÓN DE LA VOLUNTAD.</u> LAS PARTES</strong> manifiestan que conocen y aprueban el contenido y alcances de este instrumento, 
                por lo que hace clic en el recuadro de aceptación <strong>(CANCELAR CONTRATO)</strong>, como prueba eficaz de su pleno y total consentimiento, expresando que en él no 
                ocurre violencia física o moral, coacción o vicio alguno de la voluntad.</p>
            <p class="text-justify text-break">En Aguascalientes, Aguascalientes, a <u>{{ $fecha_cancelacion }} del {{ $año }}</u>           </p> 
            <p class="text-justify text-break">Contrato firmado electrónicamente por FINVERR Corporativo Global, S.A. de C.V., a través de su representante legal en 
                carácter de <strong>PRESTADOR</strong> y {{ $user->name . ' ' . $user->lastName }} en carácter de <strong>CLIENTE</strong>
            </p>
            <p class="text-justify text-break">Firmado electrónicamente el: <u>{{ $fecha_cancelacion }} del {{ $año }}</u> con clave de Firma: <u>{{$inversion->clave_cancelacion}}</u>
            </p>
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