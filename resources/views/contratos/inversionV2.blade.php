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
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #cintillo {
            background-color: #1a3256;
            color: #ffffff;
            padding: 2px;
            text-align: center;
            border-top-left-radius: 80px;
            border-bottom-right-radius: 80px;
        }

    </style>
    <title>Contrato de
        inversión</title>
</head>


<body>
<style>
        #cintillo2  {
            background-color: #1573C6;
            color: #ffffff;
            padding: 2px;
            width: 150px;
            text-align: center;
            border-bottom-left-radius:80px;
            border-top-left-radius: 80px;
           
        }
        #dato{
            background-color: #95CEFF;
            color: black;
            padding: 2px;
            width: 200px;
            text-align:left;          
            border-bottom-right-radius: 80px;
            border-top-right-radius: 80px;
        }

        #separador{
            background-color: gray;
            height: 8px;
            border-bottom-right-radius: 80px;
            border-bottom-left-radius: 80px;
            border-top-left-radius: 80px;
            border-top-right-radius: 80px;
            width: 714px;
        }

        #pestaña{

        }
        .interlineado{line-height:15%;}
        body {
  position: relative;
}

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
  <h4><strong>REVISA QUE TUS DATOS SEAN CORRECTOS, YA QUE EL PRESENTE MODELO ES UNA RÉPLICA DEL CONTRATO DEFINITIVO</strong></h4>
    <br>
    <br>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-1" id="cintillo">
                <h4>CONTRATO MUTUO CON INTERESES</h4>
        </div>

        <div class="col-md-1">  
        </div>


    </div>
    <br>
    <br>

    <div class="containes">
        <div class="row">
            <div class="col-md-1" id="cintillo2" style="margin-left: 370px;width: 70px;">
            LUGAR
            </div>
            <div class="col-md-2" id="dato" style=" margin-left: 443px;margin-top: -160px; width: 300px;">
            AGUASCALIENTES, AGS. 
            </div>
        </div>
    </div>
    <div class="interlineado"></div>
    <div class="row">
        <div class="col-md-1">  
        </div>

        <div class="col-md-1" id="cintillo2" style="margin-top: 10px;">

                FOLIO
        </div>

        <div class="col-md-2" id="dato" style="margin-left: 154px;margin-top: -100px; width: 200px;">

                @if ($inversion->pre_folio_estado === 'si')
            MOD {{ $inversion->pre_folio }}
@else
    {{ $inversion->folio }}
@endif
        </div>

        <div class="col-md-1" id="cintillo2" style="margin-left: 370px;margin-top: -60px;width: 70px;">
                FECHA
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 443px;margin-top: -160px; width: 300px;">
        {{ Str::upper(\Jenssegers\Date\Date::parse($fecha_inicio)->format('l d F')) }} DEL {{ $año }}

        </div>

        <div class="col-md-1">  
        </div>
    
    </div>


    </div>

   <br>
        <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-10" id="separador">
        
        </div>

        <div class="col-md-1">  
        </div>


    </div>
    
    <br>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-3" id="pestaña" style="background-color: #f8eebc;
                margin-left: 20px;
            color: black;
            padding: 4px;
            text-align:center;    
            width: 250px;      
            border-top-left-radius: 80px;
            border-top-right-radius: 80px;">
            DATOS DEL CLIENTE
        </div>
        <div class="col-md-7">  
        </div>
        <div class="col-md-1">  
        </div>
    </div>

    <div class="interlineado"></div>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2">
            NOMBRE
        </div>
        <div class="col-md-8" id="dato" style="margin-left: 154px;margin-top: -100px; width: 590px;">  
            {{ $user->name . ' ' . $user->lastName }}
        </div>                          
    </div>

    <div class="interlineado"></div>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-top: 3px;">
            DIRECCIÓN:
        </div>
        <div class="col-md-8" id="dato" style="margin-left: 154px;margin-top: -100px; width: 590px;">  
    {{ $user->address }} 
    NUM. EXT. {{ $user->numero_ext }}
    @if(!empty($user->num_int))
        INT. {{ $user->num_int }}
    @endif
