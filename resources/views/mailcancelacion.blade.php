<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cancelación</title>
</head>
<body>
    <p>Estimado usuario hemos recibido su solicitud para la cancelacion del Contrato con folio {{ $inversion->folio }}</p>
    <p> Lamentamos mucho su decisión, le recordamos que, de conformidad con la Cláusula 8.- PENAS CONVENCIONALES, 
    se realizará la palicación correspondiente al 30% de su inversión + la cantidad que resulte de la multiplicación de los intereses a 
    razón del <u>{{ $inversion->tasa_mensual }}</u>% sobre la cantidad entregada en mutuo, por los meses que faltaren para el cumplimento del plazo del presente Contrato; dicha cantidad que 
se debera corroborar en la oficina de Inversiones directamente
</p>



    <p>Para continuar con su proceso de cancelacion de su Contrato dar clic <a href="{{ route('cancelar') }}">aquí. FIRMAR</a></p>




</body>
</html>
