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
// enviar un correo al admin de la web
// recoger más variables que necesita el phpMailer:correo emisor y el nombre emisor,el correo receptor y su nombre, título del correo
$urlWeb = "http://localhost:3000";
$correoEmisor =$_ENV['EMAIL_WEB'];
$nombreEmisor ="Web Panadería";
$correoDestinatario = $_ENV['EMAIL_ADMIN'];
$nombreDestinatario= "Admin de la web";
$asunto = "Has recibido una nueva consulta en la web de $nombre";
$cuerpo =
'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$asunto.'</title>
</head>
<body>
    <!-- LOGO -->
    <a href="'.$urlWeb.'" target="_blank" style="text-decoration:none;border:0;">
        <img src="cid:reflogotipo" width="150" style="display:block;border:0;outline:none;text-decoration:none;height:auto;" alt="{web}">
    </a>
    <h1>Hola '.$nombreDestinatario.'</h1>
    <p>Has recibido una nueva consulta de '.$nombre.', a continuación dispones de sus datos de contacto y su mensaje:</p>

    <ul>
        <li>Nombre: '.$nombre.'</li>
        <li>Teléfono: '.$telefono.'</li>
        <li>Correo: '.$email.'</li>
        <li>Mensaje: '.$mensaje.'</li>
    </ul>

    <p>Muchas gracias, equipo web</p>
</body>
</html>
';
// $cuerpo='
// <!DOCTYPE html>
// <html lang="es">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>'.$asunto.'</title>
// </head>
// <body align="center" style="padding: 1.5rem;background-color: rgb(255, 227, 227);">
//     <h1>Has recibido un nuevo mensaje de '.$nombre.'</h1>
//     <p>Estos son los datos que hemos recibido en la web de <a href="https://profe.webda.eus/proyecto05/">profe.webda.eus/proyecto05</a> de la consulta del usuario:</p>
//     <table align="center">
//         <tr>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">Nombre:</td>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">'.$nombre.'</td>
//         </tr>
//         <tr>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">Teléfono:</td>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">'.$telefono.'</td>
//         </tr>
//         <tr>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">Correo Electrónico:</td>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">'.$email.'</td>
//         </tr>
//         <tr>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">Consulta:</td>
//             <td align="left" style="background-color: white;padding: 0.5rem 1rem;border: 1px solid black">'.$mensaje.'</td>
//         </tr>
//     </table>

//     <p>Un saludo</p>
//     <p>Equipo de Panadería Agianga</p>
    

// </body> 
// </html>
// ';


include "./envioPhpMailer.php";


// 4 guardar los datos en una bbdd



// 5 redirigir a la página gracias
// urlencode evita romper la cabecera si el nombre lleva espacios o acentos

$nombreUrl = urlencode($nombre);
header("location:/gracias.php?nom=$nombreUrl");
die;


?>