</div>
  
                
    </div>

    <div class="interlineado"></div>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-1" id="cintillo2" style="margin-top: 3px;width: 100px;">
            CUIDAD:
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 104px;margin-top: -100px; width: 150px;">  
            {{ $user->ciudad }}
        </div>
        <div class="col-md-1" id="cintillo2" style="margin-left: 259px;margin-top: -100px; width: 86px;">
            C.P.:
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 350px;margin-top: -100px; width: 86px;">  
            {{ $user->postalcode }}
        </div>
        <div class="col-md-1" id="cintillo2" style="margin-left: 440px;margin-top: -100px; width: 100px;">
            E-MAIL:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 544px;margin-top: -100px; width: 200px;">  
            {{ $user->email }}
        </div>                
        <div class="col-md-1">  
        </div>                
    </div>

    <div class="interlineado"></div>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-1" id="cintillo2" style="margin-top: 3px;width: 100px;">
            RFC:
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 104px;margin-top: -100px; width: 150px;">  
            {{ $user->rfc }}
        </div>
        <div class="col-md-1" id="cintillo2"style="margin-left: 259px;margin-top: -100px; width: 150px;">
            TELÉFONO:
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 413px;margin-top: -100px; width: 100px;">  
            {{ $user->telephone }}
        </div>
        <div class="col-md-1" id="cintillo2" style="margin-left: 520px;margin-top: -100px; width: 100px;">
            CELULAR:
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 623px;margin-top: -100px; width: 120px;">  
            {{ $user->telephone }}
        </div>              
        <div class="col-md-1">  
        </div>                
    </div>


    <div class="interlineado"></div>

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-1" id="cintillo2" style="margin-top: 3px;">
            IDENTIFICACIÓN:
        </div>
        <div class="col-md-2" id="dato" style="margin-left: 154px;margin-top: -100px; width: 150px;">  
            {{ $user->identificacion }}
        </div>
        <div class="col-md-1" id="cintillo2"style="margin-left: 310px;margin-top: -100px; width: 200px;">
            No. IDENTIFICACIÓN:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 513px;margin-top: -100px; width: 150px;">  
            {{ $user->numero }}
        </div>    
        <div class="col-md-1">  
        </div>                
    </div>

                
            </div>
        
    <br>
    

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-3" id="pestaña" style="background-color: #f8eebc;
                margin-left: 20px;
            color: black;
            padding: 4px;
            text-align:center;    
            width: 250px;      
            border-top-left-radius: 80px;
            border-top-right-radius: 80px;">
            DATOS DEL PROYECTO
        </div>
        <div class="col-md-7">  
        </div>
        <div class="col-md-1">  
        </div>
    </div>
    @foreach ($proyecto as $proyectos)
    <div class="interlineado"></div>
     <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2" style="width: 180px;">
            NOMBRE:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 184px;margin-top: -100px; width: 185px;">  
            {{ $proyectos->proyecto }}
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-left: 374px;margin-top: -100px; width: 180px;">
            CUIDAD:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 558px;margin-top: -100px; width: 185px;">  
            {{ $proyectos->ciudad }}
        </div>                
        <div class="col-md-1">  
        </div>                
    </div>
    @endforeach
    <div class="interlineado"></div>
     <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-top: 3px;width: 220px;">
            VALOR DE LA INVERSIÓN:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 224px;margin-top: -100px; width: 146px;">  
            {{ $inversion->cantidad }}
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-left: 375px;margin-top: -100px; width: 280px;">
            PORCENTAJE MINIMO MENSUAL:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 659px;margin-top: -100px; width: 84px;">  
            {{ $inversion->tasa_mensual }}%
        </div>                
        <div class="col-md-1">  
        </div>                
    </div>    
        
    <div class="interlineado"></div>
     <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-top: 3px;width: 180px;">
            CUENTA CLABE:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 184px;margin-top: -100px; width: 184px;">  
            {{ $inversion->cuenta_pago_rendimientos }}
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-left: 374px;margin-top: -100px; width: 180px;">
            BANCO:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 558px;margin-top: -100px; width: 185px;">  
            {{ $bancoNombre }}
        </div>                
        <div class="col-md-1">  
        </div>                
    </div>                  
        
 <br>
   

    <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-3" id="pestaña" style="background-color: #f8eebc;
                margin-left: 20px;
            color: black;
            padding: 4px;
            text-align:center;    
            width: 250px;      
            border-top-left-radius: 80px;
            border-top-right-radius: 80px;">
            DATOS DE LA INVERSIÓN
        </div>
        <div class="col-md-7">  
        </div>
        <div class="col-md-1">  
        </div>
    </div>

    <div class="interlineado"></div>
     <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2" style="width: 180px;">
            PLAZO DE INVERSIÓN:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 184px;margin-top: -100px; width: 184px;">  
        @if ($plazo == 1)
    {{ $plazo }} AÑO
@else
    {{ $plazo }} AÑOS
