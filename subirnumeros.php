<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de números</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        input[type="file"] {
            margin: 10px;
        }
        .mensaje {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Gestión del archivo de números</h2>
    
    <?php
    function formatear_lineas($contenido) {
        $lineas = explode("\n", trim($contenido));
        $lineas_formateadas = [];

        foreach ($lineas as $linea) {
            $linea = trim($linea);

            if (!preg_match('/^".*",".*"$/', $linea)) {
                $partes = explode(',', $linea);
                if (count($partes) == 2) {
                    $numero = trim($partes[0]);
                    $saldo = trim($partes[1]);
                    $linea_formateada = '"' . $numero . '","' . $saldo . '"';
                    $lineas_formateadas[] = $linea_formateada;
                }
            } else {
                $lineas_formateadas[] = $linea;
            }
        }

        return $lineas_formateadas;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $destino = "numeros.txt";
        $mensaje = '';
        $error = '';

        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
            $archivo_subido = file_get_contents($_FILES['archivo']['tmp_name']);
            $lineas_formateadas = formatear_lineas($archivo_subido);

            // Cambiar permisos a 664 antes de modificar
            if (chmod($destino, 0664)) {
                if (isset($_POST['reemplazar'])) {
                    array_unshift($lineas_formateadas, 'Numero,Saldo');

                    if (file_put_contents($destino, implode(PHP_EOL, $lineas_formateadas) . PHP_EOL)) {
                        $mensaje = "El archivo se ha reemplazado correctamente como 'numeros.txt'.";
                    } else {
                        $error = "Error al reemplazar el archivo.";
                    }
                } elseif (isset($_POST['agregar'])) {
                    if (file_exists($destino)) {
                        $contenido_actual = file_get_contents($destino);
                        if (stripos($contenido_actual, 'Numero,Saldo') === false) {
                            array_unshift($lineas_formateadas, 'Numero,Saldo');
                        }
                    } else {
                        array_unshift($lineas_formateadas, 'Numero,Saldo');
                    }

                    if (file_put_contents($destino, implode(PHP_EOL, $lineas_formateadas) . PHP_EOL, FILE_APPEND)) {
                        $mensaje = "Los números se han agregado correctamente al final de 'numeros.txt'.";
                    } else {
                        $error = "Error al agregar números.";
                    }
                }

                // Restaurar permisos a 644 después de modificar
                chmod($destino, 0644);
            } else {
                $error = "No se pudieron cambiar los permisos a 664.";
            }
        } else {
            $error = "No se ha seleccionado ningún archivo o ha ocurrido un error.";
        }

        if ($mensaje) {
            echo "<p class='mensaje'>$mensaje</p>";
        }
        if ($error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>

    <!-- Formulario para subir el archivo -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="archivo" id="archivo" required>
        <br><br>
        <!-- Botón para reemplazar el archivo -->
        <button type="submit" name="reemplazar">Reemplazar archivo</button>
        <!-- Botón para agregar números al archivo existente -->
        <button type="submit" name="agregar">Agregar más números</button>
    </form>
</div>

</body>
</html>
