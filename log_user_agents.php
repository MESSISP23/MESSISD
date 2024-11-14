<?php
// Archivo de registro
$logFile = 'ingresosparati.txt';

// Captura del user-agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Captura de la IP del visitante
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Obtener ubicación a partir de la IP
$location = 'Desconocida';
$geoInfo = json_decode(file_get_contents("http://ip-api.com/json/{$ipAddress}"));

// Inicializamos la variable del país
$country = 'No disponible';

if ($geoInfo && $geoInfo->status == 'success') {
    $country = $geoInfo->country;
    $location = $geoInfo->city . ', ' . $geoInfo->regionName . ', ' . $geoInfo->country;
} else {
    $location = 'No disponible';
}

// Función para eliminar acentos
function removeAccents($text) {
    $accents = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ'];
    $noAccents = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N'];
    return str_replace($accents, $noAccents, $text);
}

// Fecha y hora actual
$date = date('Y-m-d H:i:s');

// Eliminar acentos de los textos
$userAgent = removeAccents($userAgent);
$location = removeAccents($location);

// Registro en el archivo
$logEntry = "$date - IP: $ipAddress - Ubicacion: $location - User-Agent: $userAgent\n";

// Leer el contenido actual del archivo si existe
if (file_exists($logFile)) {
    $logContent = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $logContent = [];
}

// Agregar la nueva entrada
$logContent[] = $logEntry;

// Mantener solo las últimas 50 líneas
if (count($logContent) > 50) {
    $logContent = array_slice($logContent, -50);
}

// Guardar el contenido actualizado en el archivo
file_put_contents($logFile, implode("\n", $logContent) . "\n");

// Verificar si la ubicación es de Colombia
if (strtolower($country) !== 'colombia') {
    // Si el país no es Colombia, redirigir a otra página
    header('Location: misaludmentalimporta');
    exit();
}
?>