@endif
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-left: 374px;margin-top: -100px; width: 200px;">
            DÍA DE PAGO MENSUAL:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 578px;margin-top: -100px; width: 160px;">  
            {{ $fecha }}
        </div>                
        <div class="col-md-1">  
        </div>                
    </div>  
    @foreach ($beneficiarios as $beneficiario)
    <div class="interlineado"></div>
     <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-top: 3px;width: 140px;">
            BENEFICIARIO:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 144px;margin-top: -100px; width: 360px;">  
            {{ $beneficiario->name }}
                    {{ $beneficiario->lastName }}
        </div>
        <div class="col-md-2" id="cintillo2" style="margin-left: 515px;margin-top: -100px; width: 150px;">
            PORCENTAJE:
        </div>
        <div class="col-md-3" id="dato" style="margin-left: 667px;margin-top: -100px; width: 70px;">  
            {{ $beneficiario->porcentaje }}%
        </div>                
        <div class="col-md-1">  
        </div>                
    </div>  
    @endforeach
    <br>
        <div class="row">
        <div class="col-md-1">  
        </div>
        <div class="col-md-10" id="separador">
        
        </div>

        <div class="col-md-1">  
        </div>


    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div>
    <strong> <p class="text-justify
                text-break mt-5">CONTRATO DE MUTUO QUE CELEBRAN POR UNA PARTE <span
                        class="text-uppercase">{{ $empresa->nombre }}</span>, REPRESENTADA POR SU
                    ADMINISTRADOR ÚNICO {{ $inversion->empresa_inversion_id == 1 ? 'MARIA MONSERRAT VILLEGAS MOJARRO' : 'JOSÉ ALFREDO VILLEGAS MOJARRO' }}
                    EN SU CARÁCTER DE MUTUARIO Y POR LA OTRA EL
                    <span class="text-muted text-uppercase">{{ $user->name . ' ' . $user->lastName }}</span> EN SU CARÁCTER DE MUTUANTE, QUIENES PARA LOS EFECTOS 
                    DE ESTE CONTRATO SE LES DENOMINARÁ EL PRESTADOR Y EL CLIENTE RESPECTIVAMENTE.
                </p></strong>
                <h3 class="h3 text-center">DECLARACIONES</h3>
            <p class="text-justify text-break">  <strong>I.</strong> Declara el <strong>PRESTADOR</strong>:</p>
            <p class="text-justify text-break"><strong>a)</strong> {{ $inversion->empresa_inversion_id == 1 ? 'Que es una persona moral, 
                constituida bajo las leyes mexicanas, según lo acredita con la escritura pública número 30,968, volumen 
                1,842, de fecha 08 de febrero del 2019, otorgada ante la Fe del Notario Público número 47 de la demarcación 
                notarial de Aguascalientes, Ags., Dr. Arturo Duran García, cuyo primer testimonio se encuentra inscrito en 
                el Registro Público de la propiedad y del Comercio de la ciudad de Aguascalientes, bajo el Folio Mercantil 
                Electrónico número 2019009793, en fecha 02 de febrero del 2019' : 'Que es una persona moral, constituida bajo 
                las leyes mexicanas, según lo acredita con la escritura pública número 26,058, volumen 1,526, de fecha 14 
                de febrero del 2017, otorgada ante la Fe del Notario Público número 47 de la demarcación notarial de Aguascalientes, 
                Ags., Dr. Arturo Duran García, cuyo primer testimonio se encuentra inscrito en el Registro Público de la 
                propiedad y del Comercio de la ciudad de Aguascalientes, bajo el Folio Mercantil Electrónico número 2017012798, en fecha 16 de febrero del 2017' }} .
            </p>
            <p class="text-justify text-break"><strong>b)</strong> {{ $inversion->empresa_inversion_id == 1 ? 'Que su representante legal la C. 
                María Montserrat Villegas Mojarro se identifica con credencial de elector número 1656601719, quien tiene todas 
                las facultades para celebrar el presente contrato, las cuales no le han sido revocadas o modificadas, según se 
                acredita con el testimonio notarial descrito en el inciso a de estas declaraciones.' : 'Que su representante 
                legal el C. José Alfredo Villegas Mojarro se identifica con credencial de elector número 2245157431, quien 
                tiene todas las facultades para celebrar el presente contrato, las cuales no le han sido revocadas o modificadas, 
                según se acredita con el testimonio notarial descrito en el inciso a de estas declaraciones.' }}</p>
                <p class="text-justify text-break"><strong>c)</strong> {{ $inversion->empresa_inversion_id == 1 ? 'Que tiene por objeto social entre 
                otras actividades las siguientes ramas: Ingeniería en construcción, desarrollo inmobiliario, urbanización, 
                arrendamiento, compra, venta de bienes inmuebles y de materiales y maquinaria, así como la explotación de
                franquicias relativas al sector inmobiliario. ' : 'Que tiene por objeto social entre otras actividades las 
                siguientes ramas: Ingeniería en construcción, desarrollo inmobiliario, urbanización, arrendamiento, compra, 
                venta de bienes inmuebles y de materiales y maquinaria, así como la explotación de franquicias relativas al sector inmobiliario.' }}</p>
            <p class="text-justify text-break"><strong>d)</strong> {{ $inversion->empresa_inversion_id == 1 ? 'Que tiene su domicilio ubicado 
                en Avenida Independencia # 1830 interior 106-A, colonia Jardines de la Concepción II, C.P. 20120, 
                de la ciudad de Aguascalientes, Ags. el cuál en este acto señala para oír y recibir todo tipo de notificaciones 
                y documentos.' : 'Que tiene su domicilio ubicado en Avenida Independencia # 2351 interior 111-B, centro comercial 
                Galerías, Fraccionamiento Trojes de Oriente, C.P. 20120, de la ciudad de Aguascalientes, Ags. el cuál en este acto 
                señala para oír y recibir todo tipo de notificaciones y documentos.' }}</p>
            <p class="text-justify text-break"><strong>e)</strong> {{ $inversion->empresa_inversion_id == 1 ? 'Que está inscrito en el Registro
                Federal de Contribuyentes, con clave CCD190208GL9 como lo acredita la copia simple de su cédula de identificación fiscal.'
                 : 'Que está inscrito en el Registro Federal de Contribuyentes, 
                con clave FCG170214GL3 como lo acredita la copia simple de su cédula de identificación fiscal.' }}</p>
            <p class="text-justify text-break"><strong>f)</strong> Que cuenta con la capacidad, preparación personal, infraestructura material y humana, 
                así como con los equipos suficientes para responder del cumplimiento del objeto de este instrumento.</p>
                <p class="text-justify text-break"><strong>II.</strong> Declara el <strong>CLIENTE</strong>:</p>
            <br>
            <br>
            <p class="text-justify text-break"><strong>a)</strong> Ser una persona física, y que se identifica para la celebración de este Contrato con 
                la Identificación Oficial que previamente ha adjuntado en su perfil de cuenta ubicada en la página web <u>https:\\finverr.com</u>, 
                cuenta en la cual ha creado un registro de sus datos e ingresado con su nombre de usuario y contraseña.</p>
                <p class="text-justify text-break"><strong>b)</strong> Que previamente a la celebración del presente Contrato se registró en la Página 
                    web https:\\finverr.com y que ha explorado, revisado, conoce y acepta los términos y condiciones, avisos legales y 
                    cualquier otra cláusula, declaración, derecho y/u obligación que se describa o contenga en dicha Página, y en el check-box,
                     y/o que le haya sido revelada al momento de registrarse como usuario de la Página, las cuales se tienen por insertadas 
                     literalmente en el presente Contrato.</p>
                <p class="text-justify text-break"><strong>c)</strong> Tener su domicilio referido en la información registrada dentro de su cuenta en la página 
                    web antes señalada, el cual en este acto señala para oír y recibir todo tipo de notificaciones y documentos.</p>
                <p class="text-justify text-break"><strong>d)</strong> Estar inscrito en el registro federal de contribuyentes referido en la información 
                    de perfil de su cuenta en la página web anteriormente señalada
                </p>
                <p class="text-justify text-break"><strong>III.</strong> Declaran <strong>LAS PARTES</strong></p>
                <p class="text-justify text-break"><strong>a)</strong> Que se reconocen mutuamente la capacidad y la personalidad con la que comparecen a la celebración de este instrumento. </p>
                <p class="text-justify text-break"><strong>b)</strong> Que tienen conocimiento y están de acuerdo en que la cantidad entregada en mutuo a través de este Contrato será utilizada 
                con el único fin exclusivo de invertir en los proyectos que desarrolla la sociedad mercantil FINVERR Corporativo Global S.A. de C.V. y también para lograr el 
                 cumplimiento de los objetivos que tiene preestablecidos en su acta constitutiva, por lo que el <strong>CLIENTE</strong> no podrá incidir sobre el destino y uso de la cantidad entregada en mutuo.</p>
                 <p class="text-justify text-break"><strong>c)</strong> Que conocen y comprenden el contenido, naturaleza de este Contrato y que el mismo se celebrade conformidad a la legislación civil 
                aplicable y que no genera ni constituye relación de trabajo entre los contratantes y consecuentemente ninguna obligación derivada de la existencia de una relación o 
                Contrato de trabajo, Contrato que se celebra bajo las siguientes:</p>
                        <h3 class="h3 text-center">CLÁUSULAS</h3>
            <p class="text-justify text-break"><strong>1.- <u>SUSCRIPCIÓN ELECTRÓNICA</u></strong>. Para que el CLIENTE manifieste su voluntad para la celebración del Presente Contrato deberá de ingresar a 
                la página web <u>https:\\finverr.com</u> y realizar los siguientes pasos: <strong>I</strong>. Realizar el correspondiente <strong>REGISTRO</strong> con los datos del <strong>CLIENTE</strong>; <strong>II. INICIAR SESIÓN</strong> en 
                <u>https:\\finverr.com</u> con su correo electrónico e ingresando sus claves personales de identificación; <strong>III</strong>. Completar el Formulario con los datos solicitados; 
                <strong>IV</strong>. Realizar la carga de los Comprobantes correspondientes legibles; <strong>V</strong>. Se realizará una validación de los documentos por parte del <strong>PRESTADOR</strong> para la 
                procedencia de la firma del <strong>CLIENTE</strong>; <strong>VI</strong>. Una vez validada la información por el <strong>PRESTADOR</strong> dentro de las siguientes 72 horas, le harán llegar un correo 
                electrónico a la dirección proporcionada por el <strong>CLIENTE</strong> informándole si fueron APROBADOS o DESAPROBADOS los documentos proporcionados; <strong>VII</strong>. En caso de 
                ser DESAPROBADO, el PRESTADOR le informará al CLIENTE mediante correo electrónico la información que deberá subsanar la documentación y el periodo para 
                realizarlo o si se deshecha el trámite por falta de documentación; <strong>VIII</strong>. En caso de ser APROBADO el <strong>PRESTADOR</strong> le informará al <strong>CLIENTE</strong> mediante correo 
                electrónico para que éste dé CILIC en FIRMAR CONTRATO; <strong>IX</strong>. Para la suscripción del Contrato, el <strong>CLIENTE</strong> deberá ingresar nuevamente su correo electrónico 
                e ingresando sus claves personales de identificación; <strong>X</strong>. Por último, el PRESTADOR le hará llegar la copia del Contrato correspondiente mediante correo 
                electrónico a la dirección señalada por el EL <strong>CLIENTE</strong>.</p>
                <p class="text-justify text-break">Con lo anterior se tiene por cierto y manifestado que ha aceptado los términos y condiciones de la contratación; que 
                    ha leído el check-box y está conforme con el mismo; y que otorga su expresa conformidad y aceptación para realizar la entrega de la Aportación al <strong>PRESTADOR</strong>. 
                    En caso de que el <strong>CLIENTE</strong> no acepte todos los términos y condiciones del presente Contrato, deberá abstenerse de dar clic en el recuadro de aceptación 
                    (“FIRMAR CONTRATO”); lo anterior de conformidad con lo establecido en los artículos 80, 93, 97 y demás aplicables del Código de Comercio y en términos de lo 
                    dispuesto por el artículo 1,803 del Código Civil Federal y demás aplicables en la legislación mexicana.</p>  
                <p class="text-justify text-break">Este Contrato se suscribirá por <strong>LAS PARTES</strong> a través de medios electrónicos, para lo cual cada una de <strong>LAS PARTES</strong> aquí reconocen 
                    que los procesos informáticos utilizados, permiten expresar su voluntad y sus obligaciones en términos de este Contrato y están de acuerdo en que podrán acceder
                     a la información generada para cualquier consulta posterior, en términos de lo establecido en el Código de Comercio. La suscripción del presente Contrato se 
                     llevará a cabo mediante una firma electrónica que cumple con los requisitos señalados en el artículo 97 y demás aplicables del Código de Comercio, y la 
                      cual se verificará por medio del código en cadena que se genere por el simple hecho de hacer clic en los botones de aceptación que se presenten dentro de 
                      la página web mencionada, considerando que el <strong>PRESTADOR</strong> tiene la capacidad de establecer un sistema electrónico de acceso para el <strong>CLIENTE</strong> y entregarle 
                      una clave de usuario y acceso. Dicha clave, junto con los números de identificación personal (contraseña) determinados por el propio <strong>CLIENTE</strong>, lo 
                      identifican como el firmante y le corresponden exclusivamente, además de que le permiten detectar cualquier alteración a la firma y a la integridad 
                      de la información del mensaje de datos hecha con posterioridad. Los medios electrónicos autorizados para ser utilizados en el presente Contrato tendrán 
                      la misma validez que los medios físicos y/o autógrafos.</p>  
                      <p class="text-justify text-break"><strong>2.- <u>OBJETO</u></strong>. El <strong>PRESTADOR</strong> se obliga a aceptar del <strong>CLIENTE</strong> un préstamo para inversión por la cantidad 
                        de <strong><u>{{ $inversion->cantidad }} ({{ $montoLetras }}) </u></strong>para invertir en los proyectos que se encuentran desarrollándose por 
                        el <strong>PRESTADOR</strong> y se están llevando a cabo de conformidad con su objeto social y en consecuencia, el <strong>CLIENTE</strong> no podrá incidir de forma alguna en los proyectos 
                        ni variar éstos en lo sustantivo o accidental ya que se encuentran dentro de las metas que le corresponden al PRESTADOR. Asimismo, a partir de la solicitud 
                        del Contrato de manera digital se tendrá <u>UN DÍA HÁBIL</u> para realizar el depósito o trasferencia bancaria del monto establecido por el Usuario mismo en el
                Contrato Mutuo con Interés suscrito con el <strong>PRESTADOR</strong>, de lo contrario tal Contrato quedará nulificado completamente, sin perjuicio para Finverr Corporativo 
                Global S.A. de C.V., en este sentido el <strong>CLIENTE</strong> deberá adjuntar en la página web mencionada el ticket, comprobante de transferencia o depósito bancario legibles,
                según corresponda, en caso de que dicho comprobante no sea legible el <strong>PRESTADOR</strong> le informará al <strong>CLIENTE</strong> para que este para que lo exhiba adecuadamente, por 
                lo que en tanto no exhiba   .</p> 
                <p class="text-justify text-break"> La cantidad anterior fue entregada al <strong>PRESTADOR</strong> de la siguiente manera:
                    <br>
                    <ul>
                    <strong> {!! $textoProcedenciaStr !!}</strong>
                    </ul>
                </p> 
                <p class="text-justify text-break">
                <strong>3.- <u>INTERESES ORDINARIOS.</u></strong> El <strong>PRESTADOR</strong> se obliga a pagar un porcentaje al <strong>CLIENTE</strong> del <strong><u>{{ $inversion->tasa_mensual }}</u></strong>% 
                mensual de intereses sobre la cantidad que el <strong>CLIENTE</strong> entregó en mutuo y 
                el cual será pagado el día {{ $fecha }} de cada mes (en caso de que el dicho día {{ $fecha }} sea fin de semana o día inhábil el <strong>PRESTADOR</strong> podrá hacer el pago en un plazo máximo de 5 días 
                a partir de esa fecha) mediante transferencia electrónica a la cuenta señalada por el <strong>CLIENTE</strong> en la carátula del presente Contrato; por lo que el <strong>PRESTADOR</strong> se obliga a 
                mandar el comprobante correspondiente de dicha transferencia como recibo de pago al correo electrónico señalado por el <strong>CLIENTE</strong> en la carátula del Contrato.
                </p>
                <p class="text-justify text-break">
                <strong>4.- <u>VIGENCIA.</u></strong> <strong>LAS PARTES</strong> acuerdan que el presente Contrato tiene una <strong>duración forzosa de
