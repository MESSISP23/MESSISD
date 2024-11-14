<?php
header('Content-Type: text/plain');

// Leer el contenido de numeros.txt
$file = 'numeros.txt';
if (file_exists($file)) {
    echo file_get_contents($file);
} else {
    http_response_code(404);
    echo "Archivo no encontrado";
}
?>
