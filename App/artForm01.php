<?php

require_once '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable('../');
$dotenv->load();


// zona de incluir recursos
include '../config/helpers.php';



// aquí voy a gestionar lo que reciba del formulario

// 1 recibir los datos del formulario a través de POST y meto los value en nuevas variables que usaré aquí


if(comprobarVacio($_POST['terminos'])){
    // Como viene vacía, redirijo a la página de contacto
    // echo "Hay un error pues no ha aceptado las condiciones de privacidad";
    header('location:/?error=condiciones');
    die;
}else{
    $terminos = $_POST['terminos'];
}


// // comprobación de términos
// if(empty($_POST['terminos'])){
//     // Como viene vacía, redirijo a la página de contacto
//     // echo "Hay un error pues no ha aceptado las condiciones de privacidad";
//     header('location:/?error=condiciones');
//     die;
// }else{
//     $terminos = $_POST['terminos'];
// }


// comprobación de captcha
$respUser = $_POST['respUser'];
$respSystem = $_POST['respSystem'];
// que venga vacío
if(!isset($respUser)){
    header('location:/?error=captchaVacio');
    die;  
}


// que la respuesta sea errónea
if($respUser != $respSystem){
    header('location:/?error=captchaError');
    die; 
}

// Recoger el resto de valores del form
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

// Zona de comprobaciones DEV
// echo $nombre.'<br>'.$telefono.'<br>'.$email.'<br>'.$mensaje.'<br>'.$terminos.'<br>'.$respUser.'<br>'.$respSystem;


// 2 comprobar que los datos son correctos.
// que nombre venga vacío, salimos
if(comprobarVacio($nombre)){
    header('location:/?error=nombreVacio');
    die;
}
// // que nombre sea menor de 3 y mayor de 40, salimos
if(comprobarCaracteres($nombre, 3, 40)){
    header('location:/?error=nombreCaracteres');
    die; 
}

// que teléfono venga vacío, salimos
if(comprobarVacio($telefono)){
    header('location:/?error=telefonoVacio');
    die; 
}

// que correo venga vacío, salimos
if(comprobarVacio($email)){
    header('location:/?error=emailVacio');
    die; 
}

// // que correo no tenga la forma de un correo, salimos (expresión regular)
if(!comprobarEmailSintaxis($email)){
    header('location:/?error=emailSintaxis');
    die;
}

// que mensaje venga vacío, salimos
if(comprobarVacio($mensaje)){
    header('location:/?error=mensajeVacio');
    die; 
}
// // que mensaje sea menor de 4 y mayor de 200, salimos
if(comprobarCaracteres($mensaje, 4, 200)){
    header('location:/?error=mensajeCaracteres');
    die; 
}

// 3 enviar correos de aviso: a la empresa y al propio usuario

// 3.1 enviar un correo al ADMIN DE LA WEB
// recoger más variables que necesita el phpMailer:correo emisor y el nombre emisor,el correo receptor y su nombre, título del correo
$urlWeb = "http://localhost:3000";
$correoEmisor =$_ENV['EMAIL_WEB'];
$nombreEmisor ="Web Panadería";
$correoDestinatario = $_ENV['EMAIL_ADMIN'];
$nombreDestinatario= "Admin de la web";
$asunto = "Has recibido una nueva consulta en la web de $nombre";

// recoger el template con los placeholders
$html = file_get_contents('./templates/artForm01.html');
// dar el cambiazo a los placeholders por valores definitivos

// array asociativo de las relaciones de placeholders con los valores que tendrá para este correo
$vars = [
    '{url}'                 => $urlWeb,
    '{asunto}'              => $asunto,
    '{aviso}'               => "Has recibido un correo pidiendo información de $nombre. A continuación sus datos. Ha aceptado los términos de privacidad. ",
    '{explicacion}'         => "Has recibido un correo pidiendo información de $nombre. A continuación sus datos. Ha aceptado los términos de privacidad. ",
    '{contexto}'                => 'El cliente es ',
    '{razon}'               => 'Si quieres responderle, escríbele al correo que facilita a continuación',
    '{nombre}'              => $nombre,
    '{telefono}'            => $telefono,
    '{email}'               => $email,
    '{mensaje}'                 => $mensaje,
    '{responder}'           => 'Procura responder dentro del plazo de 2 días',

];

$cuerpo = str_replace(array_keys($vars), array_values($vars), $html);

include "./envioPhpMailer.php";


// 3.1 enviar un correo al ADMIN DE LA WEB
// recoger más variables que necesita el phpMailer:correo emisor y el nombre emisor,el correo receptor y su nombre, título del correo
$urlWeb = "http://localhost:3000";
$correoEmisor =$_ENV['EMAIL_WEB'];
$nombreEmisor ="Web Panadería";
$correoDestinatario = $_ENV['EMAIL_ADMIN'];
$nombreDestinatario= "Admin de la web";
$asunto = "Has recibido una nueva consulta en la web de $nombre";

// recoger el template con los placeholders
$html = file_get_contents('./templates/artForm01.html');
// dar el cambiazo a los placeholders por valores definitivos

// array asociativo de las relaciones de placeholders con los valores que tendrá para este correo
$vars = [
    '{url}'                 => $urlWeb,
    '{asunto}'              => $asunto,
    '{aviso}'               => "Has recibido un correo pidiendo información de $nombre. A continuación sus datos. Ha aceptado los términos de privacidad. ",
    '{explicacion}'         => "Has recibido un correo pidiendo información de $nombre. A continuación sus datos. Ha aceptado los términos de privacidad. ",
    '{contexto}'                => 'El cliente es ',
    '{razon}'               => 'Si quieres responderle, escríbele al correo que facilita a continuación',
    '{nombre}'              => $nombre,
    '{telefono}'            => $telefono,
    '{email}'               => $email,
    '{mensaje}'                 => $mensaje,
    '{responder}'           => 'Procura responder dentro del plazo de 2 días',

];

$cuerpo = str_replace(array_keys($vars), array_values($vars), $html);

include "./envioPhpMailer.php";


// 4 guardar los datos en una bbdd



// 5 redirigir a la página gracias
// urlencode evita romper la cabecera si el nombre lleva espacios o acentos

$nombreUrl = urlencode($nombre);
header("location:/gracias.php?nom=$nombreUrl");
die;


?>
