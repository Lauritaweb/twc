<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['tel'];
    
    // Dirección de correo electrónico a la que quieres enviar el formulario
    $destinatario = "laheavy@gmail.com";
    
    // Asunto del correo electrónico
    $asunto = "Nuevo formulario enviado desde tu sitio web";
    
    // Construye el cuerpo del mensaje
    $mensaje = "Nombre: $nombre\n";
    $mensaje .= "Email: $email\n";
    $mensaje .= "Teléfono: $telefono\n";
    
    // Cabeceras del correo electrónico
    $headers = "From: $email";
    
    // Envía el correo electrónico
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        // Mostrar la alerta de SweetAlert
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script>';
        echo 'swal("¡Envío exitoso!", "El formulario ha sido enviado exitosamente.", "success").then(function() { window.location = "tu_pagina.php"; });';
        echo '</script>';
    } else {
        echo "Hubo un error al enviar el formulario.";
    }
} else {
    // Si el método de solicitud no es POST, redirige al formulario
    header("Location: formulario.html");
}
?>
