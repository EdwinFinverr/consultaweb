@php(\Jenssegers\Date\Date::setLocale('es'))
@php($fecha_inicio = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('l d F Y'))
@php($fecha = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->format('d'))
@php($fecha_termino = Jenssegers\Date\Date::parse($inversion->fecha_termino))
@php($plazo = $fecha_termino->diffInYears($fecha_inicio))
@php($dia = Jenssegers\Date\Date::parse($inversion->fecha_inicio)->day)
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .cintillo {
            background-color: #1a3256;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 80px;
            border-bottom-right-radius: 80px;
        }


        .cintillo2 {
            background-color: #a8c7f0;
            color: black;
            text-align: LEFT;
            line-height: 2;
            border-top-right-radius: 50PX;

        }

        .cintillo3 {
            background-color: #a8c7f0;
            color: black;
            text-align: LEFT;
            line-height: 2;
            border-top-right-radius: 50PX;
            border-top-left-radius: 50px;
            border-bottom-right-radius: 50px;
            border-bottom-left-radius: 50px;

        }

        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 100px;
            text-align: center;
        }

        .jumbotron {
            background-color: #ffffff;
            padding: 2rem;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }
    </style>
    <title>Contrato de
        inversión</title>
</head>


<body>


    <div class="row">
        <div class="col-md-3" style="width: 180px;margin-top: -50px;">
            <div class="cintillo4" style="font-size: 10px;">
                <br>
                CENTRO COMERCIAL GALERÍAS 111-B
                JARDINES DE LA CONCEPCIÓN II
                CP:20120 AGUASCALIENTES, AGS.
                449 425 5060 | 449 155 4368
            </div>
        </div>
        <div class="col-md-6">
            <div class="cintillo3" style="text-align: center;width: 350px;margin-left: 180px">
                <h1 class="display-4" style="color:#1a3256;"><strong>FINVERR</strong></h1>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>


    <p class="lead" style="text-align: center;">INVIERTE PARA GANAR</p>
    <hr class="my-4">

    <div class="cintillo">
        <h4>CONTRATO MUTUO CON INTERESES</h4>
    </div>
    <BR>
    <br>



    <div class="row">
        <div class="col-md-3">
            <div class="cintillo2">

            </div>
        </div>
        <div class="col-md-6">
            <div class="cintillo2">

            </div>
        </div>
        <div class="col-md-3">
            <div class="cintillo2" style="width: 250px;margin-left: 485px">
                FOLIO: {{ $inversion->folio }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8" style="width: 400px;">
            <div class="cintillo2">
                LUGAR: AGUASCALIENTES,
                AGS
            </div>
        </div>
        <div class="col-md-4" style="width: 250px;margin-top: -50px;margin-left: 485px">
            <div class="cintillo2">
                FECHA: {{ $fecha_inicio }}
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12">

            <div class="cintillo2">
                NOMBRE DEL CLIENTE: {{ $user->name . ' ' . $user->lastName }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="cintillo2">
                DIRECCIÓN: {{ $user->address }}
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-9" style="width: 400px;">
            <div class="cintillo2">
                CUIDAD: {{ $user->ciudad }}
            </div>
        </div>
        <div class="col-md-3" style="width: 200px;margin-top: -50px;margin-left: 528px">
            <div class="cintillo2">
                C.P.: {{ $user->postalcode }}
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-3" style="width: 250px;">
            <div class="cintillo2">
                RFC: {{ $user->rfc }}
            </div>
        </div>
        <div class="col-md-6" style="width: 250px;margin-top: -50px;margin-left: 260px">
            <div class="cintillo2">
                IDENTIFICACIÓN: {{ $user->identificacion }}
            </div>
        </div>
        <div class="col-md-3"style="width: 220px;margin-top: -50px;margin-left: 520px">
            <div class="cintillo2">
                NO: {{ $user->numero }}
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6" style="width: 400px;">
            <div class="cintillo2">
                TELÉFONO: {{ $user->telephone }}
            </div>
        </div>
        <div class="col-md-6" style="width: 200px;margin-top: -50px;margin-left: 528px">
            <div class="cintillo2">
                CELULAR: {{ $user->telephone }}
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="cintillo2">
                CORREO ELECTRÓNICO: {{ $user->email }}
            </div>
        </div>
    </div>
    <br>
    @foreach ($proyecto as $proyectos)
        <div class="row">
            <div class="col-md-12">
                <div class="cintillo2">
                    NOMBRE DEL PROYECTO: {{ $proyectos->proyecto }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cintillo2">
                    CUIDAD DEL PROYECTO: {{ $proyectos->ciudad }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cintillo2">
                    VALOR DE LA INVERSIÓN: {{ $inversion->cantidad }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cintillo2">
                    PORCENTAJE MINIMO MENSUAL: {{ $inversion->tasa_mensual }}%
                </div>
            </div>
        </div>
    @endforeach


    <div class="row">
        <div class="col-md-12">
            <div class="cintillo2">
                NÚMERO DE CUENTA: {{ $inversion->cuenta_transferencia }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="cintillo2">
                BANCO: {{ $bancoNombre }}
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-7" style="width: 400px;">
            <div class="cintillo2">
                PLAZO DE INVERSIÓN: {{ $plazo }} años
            </div>
        </div>
        <div class="col-md-5" style="width: 220px;margin-top: -50px;margin-left: 500px">
            <div class="cintillo2">
                DÍA DE PAGO MENSUAL: {{ $fecha }}
            </div>
        </div>
    </div>
    @foreach ($beneficiarios as $beneficiario)
        <div class="row">
            <div class="col-md-12">
                <div class="cintillo2">
                    BENEFICIARIO: {{ $beneficiario->name }}
                    {{ $beneficiario->lastName }}- PORCENTAJE: {{ $beneficiario->porcentaje }}%
                </div>
            </div>
        </div>
    @endforeach
    <hr class="my-4">
    <div>
        <p class="text-justify
        text-break mt-5">CONTRATO DE MUTUO QUE CELEBRAN POR UNA PARTE <span
                class="text-uppercase">{{ $empresa->nombre }}</span> (EN LO SUCESIVO “PRESTADOR”) REPRESENTADA POR SU
            ADMINISTRADOR ÚNICO EL C. JOSÉ ALFREDO VILLEGAS MOJARRO EN SU CARÁCTER DE “MUTUARIO” Y POR LA OTRA EL C.
            <span class="text-muted text-uppercase">{{ $user->name . ' ' . $user->lastName }}</span> EN SU CARÁCTER DE
            “MUTUANTE”, QUIENES PARA LOS EFECTOS DE ESTE CONTRATO SE LES DENOMINARÁ COMO “EL PRESTADOR” Y “EL CLIENTE”
            RESPECTIVAMENTE.
        </p>
        <p class="text-justify text-break" style="font-family: Arial; font-size: 10px;"><strong>
                DECLARACIONES</strong>
        </p>
        <p class="text-justify text-break" style="font-family: Arial, font-size: 10px">I.- Declara el “PRESTADOR”:
        </p>
        <p class="text-justify text-break">a. Ser una persona moral, constituida bajo las leyes mexicanas, según lo
            acredita con la escritura pública número 26,058, volumen 1,526, de fecha 14 de febrero del 2017, otorgada
            ante la Fe del Notario Público número 47 de la demarcación notarial de Aguascalientes, Ags., Dr. Arturo
            Duran García, cuyo primer testimonio se encuentra inscrito en el Registro Público de la propiedad y del
            Comercio de la ciudad de Aguascalientes, bajo el Folio Mercantil Electrónico número 2017012798, en fecha 16
            de febrero del 2017.
        </p>
        <p class="text-justify text-break">b. Que su representante legal el C. José Alfredo Villegas Mojarro se
            identifica con credencial de elector número 2245157431, quien tiene todas las facultades para celebrar el
            presente contrato, las cuales no le han sido revocadas o modificadas, según se acredita con el testimonio
            notarial descrito en el inciso a de estas declaraciones.</p>
        <p class="text-justify text-break">c. Tener por objeto social entre otras actividades las siguientes ramas:
            Ingeniería en construcción, desarrollo inmobiliario, urbanización, arrendamiento, compra, venta de bienes
            inmuebles y de materiales y maquinaria, así como la explotación de franquicias relativas al sector
            inmobiliario. </p>
        <p class="text-justify text-break">d. Tener su domicilio ubicado en Avenida Independencia número 2351 interior
            111-B, centro comercial “Galerías”, fraccionamiento Trojes de Oriente, C.P. 20120, de la ciudad de
            Aguascalientes, Ags. el cuál en este acto señala para oír y recibir todo tipo de notificaciones y
            documentos.</p>
        <p class="text-justify text-break">e. Estar inscrito en el Registro Federal de Contribuyentes, con clave
            FCG170214GL3 como lo acredita la copia simple de su cédula de identificación fiscal, previo cotejo de su
            original.
        </p>
        <p class="text-justify text-break">f. Declara el PRESTADOR que cuenta con la capacidad, preparación personal,
            infraestructura material y humana, así como con los equipos suficientes para responder del cumplimiento del
            objeto de este instrumento.</p>

        <p class="text-justify text-break">II. Declara el “CLIENTE”:</p>
        <p class="text-justify text-break">a). Ser una persona física, y que se identifica para la celebración de este
            contrato con la Identificación Oficial que previamente ha adjuntado en su perfil de cuenta ubicada en la
            página web https:\\plataforma.finverr.com, cuenta en la cual ha creado un registro de sus datos e ingresado
            con su nombre de usuario y contraseña.</p>
        <p class="text-justify text-break">b). Que previamente a la celebración del presente Contrato se registró en la
            Página web
            https:\\plataforma.finverr.com y que ha explorado, revisado, conoce y acepta los términos y
            condiciones, avisos legales y cualquier otra cláusula, declaración, derecho y/u obligación que se
            describa o contenga en dicha Página, y en el check box, y/o que le haya sido revelada al
            momento de registrarse como usuario de la Página, las cuales se tienen por insertadas
            literalmente en el presente Contrato.</p>
        <p class="text-justify text-break">c). Tener su domicilio referido en la información registrada dentro de su
            cuenta en la página web antes señalada, el cual en este acto señala para oír y recibir todo tipo de
            notificaciones y documentos.</p>
        <p class="text-justify text-break">d). Estar inscrito en el registro federal de contribuyentes referido en la
            información de perfil de su cuenta en la página web anteriormente señalada.
        </p>
        <p class="text-justify text-break">II.Declara el “CLIENTE”:</p>
        <p class="text-justify text-break">a. Que tienen conocimiento y están de acuerdo en que la cantidad entregada
            en
            mutuo a través de este contrato será utilizada con el único fin exclusivo de apoyar de manera económicamente
            a los proyectos que desarrolla la sociedad mercantil Finverr Corporativo Global S.A. de C.V. y también para
            lograr el cumplimiento de los objetivos que tiene preestablecidos en su acta constitutiva. </p>
        <p class="text-justify text-break">b. Que conocen y comprenden el contenido, naturaleza de este contrato y que
            el mismo se celebra de conformidad a la legislación civil aplicable y que no genera ni constituye relación
            de trabajo entre los contratantes y consecuentemente ninguna obligación derivada de la existencia de una
            relación o contrato de trabajo, contrato que se celebra bajo las siguientes: </p>
        <h3 class="h3 text-center">CLÁUSULAS</h3>
        <p class="text-justify text-break">1.- Las partes contratantes se reconocen capacidad y la personalidad con la
            que comparecen a la
            celebración de este instrumento.</p>
        <p class="text-justify text-break">2.- Este contrato se celebra por un tiempo determinado, el cual
            consecuentemente tendrá una
            vigencia y será obligatoria para las partes en el periodo acordado por
            @if ($plazo == 4)
                el tiempo necesario para finalizar el proyecto
            @elseif($plazo == 3)
                3 años
            @elseif($plazo == 2)
                2 años
            @else
                1 año
            @endif
            entre PRESTADOR y
            CLIENTE con las modalidades que se relacionan y refieren en la información proporcionada en la
            página https:\\plataforma.finverr.com
        </p>
        <p class="text-justify text-break">3.- Para el caso que el CLIENTE dé clic en el recuadro de aceptación
            (“INVERTIR”), habiendo
            iniciado previamente una sesión en la Página e ingresado sus claves personales de identificación,
            se tiene por cierto y manifestado que ha aceptado los términos y condiciones de la Página y del
            Proyecto; que ha leído el check box y está conforme con el mismo; y que otorga su expresa
            conformidad y aceptación para realizar la entrega de la Aportación al PRESTADOR. En caso que
            el CLIENTE no acepte todos los términos y condiciones del presente Contrato, deberá abstenerse
            de dar clic en el recuadro de aceptación ”INVERTIR”; lo anterior de conformidad con lo
            establecido en los artículos 80, 93, 97 y demás aplicables del Código de Comercio y en términos
            de lo dispuesto por el artículo 1,803 del Código Civil Federal y demás aplicables en la legislación
            mexicana.
        </p>
        <p class="text-justify text-break">Este Contrato se suscribirá por las partes, ya sea de manera física
            (autógrafa) o a través de
            medios electrónicos, para lo cual cada una de las Partes aquí reconocen que los procesos
            informáticos utilizados, permiten expresar su voluntad y sus obligaciones en términos de este
            Contrato y están de acuerdo en que podrán acceder a la información generada para cualquier
            consulta posterior, en términos de lo establecido en el Código de Comercio. En caso de que el
            presente Contrato se suscriba por medios electrónicos, esto se llevará a cabo mediante una firma
            electrónica que cumple con los requisitos señalados en el artículo 97 y demás aplicables del
            Código de Comercio, y la cual se verificará por medio del código en cadena que se genere por el simple
            hecho de hacer clic en los botones de aceptación que se presenten dentro de la página web mencionada,
            considerando que el PRESTADOR tiene la capacidad de establecer un
            sistema electrónico de acceso para el CLIENTE y entregarle una clave de usuario y acceso. Dicha
            clave, junto con los números de identificación personal (contraseña) determinados por el propio
            CLIENTE, lo identifican como el firmante y le corresponden exclusivamente, además de que le
            permiten detectar cualquier alteración a la firma y a la integridad de la información del mensaje de
            datos hecha con posterioridad. Los medios electrónicos autorizados para ser utilizados en el
            presente Contrato, tendrán la misma validez que los medios físicos (autógrafos). </p>
        <p class="text-justify text-break">4.- El PRESTADOR se obliga a aceptar del CLIENTE un préstamo para inversión
            por la cantidad
            de {{ $inversion->cantidad }} MXN para invertir en los proyectos que se encuentran desarrollándose del
            PRESTADOR
            ({{ $empresa->nombre }}) está llevando a cabo de acuerdo con su objeto social y en consecuencia el CLIENTE
            no
            podrá incidir de forma alguna en los proyectos ni variar éstos en lo sustantivo o accidental y que se
            encuentran dentro de las metas que le corresponden al PRESTADOR. Así mismo, a partir de la firma del
            contrato de manera digital se tendrá UN DÍA HÁBIL para realizar el depósito o trasferencia bancaria del
            monto establecido por el Usuario mismo en el Contrato Mutuo con Interés suscrito con EL PRESTADOR, de lo
            contrario tal contrato quedará nulificado completamente, sin perjuicio para {{ $empresa->nombre }}, en este
            sentido el CLIENTE deberá adjuntar en la página web mencionada el
            ticket,
            comprobante de transferencia o depósito bancario según corresponda.
            <br>
            La cantidad anterior fue entregada a El PRESTADOR de la siguiente manera:
            <br>
            <ul>
                {!! $textoProcedenciaStr !!}
            </ul>
        </p>
        <p class="text-justify text-break">5.- El PRESTADOR se obliga a pagar un porcentaje al CLIENTE del {{ $inversion->tasa_mensual }}%  
            mensual de intereses sobre la cantidad que el CLIENTE entregó en mutuo y el cual será pagado el día
            {{ $fecha }} de cada mes (en caso de que el dicho día
            {{ $fecha }} sea fin de semana o día inhábil EL
            PRESTADOR
            podrá hacer el
            pago en un plazo máximo de 5 días a partir de esa fecha) mediante transferencia electrónica a la cuenta señalada por el CLIENTE 
            en la carátula del presente Contrato; por lo que el PRESTADOR se obliga a mandar el comprobante correspondiente de dicha transferencia
            como recibo de pago al correo electrónico señalado por el CLIENTE en la carátula del Contrato.</p>
        <p class="text-justify text-break">6.- Ambas partes pactan que el presente contrato, tiene una duración forzosa
            para ambas partes

            @if ($plazo == 3)
                del tiempo necesario para finalizar el proyecto
            @elseif($plazo == 2)
                de 2 años
            @else
                de 1 año
            @endif
            a partir de ejecutada la firma electrónica del presente contrato, por medio de la página
            web https:\\plataforma.finverr.com, por lo que al final de este contrato, el CLIENTE obtendrá la
            devolución íntegra de su inversión, treinta días posteriores a la expiración del contrato vía
            transferencia electrónica.
        </p>
        <p class="text-justify text-break">7.- Las partes darán cumplimiento a sus respectivas obligaciones fiscales en
            los términos de las leyes tributarias aplicables. Asimismo, “EL CLIENTE” se hace responsable por el
            incumplimiento de cualquier obligación a su cargo de carácter fiscal o administrativa, local o federal, que
            sea consecuencia del cumplimiento de las obligaciones que contrae en este contrato.</p>
        <p class="text-justify text-break">8.- Ambas partes pactan que el presente contrato, tiene una duración forzosa
            para ambas partes de 1 año a partir de ejecutada la firma electrónica del presente contrato, por medio de la
            página web https:\\plataforma.finverr.com, por lo que al final de este contrato, el CLIENTE obtendrá la
            devolución íntegra de su inversión, treinta días posteriores a la expiración del contrato vía transferencia
            electrónica.</p>
        <p class="text-justify text-break">9.- Ambas partes acuerdan que son causas de terminación del presente
            contrato: <br> <br>
            a. La expiración del Plazo convenido. <br> <br>
            b. En cualquier caso que la ley o este contrato prevean, en el que se vean afectados los intereses del
            “PRESTADOR”.<br> <br>
            c. Si “EL CLIENTE” no cubriere cualquier responsabilidad fiscal derivada del presente contrato dentro de los
            diez días siguientes a la notificación que haga la autoridad correspondiente.<br> <br>
            d. Si EL CLIENTE falta el cumplimiento EXACTO de cualquiera de las obligaciones contraídas.<br> <br>
            e. En todos los demás casos en que, conforme a la ley, deban darse por vencidos anticipadamente las
            obligaciones a plazo.<br> <br>
            f. Por mutuo acuerdo y mediante convenio de recisión firmado.<br> <br>
        </p>
        <p class="text-justify text-break">10.- En caso de fallecimiento del CLIENTE, quedará como beneficiario la y/o
            las personas que aparecen nombradas en la carátula del presente contrato, las cuales quedaran sujetas a la
            vigencia de este y al finalizar el mismo, se realizará la devolución de la inversión inicial en los
            porcentajes que corresponda al o los beneficiarios designados por el CLIENTE y que acrediten fehacientemente
            y/o mediante radicación testamentaria y/o resolución judicial, ser el o los legítimo(s) heredero(s).
        </p>
        <p class="text-justify text-break">11.- Ambas partes están de acuerdo que, si el CLIENTE solicita por escrito
            la
            terminación anticipada el presente contrato, el PRESTADOR por concepto de penalización, podrá retener el 30%
            (TREINTA POR CIENTO) de la cantidad entregada en mutuo, así como también la cantidad que resulte de la
            multiplicación de los intereses a razón del {{ $inversion->tasa_mensual }}% sobre la cantidad entregada en mutuo, por
            los meses que faltaren para el cumplimiento del plazo del presente contrato.
            <br>
            Así mismo, EL CLIENTE está de acuerdo en que El PRESTADOR, podrá retener la(s) cantidad(es) entregada(s) por
            concepto del (los) BONO(S) y/o PROMOCIÓN(ES), al(los) que el CLIENTE, fuera acreedor durante el plazo que
            dure este contrato.
        </p>
        <p class="text-justify text-break">12.- PREVENCIÓN DE LAVADO DE ACTIVOS Y FINANCIACIÓN DEL TERRORISMO: En
            atención a los establecido por el artículo 17 fracción IV de la Ley Federal para la Prevención e
            Identificación de Operaciones Con Recursos De Procedencia Ilícita, en referencia al ofrecimiento habitual de
            los Servicios de Mutuo entre particulares, EL PRESTADOR a entera conformidad del CLIENTE, verificó la
            identidad basándose en credenciales o documentación oficial, así como recabo copia de dicha documentación;
            también le solicitó información acerca de si tiene conocimiento de la existencia del dueño beneficiario y,
            en su caso, le solicitó que exhiba la documentación oficial que permita identificarlo; además para los casos
            en que se establezca una relación de negocios, se le solicitó información sobre su actividad u ocupación y
            se le consultó en los listados y/o bases de datos de las autoridades competentes a fin de cerciorarse que no
            cuenta con algún reporte o vínculo de alguna actividad ilícita relacionada con la obtención de recursos de
            manera ilícita, lavado de dinero o financiamiento del terrorismo.
            <br>
            Así mismo, EL CLIENTE manifiesta bajo protesta de decir la verdad, que los recursos que entrega en el
            presente instrumento, y que se componen de su patrimonio no provienen de lavado de activos, financiación del
            terrorismo, narcotráfico, captación ilegal de dinero y en general de cualquier actividad ilícita; de igual
            manera manifiesta EL PRESTADOR que los recursos recibidos en este contrato, no serán destinados a ninguna de
            las actividades antes descritas.
            <br>
            En caso de que después de la firma del presente contrato, se hiciera evidente que EL CLIENTE ocultara
            información, o proporcionó información errónea y/o contara con un reporte o apareciera en alguna de las
            listas antes mencionadas, EL PRESTADOR, podrá rescindir de manera unilateral el presente contrato.
        </p>
        <p class="text-justify text-break">13.- Las partes acuerdan que en caso de que los datos ingresados como
            propios
            del CLIENTE dentro de este contrato, sean distintos a los datos de propietario de la cuenta bancaria de la
            cual se transfirieron los fondos a invertir a EL PRESTADOR por motivo de este contrato, quedará
            automáticamente rescindido el presente instrumento, sin perjuicio para EL PRESTADOR. Por lo que los fondos
            transferidos serán devueltos a la cuenta de origen de la que fueron recibidos dentro de los tres días
            hábiles bancarios siguientes al día de recepción del dinero por EL PRESTADOR.</p>
        <p class="text-justify text-break">14.- Ambas partes están de acuerdo en que lo no previsto, se aplique lo
            dispuesto por el Código Civil del Estado de Aguascalientes, en lo relativo al Título V capítulo I y II
            referente al Contrato de Mutuo con Interés, así como del Código de Comercio en el título correspondiente, y
            que en caso de controversia o conflicto sobre la interpretación, aplicación y alcances de este contrato se
            sometan a la jurisdicción de los tribunales de la ciudad de Aguascalientes.</p>
        <p class="text-justify text-break">15.- Ambas partes manifiestan que conocen y aprueban el contenido y alcances
            de este instrumento, por lo que hace clic en el recuadro de aceptación (“INVERTIR”), como prueba eficaz de
            su pleno y total consentimiento, expresando que en él no ocurre violencia física o moral, coacción o vicio
            alguno de la voluntad.
        </p>
        <p class="text-justify text-break">En Aguascalientes, Aguascalientes, el día {{ $fecha_inicio }}
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
