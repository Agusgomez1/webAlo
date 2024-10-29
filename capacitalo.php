<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizar
    $workshop_name = htmlspecialchars($_POST['workshop_name']);
    $workshop_date = htmlspecialchars($_POST['workshop_date']);
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);

    // Validar correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: capacitalo.html?status=error&message=invalid_email");
        exit;
    }

    // Correo destino
    $to = "info@alo-eventos.com.ar"; // Reemplaza con tu dirección de correo
    $subject = "Inscripción al $workshop_name";

    // Cuerpo del correo en formato HTML
    $message = "
    <html>
    <head>
      <title>Inscripción al Workshop</title>
      <style>
          body { font-family: Arial, sans-serif; line-height: 1.6; }
          h2 { color: #333; }
          p { color: #555; }
      </style>
    </head>
    <body>
      <h2>Datos de inscripción</h2>
      <p><strong>Workshop:</strong> $workshop_name</p>
      <p><strong>Fecha:</strong> $workshop_date</p>
      <p><strong>Nombre del cliente:</strong> $name</p>
      <p><strong>Correo electrónico:</strong> $email</p>
      <p><strong>Teléfono:</strong> $phone</p>
    </body>
    </html>
    ";

    // Encabezados del correo
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Enviar el correo
    if (mail($to, $subject, $message, $headers)) {
        // Redirigir a capacitalo.html con un mensaje de éxito
        header("Location: capacitalo.html?status=success");
        exit;
    } else {
        // Redirigir a capacitalo.html con un mensaje de error
        header("Location: capacitalo.html?status=error");
        exit;
    }
}
?>

