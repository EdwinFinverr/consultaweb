<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <hi>Documentos desaprobados</hi>
    <p>Su inversión no se ha podido completar ya que alguno de los documentos no ha cumplido con la validación, por
        favor intente anexar el documento en cuestión tomando en cuenta las observaciones presentadas.

    <p>Observación:
        @if ($reason == '1')
            Mala calidad
        @elseif ($reason == '2')
            No es el documento correcto
        @elseif ($reason == '3')
            Falta documentación
        @endif
    </p>

    <p>{{ $comentarios }}</p>

    <p>Instrucciones para actualizar documentos:</p>

    <ol>
        <li>Entrar a la Plataforma de inversión.</li>
        <li>Ingresar con su usuario.</li>
        <li>Dirigirse al menú superior y dar clic en "Datos".</li>
        <li>Una vez en la ventana de datos, poner el cursor sobre el botón "Información" para desglosar un submenú con opciones.</li>
        <li>Dar clic en la opción Documentos para abrir el formulario de actualización.</li>
        <li>Seleccionar el archivo a actualizar y dar clic en Registrar.</li>
        <li>Cerrar sesión una vez actualizado el documento en cuestión.</li>
    </ol>

    <p>Por favor, NO responda a este mensaje, es un envío automático. (Please, do not answer this message, it is an
        automatic sending)</p>
</body>

</html>

