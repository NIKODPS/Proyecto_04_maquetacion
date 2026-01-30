<?php

// recibir el valor del parámetro, y comprobar si es vacío o no, y devolver true si es vacío y false en caso contrario.
function comprobarVacio($param1){
    
    if(empty($param1)){
        return true;
    }else{
        return false;
    }    
}


// Una función para comprobar si es mayor que un valor y menor que otro valor y devolver true si no cumple esa condición y false si la cumple.
function comprobarCaracteres($param1, $param2, $param3){
    $caracteres = strlen($param1);
    if($caracteres < $param2 || $caracteres > $param3){
        return true;
    }else{
        return false;
    }
}

// Función para comprobar si la extructura del correo recibidpo a través de lparam1, es acorde a la expresión regular. En caso de que sea diferente, revolveremos false y si es correcta, devolvemos true.
function comprobarEmailSintaxis($param1){
    $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($regex, $param1);
}

