<?php
define("MAIL_NAME_CONTACT", "TWC");
define("MAIL_ADDRESS_CONTACT", "commercial@twc.com.ar");
define('MAILJET_API_KEY', 'c90ee4c8e3dd0f14a4e6338a970fa1db:8c8d0fac35d91213d2201d32daaa40f3');


// Recoge los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['tel'];

// Dirección de correo electrónico a la que quieres enviar el formulario
$destinatario = "laheavy@gmail.com";

//  Asunto del correo electrónico
$asunto = "Nuevo formulario enviado desde tu sitio web";

// Construye el cuerpo del mensaje
$mensaje = "Nombre: $nombre\n";
$mensaje .= "Email: $email\n";
$mensaje .= "Teléfono: $telefono\n";


// Envía el correo electrónico
if (mandarmail($destinatario, $asunto, $mensaje, ))
    echo "Enviado";
else 
    echo "Hubo un error al enviar el formulario.";
    

function mandarmail($email, $subject, $message){
    
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => MAIL_ADDRESS_CONTACT,
                    'Name' => MAIL_NAME_CONTACT
                ],
                'To' => [
                    [
                        'Email' => devolverValorLimpio($email),
                        'Name' => devolverValorLimpio($email)
                    ]
                ],
                'Subject' => $subject,
                'HTMLPart' => $message
            ]
        ]
    ];

    
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, MAILJET_API_KEY);
    $server_output = curl_exec($ch);
    curl_close ($ch);
    
    $response = json_decode($server_output);

    $status= $response->Messages[0]->Status == 'success';

    return $status;
}

function devolverValorLimpio($valorSeguro) {
    return str_replace('\'', '', $valorSeguro);
}
?>
