<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario y sanitizar
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars($_POST['telefono']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Validar correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?status=error&message=invalid_email");
        exit;
    }

    // Correo electrónico de destino
    $destino = "info@alo-eventos.com.ar"; // Reemplaza con tu dirección de correo

    // Asunto del correo
    $asunto = "Nueva consulta de $nombre";

    // Contenido del mensaje en formato HTML
    $contenido = "
    <html>
    <head>
        <title>Nueva Consulta de Contacto</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            h2 { color: #333; }
            p { color: #555; }
            .info { margin-bottom: 20px; }
            .info strong { display: inline-block; width: 100px; }
        </style>
    </head>
    <body>
        <h2>Nueva Consulta de Contacto</h2>
        <div class='info'>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Teléfono:</strong> $telefono</p>
        </div>
        <div>
            <h3>Mensaje:</h3>
            <p>$mensaje</p>
        </div>
    </body>
    </html>
    ";

    // Cabeceras adicionales
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n" .
                "Reply-To: $email" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();

    // Enviar el correo
    if (mail($destino, $asunto, $contenido, $headers))  {
        // Redirigir a la página principal con un mensaje de éxito
        header("Location: index.html?status=success");
        exit;
    } else {
        // Redirigir a la página principal con un mensaje de error
        header("Location: index.html?status=error");
        exit;
    }
}
?>
