<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>{{ $title }} {{ $nombre }}</title>
</head>

<body>

    <h2 class="text-center">CONTRATO DE MUTUO CON INTERÉS</h2>
    <div>
        <p class="text-justify text-break mt-5">CONTRATO DE MUTUO QUE CELEBRAN POR UNA PARTE <span
                class="text-uppercase">{{ $empresa }}</span> (EN LO SUCESIVO “PRESTADOR”) REPRESENTADA
            LEGALMENTE POR LA C. <span class="text-uppercase">{{ $titular }}</span> Y POR LA OTRA EL
            C. <span class="text-muted text-uppercase">{{ $nombre }}</span> (EN LO SUCESIVO EL “CLIENTE”) Y PARA
            LOS EFECTOS DE
            ESTE CONTRATO SE LES DENOMINARÁ PRESTADOR Y CLIENTE RESPECTIVAMENTE. </p>
        <h3 class="h3 text-center">DECLARACIONES</h3>
        <p class="text-justify text-break">I.- Declara el “Mutuario y Prestador”: </p>
        <p class="text-justify text-break">a.Ser una persona moral, constituida bajo las leyes mexicanas, según lo
            acredita con la escritura
            pública número {{ $testimonio_notarial }}, otorgada ante la fe del Lic. y Doctor Arturo Duran García Notario
            público
            no. 47 de la ciudad de Aguascalientes, de fecha {{ $fecha_notaria }} con número de escritura
            {{ $numero_escritura }} e inscrita en el Registro Público de la Propiedad mediante el folio
            mercantil electrónico número {{ $folio_mercantil }} en fecha {{ $fecha_notaria }}.
        </p>
        <p class="text-justify text-break">b.-Tener por objeto social diversas actividades dentro de las siguientes
            ramas: Ingeniería en
            construcción, arrendamiento y compra venta de bienes inmuebles, así como la explotación de
            franquicias relativas al sector inmobiliario y, aquellos puntos relacionados que se encuentran
            insertos en el acta constitutiva.</p>
        <p class="text-justify text-break">c.-Que el representante legal C. {{ $titular }} se identifica con
            credencial
            de elector número {{ $credencial_elector }} quien tiene todas las facultades para celebrar el presente
            contrato, las cuales no le han sido revocadas o modificadas, según se acredita con el testimonio
            notarial número {{ $testimonio_notarial }}, otorgada ante la fe del Lic. y Doctor Arturo Duran García,
            notario público
            no. 47 del Estado de Aguascalientes. </p>
        <p class="text-justify text-break">d.-Declara el PRESTADOR, tener su domicilio en Av de Independencia Norte,
            Número 1830, en el
            Fraccionamiento Jardines de la Concepción Segunda Sección, C.P. 20210, en el Municipio de
            Aguascalientes, Aguascalientes, el cuál en este acto señala para oír y recibir todo tipo de
            notificaciones y documentos.</p>
        <p class="text-justify text-break">e.-Estar inscrito en el Registro Federal de Contribuyentes,con clave
            {{ $rfc_empresa }} como lo
            acredita la copia simple de su cédula de identificación fiscal, previo cotejo de su original.
        </p>
        <p class="text-justify text-break">f.-Declara el PRESTADOR Y CLIENTE que cuenta con la capacidad, preparación
            personal,
            infraestructura material y humana, así como con los equipos suficientes para responder del
            cumplimiento del objeto de este instrumento.</p>

        <p class="text-justify text-break">II.Declara el “MUTUANTE y CLIENTE”:</p>
        <p class="text-justify text-break">a). Ser una persona física, y que se identifica para la celebración de este
            contrato con la
            Identificación Oficial que previamente ha adjuntado en su perfil de cuenta ubicada en la página
            web https::\\plataforma.finverr.com, cuenta en la cual ha creado un registro de sus datos e
            ingresado con su nombre de usuario y contraseña.</p>
        <p class="text-justify text-break">b). Que previamente a la celebración del presente Contrato se registró en la
            Página web
            https::\\plataforma.finverr.com y que ha explorado, revisado, conoce y acepta los términos y
            condiciones, avisos legales y cualquier otra cláusula, declaración, derecho y/u obligación que se
            describa o contenga en dicha Página, y en el check box, y/o que le haya sido revelada al
            momento de registrarse como usuario de la Página, las cuales se tienen por insertadas
            literalmente en el presente Contrato.</p>
        <p class="text-justify text-break">c). Tener la voluntad de invertir a través de este contrato de mutuo con
            interés, en los proyectos
            que desarrolla {{ $empresa }} , a fin de apoyar de manera
            económica única y exclusivamente para que {{ $empresa }}
            alcance la meta de los objetivos que tiene preestablecidos de conformidad con sus objetivos
            mencionados en el acta constitutiva.</p>
        <p class="text-justify text-break">d). Que el “CLIENTE ” tiene todas las facultades para celebrar el presente
            contrato.
        </p>
        <p class="text-justify text-break">e). Tener su domicilio referido en la información registrada dentro de su
            cuenta en la página web
            antes señalada, el cual en este acto señala para oír y recibir todo tipo de notificaciones y
            documentos.
        </p>
        <p class="text-justify text-break">f). Estar inscrito en el registro federal de contribuyentes referido en la
            información de perfil de su
            cuenta en la página web anteriormente señalada.
        </p>
        <p class="text-justify text-break">III.Ambas partes declaran que conocen y comprenden el contenido, naturaleza
            de este contrato y
            que el mismo se celebra de conformidad a la legislación civil aplicable y que no genera ni
            constituye relación de trabajo entre los contratantes y consecuentemente ninguna obligación
            derivada de la existencia de una relación o contrato de trabajo, contrato que se celebra bajo las
            siguientes: </p>
        <h3 class="h3 text-center">CLAUSULAS</h3>
        <p class="text-justify text-break">1.-Las partes contratantes se reconocen capacidad y la personalidad con la
            que comparecen a la
            celebración de este instrumento.</p>
        <p class="text-justify text-break">2.-Este contrato se celebra por un tiempo determinado, el cual
            consecuentemente tendrá una
            vigencia y será obligatoria para las partes en el periodo acordado por
            @if ($plazo == '4 años')
                el tiempo necesario para finalizar el proyecto
            @else
                {{ $plazo }}
            @endif entre PRESTADOR y
            CLIENTE con las modalidades que se relacionan y refieren en la información proporcionada en la
            página https::\\plataforma.finverr.com
        </p>
        <p class="text-justify text-break">3.-Para el caso que el CLIENTE dé click en el recuadro de aceptación
            (“INVERTIR”), habiendo
            iniciado previamente una sesión en la Página e ingresado sus claves personales de identificación,
            se tiene por cierto y manifestado que ha aceptado los términos y condiciones de la Página y del
            Proyecto; que ha leído el check box y está conforme con el mismo; y que otorga su expresa
            conformidad y aceptación para realizar la entrega de la Aportación al PRESTADOR. En caso que
            el CLIENTE no acepte todos los términos y condiciones del presente Contrato, deberá abstenerse
            de dar click en el recuadro de aceptación ”INVERTIR”; lo anterior de conformidad con lo
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
            Código de Comercio, considerando que el PRESTADOR tiene la capacidad de establecer un
            sistema electrónico de acceso para el CLIENTE y entregarle una clave de usuario y acceso. Dicha
            clave, junto con los números de identificación personal (contraseña) determinados por el propio
            CLIENTE, lo identifican como el firmante y le corresponden exclusivamente, además de que le
            permiten detectar cualquier alteración a la firma y a la integridad de la información del mensaje de
            datos hecha con posterioridad. Los medios electrónicos autorizados para ser utilizados en el
            presente Contrato, tendrán la misma validez que los medios físicos (autógrafos). </p>
        <p class="text-justify text-break">4.-El PRESTADOR se obliga a aceptar del CLIENTE un préstamo para inversión
            por la cantidad
            de $ {{ number_format($cantidad, 2, '.', ',') }} MXN para invertir en los proyectos que se encuentran
            desarrollándose del PRESTADOR
            ({{ $empresa }}) y en consecuencia el CLIENTE no podrá
            incidir de forma alguna en los proyectos ni variar estos en lo sustantivo o accidental y que se
            encuentran dentro de las metas que le corresponden al PRESTADOR.
            @switch($tipo_contrato)
                @case(1)
                    Así mismo, a partir de la
                    firma del contrato de manera digital se tendrá 01 día hábil para realizar el déposito o trasferencia
                    bancaria del monto establecido por el Usuario mismo en el Contrato Mutuo con Interés suscrito
                    con EL PRESTADOR, de lo contrario tal contrato quedará nulificado completamente, sin perjuicio
                    para {{ $empresa }}, en este sentido el CLIENTE deberá adjuntar en la página web mencionada el ticket,
                    comprobante de transferencia o deposito bancario segun corresponda.
                @break

                @case(2)
                    La cantidad señalada en esta cláusula será entregada al PRESTADOR de la siguiente forma:
                    El monto de ${{ number_format($cantidad_inversion_pasada, 2, '.', ',') }} fue entregado al PRESTADOR con
                    anterioridad por medio de transferencia bancaria,
                    proveniente de la cuenta número {{ $cuenta_transferencia }} a nombre de {{ $cuenta_titular }}, el
                    {{ $fecha_primera_inversion }},
                    por lo que se reinvierte dicha cantidad en este contrato; mientras que el monto restante de
                    ${{ number_format($diferencia_inversion, 2, '.', ',') }}
                    será entregado al PRESTADOR a más tardar el día hábil siguiente de la firma del contrato de manera digital,
                    por medio de depósito o trasferencia bancaria, de lo contrario
                    tal contrato quedará nulificado completamente, sin perjuicio para {{ $empresa }}, en este sentido el
                    CLIENTE deberá adjuntar en la página web mencionada el ticket, comprobante
                    de transferencia o depósito bancario según corresponda
                @break

                @case(3)
                    La cantidad señalada en esta cláusula fue entregada al PRESTADOR por medio de transferencia bancaria,
                    proveniente de la cuenta número {{ $cuenta_transferencia }} a nombre de {{ $cuenta_titular }}, el
                    {{ $fecha_primera_inversion }}, por
                    lo que se reinvierte la cantidad establecida en esta cláusula, en este contrato.
                @break

                @case(4)
                    La cantidad señalada en esta cláusula fue entregada al PRESTADOR por medio de transferencia bancaria,
                    proveniente de la cuenta número {{ $cuenta_transferencia }} a nombre de {{ $cuenta_titular }}, el
                    {{ $fecha_primera_inversion }}, por
                    lo que se reinvierte la cantidad establecida en esta cláusula, en este contrato.
                @break

                @default
            @endswitch
        </p>
        <p class="text-justify text-break">5.-El PRESTADOR se obliga a pagar un porcentaje al CLIENTE del 1% mensual de
            intereses
            sobre la cantidad que el CLIENTE invirtió, excluyendo la corresponsabilidad del CLIENTE para
            cumplir con sus obligaciones fiscales por la recepción del interés por concepto de ganancias <br> antes
            mencionadas y ante cualquier autoridad administrativa, civil, y fiscal.</p>
        <p class="text-justify text-break">6.-El CLIENTE manifiesta que tiene conocimiento pleno de que el desarrollo
            del proyecto a llevar
            por el PRESTADOR, tiene una etapa natural por el plazo estipulado de {{ $plazo }}, a la fecha de la
            firma de
            recepción de la inversión del CLIENTE por lo que este recibirá el 1% de intereses sobre la
            cantidad en préstamo cada mes o treinta días, siendo dentro de los {{ $dia }} días de cada mes los
            cuales podrán ser entregados en la dirección: Avenida Independencia #1830 Jardines de la
            Concepción Segunda Sección o bien mediante Vía transferencia bancaria al número de cuenta
            que proporcione el cliente.
        </p>
        <p class="text-justify text-break">7.-El PRESTADOR en este contrato constituye como garantía de la inversión
            para el CLIENTE
            aquellos bienes inmuebles, sean en propiedad o en régimen condominal, en copropiedad, así
            como, sus frutos y accesiones que pertenezcan al PRESTADOR, y aquellos materiales o
            herramientas de construcción para ampliar y mejorar dichos bienes inmuebles del desarrollo del
            proyecto que se esté efectuando en el momento de la inversión para todos los efectos legales a
            que haya lugar o correspondan.
        </p>
        <p class="text-justify text-break">8.-Ambas partes pactan que el presente contrato, tiene una duración forzosa
            para ambas partes
            de
            @if ($plazo == 3)
                el tiempo necesario para finalizar el proyecto
            @else
                {{ $plazo }}
            @endif
            a partir de ejecutada la firma electrónica del presente contrato, por medio de la página
            web https::\\plataforma.finverr.com, por lo que al final de este contrato, el CLIENTE obtendrá la
            devolución íntegra de su inversión, treinta días posteriores a la expiración del contrato vía
            transferencia electrónica. Así mismo, El CLIENTE deberá presentar un escrito con la firma
            autógrafa de ambas partes, dos meses antes de la fecha del termino de vigencia de este contrato,
            si desea renovar el contrato, o bien, si solicita la devolución de su dinero al término del plazo
            estipulado, anexándose tal escrito al presente contrato de mutuo con interés.
        </p>
        <p class="text-justify text-break">9.-El PRESTADOR realizará los pagos de los intereses preestablecidos, mes con
            mes, al número
            referido en la cláusula 6 del presente contrato, y una vez realizado dicho pago el CLIENTE tendrá
            la obligación de acudir a las oficinas del PRESTADOR en esta ciudad a firmar el respectivo recibo
            de pago de intereses pactado; en caso de no acudir, el pago del siguiente mes no se realizará
            hasta en tanto no otorgue el recibo correspondiente.</p>
        <p class="text-justify text-break">10.-El PRESTADOR está obligado a comenzar a pagar los intereses pactados 30
            días después
            de la firma del presente contrato, estipulando que los intereses se pagarán a mes vencido, por lo
            cual el primer pago se realizará a los treinta días de haber otorgado el mutuo inicial.</p>
        <p class="text-justify text-break">11.-Posterior al primer pago establecido, el PRESTADOR se compromete a pagar
            de manera
            cíclica los intereses establecidos dentro de los días indicados en la cláusula “6” y si dicho día
            último coincidiera con un día inhábil, el PRESTADOR está obligado a realizar el pago inmediato <br> en el
            día hábil siguiente.</p>
        <p class="text-justify text-break">12.-Ambas partes acuerdan que son causas de terminación del presente
            contrato: <br> <br>
            a.La expiración del Plazo convenido; <br> <br>
            b.Por causas sobrenaturales que no sean imputables al PRESTADOR.
        </p>
        <p class="text-justify text-break">13.En caso de fallecimiento del CLIENTE, quedará como beneficiario la persona
            que aparece
            nombrada en el formulario registrado por el CLIENTE dentro de la cuenta de este, a quien o
            quienes se les entregará de manera proporcional la devolución de la inversión inicial sin que esta
            produzca interés alguno.
        </p>
        <p class="text-justify text-break">14.-Ambas partes manifiestan que si el CLIENTE solicita por escrito retirarse
            antes de que
            finiquite el presente contrato, las partes pactan que el PRESTADOR al devolver la inversión,
            descontará las cantidades otorgadas por concepto de interés de rendimientos, y la cantidad
            devuelta será penalizada de la cantidad inicial dada en mutuo, en el equivalente al 10% (diez por
            ciento), en virtud de que la inversión contemplada para el término que se establece en la cláusula
            segunda, ocasionará demoras y dilaciones, trayendo perjuicios económicos al PRESTADOR en
            los proyectos por este, y causara la recisión del contrato.</p>
        <p class="text-justify text-break">15.-PREVENCIÓN DE LAVADO DE ACTIVOS Y FINANCIACIÓN DEL TERRORISMO: El
            CLIENTE manifiesta bajo protesta de decir la verdad, que los recursos que invierte en el presente
            instrumento, y que se componen de su patrimonio no provienen de lavado de activos, financiación
            del terrorismo, narcotráfico, captación ilegal de dinero y en general de cualquier actividad ilícita;
            de igual manera manifiesta que los recursos recibidos en éste contrato, no serán destinados a
            ninguna de las actividades antes descritas. Para efectos de lo anterior, el CLIENTE autoriza
            expresamente al PRESTADOR, para que consulte los listados, sistemas de información y bases
            de datos a los que haya lugar y, de encontrar algún reporte, El PRESTADOR procederá a
            rescindir el presente contrato.</p>
        <p class="text-justify text-break">16.-Ambas partes están de acuerdo en que lo no previsto, se aplique lo
            dispuesto por el Código
            Civil del Estado de Aguascalientes, en lo relativo al Título V capítulo I y II referente al Contrato de
            Mutuo con Interés, así como del Código de Comercio en el título correspondiente, y que en caso
            de controversia o conflicto sobre la interpretación, aplicación y alcances de este contrato se
            sometan a la jurisdicción de los tribunales de la ciudad de Aguascalientes.</p>
        <p class="text-justify text-break">17.-Ambas partes manifiestan que conocen y aprueban el contenido y alcances
            de este
            instrumento, por lo que hace click en el recuadro de aceptación (“INVERTIR”), como prueba eficaz
            de su pleno y total consentimiento, expresando que en él no ocurre violencia física o moral,
            coacción o vicio alguno de la voluntad.
        </p>
        <p class="text-justify text-break">Aguascalientes, Ags, a {{ $fecha }}</p>
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
