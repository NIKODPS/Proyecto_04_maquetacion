<?php


// prueba de crear variables
$mensaje = "Enviado con éxito";
$fallo = false;

// creación de array asociativo
$arrayRespuesta = array(
    'mensaje' => $mensaje,
    'fallo' => $fallo
);

// crear un json del array
$jsonDelArray = json_encode($arrayRespuesta); 

// devolvemos el json (lo recogerá ajax en el responseText)
echo $jsonDelArray; 
die;