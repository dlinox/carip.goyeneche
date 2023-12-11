<!-- email template en blade para el recupero de contraseña -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
</head>

<body>
    <h2>Recuperar contraseña</h2>
    <p>Hola {{ $user->name }},</p>
    <p>Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.</p>
    <p>Por favor, haz click en el siguiente enlace para cambiar tu contraseña:</p>
    <a href="{{ url('/auth/reset-password/' . $token) }}">Cambiar contraseña</a>
    
    <p>Si no solicitaste un cambio de contraseña, no es necesario que realices ninguna acción.</p>
</body>

</html>