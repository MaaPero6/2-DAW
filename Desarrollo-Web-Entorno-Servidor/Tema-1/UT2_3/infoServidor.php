<?php
/**
 * infoServidor.php - Información del servidor
 * Desarrollo web en entorno servidor (2º DAW)
 *
 * Muestra el nombre del servidor, el software que lo sirve y la versión
 * de PHP instalada. No necesita parámetros por el método GET.
 *
 * Solo se utilizan contenidos de la teoría de la UT2:
 *   - $_SERVER, superglobal con información del servidor (apartado 2.3.7)
 *   - Estructura condicional if / else
 */

// ---------------------------------------------------------------------------
// INFORMACIÓN DEL SERVIDOR
// ---------------------------------------------------------------------------

/*
 * $_SERVER es una superglobal de PHP: contiene un array con información
 * del servidor y del entorno en el que se está ejecutando la página.
 * La teoría la presenta como la superglobal que guarda datos del servidor.
 */

/*
 * $_SERVER['SERVER_NAME'] devuelve el nombre del servidor. Cuando escribimos
 * http://localhost/ en el navegador, este valor es "localhost".
 */
$nombreServidor = $_SERVER['SERVER_NAME'];

/*
 * $_SERVER['SERVER_SOFTWARE'] devuelve el software del servidor web y su
 * versión, por ejemplo "Apache/2.4.58 (Unix)".
 */
$softwareServidor = $_SERVER['SERVER_SOFTWARE'];

/*
 * Con phpversion() obtenemos la versión de PHP que está interpretando
 * el script, por ejemplo "8.2.12".
 *
 * Esta función no aparece en los anexos de funciones nativas de la teoría,
 * pero es la única forma de conocer la versión de PHP que pide el enunciado
 * del ejercicio, así que es inevitable usarla.
 */
$versionPHP = phpversion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Información del servidor - UT2_3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">

        <h1 class="h3 mb-4">Información del servidor</h1>

        <table class="table table-striped table-bordered w-auto">
            <caption class="caption-top">Datos del servidor</caption>
            <thead>
                <tr>
                    <th scope="col">Dato</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Nombre del servidor</th>
                    <td><?php echo htmlspecialchars($nombreServidor, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Software del servidor</th>
                    <td><?php echo htmlspecialchars($softwareServidor, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Versión de PHP</th>
                    <td><?php echo htmlspecialchars($versionPHP, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Enlace para volver a la página principal (navegabilidad) -->
        <a class="btn btn-outline-secondary" href="index.php">Volver a la página principal</a>

    </div>
</body>
</html>