@if ($plazo == 1)
    {{$plazo}} año,
@else
    {{$plazo}} años,
@endif</strong>a partir de la firma electrónica, la cual se realiza a través de la página web <u>https://finverr.com</u> por medio del procedimiento indicado en la Cláusula 1.-. Al concluir este Contrato, el <strong>CLIENTE</strong> recibirá la devolución íntegra de su 
            inversión mediante transferencia electrónica dentro de los 30 días posteriores a su expiración de la misma manera que le fue entregada al <strong>PRESTADOR</strong>. Al término de la 
            vigencia, el <strong>CLIENTE</strong> podrá optar por dar por terminado el <strong>CONTRATO</strong> o solicitar su ampliación mediante el procedimiento enunciado en la siguiente Cláusula.
                </p>
                <p class="text-justify text-break">
                <strong>5.- <u>PROCEDIMIENTO DE AMPLIACIÓN DE LA VIGENCIA.</u></strong> Para el caso que el <strong>CLIENTE</strong> decida ampliar la vigencia del presente Contrato deberá manifestar su voluntad por lo 
                menos 30 días hábiles antes del vencimiento hasta 01 día hábil antes del vencimiento ingresando a la página web <u>https:\\finverr.com</u> y realizar los siguientes pasos: 
                <strong>I. INICIAR SESIÓN</strong> en <u>https://finverr.com</u> con su correo electrónico e ingresando sus claves personales de identificación; <strong>II.</strong> Ingresar al apartado de DATOS, 
                posteriormente desplegar la pestaña de INFORMACIÓN y dar CLIC en INVERSIONES; <strong>III.</strong> Dar Clic en REINVERTIR; <strong>IV.</strong> Llenar el formulario con los datos para la 
                ampliación de la vigencia y confirmar la ampliación dando clic en la ventanilla de SI, REINVERTIR; <strong>V.</strong> El <strong>PRESTADOR</strong> enviará un correo electrónico a la 
                dirección señalada por el <strong>CLIENTE</strong> para que éste dé CILIC en FIRMAR ADENDUM;<strong> VI.</strong> Para la suscripción del Adendum, el <strong>CLIENTE</strong> deberá ingresar nuevamente 
                su correo electrónico e ingresando sus claves personales de identificación; <strong>VII.</strong> Por último, el <strong>PRESTADOR</strong> le hará llegar la copia del Adendum de Ampliación de 
                vigencia correspondiente mediante correo electrónico</strong> a la dirección señalada por el <strong>CLIENTE.
        </p>
        <p class="text-justify text-break">Con lo anterior se tiene por cierto y manifestado que ha aceptado los términos y 
            condiciones de la cancelación; que ha leído el check-box y está conforme con el mismo; y que otorga su expresa conformidad y 
            aceptación para realizar la Cancelación del Contrato. En caso de que el <strong>CLIENTE</strong> no acepte todos los términos y condiciones del presente Contrato, deberá 
            abstenerse de dar clic en el recuadro de aceptación (REINVERTIR); lo anterior de conformidad con lo establecido en los artículos 80, 93, 97 y demás aplicables 
            del Código de Comercio y en términos de lo dispuesto por el artículo 1,803 del Código Civil Federal y demás aplicables en la legislación mexicana.
        </p>
        <p class="text-justify text-break"><strong>6.- <u>TERMINACIÓN ANTICIPADA.</u> LAS PARTES</strong> acuerdan que son causas de terminación del presente Contrato:
            <br><br>
            <strong>a)</strong> La expiración del Plazo convenido.
            <br><br>
            <strong>b)</strong> En cualquier caso, en el que se vean afectados los intereses del <strong>PRESTADOR</strong>, ya sea previsto en la ley o en este Contrato.
            <br><br>
            <strong>c)</strong> Si el <strong>CLIENTE</strong> no cubriere cualquier responsabilidad fiscal derivada del presente Contrato dentro de los diez días siguientes a la notificación que haga la autoridad correspondiente.
            <br><br>
            <strong>d)</strong> Si el <strong>CLIENTE</strong> falta el cumplimiento EXACTO de cualquiera de las obligaciones contraídas.
            
        </p>
        <p class="text-justify text-break">
                <strong>e)</strong> En todos los demás casos en que, conforme a la ley, deban darse por vencidos anticipadamente las obligaciones a plazo.
                <br><br>
                <strong>f)</strong> Por mutuo acuerdo y mediante convenio de recisión firmado.
                    <br><br>
                    <strong> g)</strong> Por la Cancelación a solicitud del <strong>CLIENTE</strong> por el medio especificado en la Cláusula siguiente.

                </p>
                <p class="text-justify text-break">
                <strong>7.- <u>PROCEDIMIENTO DE CANCELACIÓN:</u></strong> Para que el <strong>CLIENTE</strong> manifieste que es su voluntad dar por terminado el Contrato conforme al inciso g) 
                de la Cláusula anterior, deberá de ingresar a la página web <u>https:\\finverr.com</u> y realizar los siguientes pasos: <strong>I. INICIAR SESIÓN</strong> en 
                <u>https:\\finverr.com</u> con su correo electrónico e ingresando sus claves personales de identificación; <strong>II.</strong> Ingresar al apartado de DATOS, 
                posteriormente desplegar la pestaña de INFORMACIÓN y dar CLIC en INVERSIONES; <strong>III.</strong> Dar Clic en CANCELAR CONTRATO; <strong>IV.</strong> Confirmar la 
                Cancelación dando clic en la ventanilla de SI, CANCELAR; <strong>V.</strong> El <strong>PRESTADOR</strong> enviará un correo electrónico a la dirección señalada por el 
                <strong>CLIENTE</strong> para que éste dé CLIC en FIRMAR CONVENIO DE CANCELACIÓN; <strong>VI.</strong> Para la suscripción del Convenio, el <strong>CLIENTE</strong> deberá ingresar 
                nuevamente su correo electrónico e ingresando sus claves personales de identificación; <strong>VII.</strong> Por último, el <strong>PRESTADOR</strong> le hará llegar 
                la copia del Convenio de Terminación correspondiente mediante correo electrónico a la dirección señalada por el <strong>CLIENTE</strong>. 
                </p>
                <p class="text-justify text-break">
                Con lo anterior se tiene por cierto y manifestado que ha aceptado los términos y condiciones de la cancelación; que ha leído el check-box y está conforme con el mismo; y 
            que otorga su expresa conformidad y aceptación para realizar la Cancelación del Contrato. En caso de que el <strong>CLIENTE</strong> no  acepte todos los términos y condiciones del presente
                 Contrato, deberá abstenerse de dar clic en el recuadro de aceptación (CANCELAR CONTRATO); lo anterior de conformidad con lo establecido en los artículos 80, 93, 97 y 
                 demás aplicables del Código de Comercio y en términos de lo dispuesto por el artículo 1,803 del Código Civil Federal y demás aplicables en la legislación mexicana.
                </p>
                <p class="text-justify text-break">
                <strong>8.- <u>PENAS CONVENCIONALES.</u> LAS PARTES</strong> están de acuerdo que, si el <strong>CLIENTE</strong> cancela el presente Contrato conforme al inciso g) de la Cláusula 5.-, 
                y una vez concluido el proceso para Cancelación Electrónica, el <strong>PRESTADOR</strong> por concepto de penalización, el <strong>CLIENTE</strong> pagará el <strong>30% 
                (TREINTA POR CIENTO)</strong> de la cantidad entregada en mutuo, así como también la cantidad que resulte de la multiplicación de los intereses a 
                razón del <u>{{ $inversion->tasa_mensual }}</u>% sobre la cantidad entregada en mutuo, por los meses que faltaren para el cumplimiento del plazo del presente Contrato por 
                concepto de PENA CONVENCIONAL.
                </p>
                <p class="text-justify text-break">
                Asimismo, el <strong>CLIENTE</strong> está de acuerdo en que el <strong>PRESTADOR</strong>, podrá retener la(s) cantidad(es) entregada(s) por concepto del (los) BONO(S) y/o 
                PROMOCIÓN(ES), al(los) que el <strong>CLIENTE</strong>, fuera acreedor durante el plazo que dure este Contrato.
                </p>
                <p class="text-justify text-break">
                <strong>9- <u>FALLECIMIENTO DEL CLIENTE.</u></strong> En caso de fallecimiento del <strong>CLIENTE</strong>, quedará como beneficiario la y/o las personas que nombró en la carátula 
                del presente Contrato, las  
                </p>
                <p class="text-justify text-break">
            cuales quedaran sujetas a la vigencia de este y al finalizar el mismo, se realizará la devolución de la inversión 
            inicial en los porcentajes que corresponda al o los beneficiarios designados por el <strong>CLIENTE</strong> y que acrediten fehacientemente y/o mediante 
                radicación testamentaria y/o resolución judicial, ser el o los legítimo(s) heredero(s).
                </p>
            <p class="text-justify text-break">
            <strong>10.- <u>OBLIGACIONES FISCALES.</u> LAS PARTES</strong> darán cumplimiento a sus respectivas obligaciones fiscales en los términos de las leyes tributarias 
                aplicables. Asimismo, el <strong>CLIENTE</strong> se hace responsable por el incumplimiento de cualquier obligación a su cargo de carácter fiscal o administrativa, 
                local o federal, que sea consecuencia del cumplimiento de las obligaciones que contrae en este Contrato.
                </p>
                <p class="text-justify text-break">
                <strong>11.- <u>PREVENCIÓN DE LAVADO DE ACTIVOS Y FINANCIACIÓN DEL TERRORISMO.</u></strong> En atención a los establecido por el artículo 17 fracción IV de la Ley Federal 
                    para la Prevención e Identificación de Operaciones Con Recursos De Procedencia Ilícita, en referencia al ofrecimiento habitual de los Servicios de 
                    Mutuo entre particulares, el <strong>PRESTADOR</strong> a entera conformidad del <strong>CLIENTE</strong>, verificó la identidad basándose en credenciales o documentación oficial, 
                    así como recabo copia de dicha documentación; también le solicitó información acerca de si tiene conocimiento de la existencia del dueño beneficiario 
                    y, en su caso, le solicitó que exhiba la documentación oficial que permita identificarlo; además para los casos en que se establezca una relación de 
                    negocios, se le solicitó información sobre su actividad u ocupación y se le consultó en los listados y/o bases de datos de las autoridades competentes 
                    a fin de cerciorarse que no cuenta con algún reporte o vínculo de alguna actividad ilícita relacionada con la obtención de recursos de manera ilícita, 
                    lavado de dinero o financiamiento del terrorismo.
                </p>
                </p>
            <p class="text-justify text-break">
                    Asimismo, el <strong>CLIENTE</strong> manifiesta bajo protesta de decir la verdad, que los recursos que entrega en el presente instrumento, y que se componen de su 
                    patrimonio no provienen de lavado de activos, financiación del terrorismo, narcotráfico, captación ilegal de dinero y en general de cualquier actividad 
                    ilícita; de igual manera manifiesta el <strong>PRESTADOR</strong> que los recursos recibidos en este Contrato no serán destinados a ninguna de las actividades antes descritas.
                    </p>
                    <p class="text-justify text-break">
                    En caso de que después de la firma del presente Contrato, se hiciera evidente que el <strong>CLIENTE</strong> ocultara información, o proporcionó información errónea y/o 
                    contara con un reporte o apareciera en alguna de las listas antes mencionadas, el <strong>PRESTADOR</strong>, podrá rescindir de manera unilateral el presente Contrato. 
                    En este acto el <strong>CLIENTE</strong> autoriza al <strong>PRESTADOR</strong> para que realice las retenciones correspondientes de la cantidad dada en mutuo para el pago de las PENAS 
                    CONVENCIONALES, en caso de aplicar.
                    </p>
                    <p class="text-justify text-break">
                    <strong>12.- <u>VERACIDAD DE DATOS.</u> LAS PARTES</strong> acuerdan que en caso de que los datos ingresados como propios del <strong>CLIENTE</strong> dentro de este Contrato, sean distintos a 
                    los datos de propietario de la cuenta bancaria de la cual se transfirieron los fondos a invertir a el <strong>PRESTADOR</strong> por motivo de este Contrato, quedará 
                    automáticamente rescindido el presente instrumento, sin perjuicio para el <strong>PRESTADOR</strong>. Por lo que los fondos transferidos serán devueltos a la cuenta de
                    origen de la que fueron recibidos dentro de los tres días hábiles bancarios siguientes al día de recepción del dinero por el <strong>PRESTADOR.
                    </p>
                    <p class="text-justify text-break">   
                    <strong>13.- <u>JURISDICCIÓN.</u> LAS PARTES</strong> están de acuerdo en que lo no previsto, se aplique lo dispuesto por el Código Civil del Estado de Aguascalientes, en 
                    lo relativo al Título V capítulo I y II referente al Contrato de Mutuo con Interés, así como del Código de Comercio en el título correspondiente, y 
                    que en caso de controversia o conflicto sobre la interpretación, aplicación y alcances de este Contrato se sometan a la jurisdicción de los tribunales 
                    de la ciudad de Aguascalientes.
                    </p>
                    <p class="text-justify text-break">
                    <strong> 14.- <u>MANIFESTACIÓN DE LA VOLUNTAD.</u> LAS PARTES</strong> manifiestan que conocen y aprueban el contenido y alcances de este instrumento, por lo que hace clic 
                    en el recuadro de aceptación <strong>(FIRMAR CONTRATO)</strong>, como prueba eficaz de su pleno y total consentimiento, expresando que en él no ocurre violencia 
                    física o moral, coacción o vicio alguno de la voluntad.
                    </p>
                    <p class="text-justify text-break">En Aguascalientes, Aguascalientes, el día <u>{{ $fecha_inicio }}</u>
            </p>
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
