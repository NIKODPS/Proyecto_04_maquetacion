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

function enviarRespuestaAsincrona($mensaje, $fallo, $param3){
   
    // creación de array asociativo
    $arrayRespuesta = array(
        'mensaje' => $mensaje,
        'fallo' => $fallo,
        'param3' => $param3
    );

    // crear un json del array
    $jsonDelArray = json_encode($arrayRespuesta); 

    // devolvemos el json (lo recogerá ajax en el responseText)
    echo $jsonDelArray; 
    die;
}


// ------------- de aquí hacia abajo copiar en vuestro proyecto

// Indica si estamos en modo desarrollo (APP_ENV=dev).
function vite_is_dev(){
    $env = strtolower($_ENV['APP_ENV'] ?? getenv('APP_ENV') ?? '');
    return in_array($env, ['dev', 'development', 'local'], true);
}

// Devuelve el prefijo base del proyecto segun la URL actual.
// Ej: /proyecto04/index.php -> /proyecto04
function vite_base_path(){
    $script = $_SERVER['SCRIPT_NAME'] ?? '/';
    $dir = str_replace('\\', '/', dirname($script));
    return rtrim($dir, '/');
}

// Devuelve URL publica de assets estaticos (public/ en dev, dist/ en prod).
function vite_public_url($path, $manifestPath = null){
    $root = dirname(__DIR__);
    $manifestPath = $manifestPath ?? ($root . '/dist/manifest.json');
    $basePath = vite_base_path();
    $useDist = is_readable($manifestPath) && !vite_is_dev();
    $prefix = $useDist ? ($basePath . '/dist/') : ($basePath . '/');
    $path = ltrim($path, '/');
    return $prefix . $path;
}

// Carga los assets compilados por Vite usando manifest.json (produccion).
// Si no existe el manifest, usa /src/main.js (desarrollo con Vite).
function vite_assets($entry = 'src/main.js', $assetBase = null, $manifestPath = null){
    $root = dirname(__DIR__);
    $manifestPath = $manifestPath ?? ($root . '/dist/manifest.json');
    $assetBase = $assetBase ?? (vite_base_path() . '/dist/');

    if (vite_is_dev()) {
        // En dev cargamos directamente la entrada de Vite para HMR
        $entryPath = '/' . ltrim($entry, '/');
        echo '<script type="module" src="' . $entryPath . '"></script>' . PHP_EOL;
        return;
    }

    if (is_readable($manifestPath)) {
        $json = file_get_contents($manifestPath);
        $manifest = json_decode($json, true);

        if (is_array($manifest) && isset($manifest[$entry])) {
            $item = $manifest[$entry];

            if (!empty($item['css']) && is_array($item['css'])) {
                foreach ($item['css'] as $cssFile) {
                    echo '<link rel="stylesheet" href="' . $assetBase . $cssFile . '">' . PHP_EOL;
                }
            }

            if (!empty($item['file'])) {
                echo '<script type="module" src="' . $assetBase . $item['file'] . '"></script>' . PHP_EOL;
            }
        }
        return;
    }

    // Fallback si no hay manifest (no deberia pasar en produccion)
    $entryPath = ltrim($entry, '/');
    echo '<script type="module" src="/' . $entryPath . '"></script>' . PHP_EOL;
}

