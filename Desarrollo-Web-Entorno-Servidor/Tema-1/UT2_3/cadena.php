<?php
/**
 * cadena.php - Operaciones con Cadenas
 * Desarrollo web en entorno servidor (2º DAW)
 *
 * Recibe dos cadenas por el método GET (cadena1 y cadena2) y muestra
 * la concatenación, las longitudes, los últimos 10 caracteres de la
 * cadena 2 y la sustitución de la palabra "pepe" por "Juan".
 *
 * Solo se utilizan contenidos de la teoría de la UT2:
 *   - $_GET, superglobal de datos enviados por el cliente (apartado 2.3.7)
 *   - Operador de concatenación de cadenas "." (apartado 2.5.2)
 *   - Funciones nativas de cadenas: strlen(), mb_strlen(), substr(),
 *     mb_substr() y str_replace() (apartado 4.2 - Cadenas)
 */

// ---------------------------------------------------------------------------
// RECOGIDA DE LOS PARÁMETROS QUE LLEGAN POR EL MÉTODO GET
// ---------------------------------------------------------------------------

/*
 * $_GET es una superglobal: guarda los parámetros que el cliente envía
 * en la URL. Si la URL es  cadena.php?cadena1=pepe&cadena2=El%20niño
 * entonces $_GET['cadena1'] vale "pepe" y $_GET['cadena2'] vale "El niño".
 * isset() comprueba que el parámetro exista antes de leerlo.
 */
$cadena1 = isset($_GET['cadena1']) ? $_GET['cadena1'] : '';
$cadena2 = isset($_GET['cadena2']) ? $_GET['cadena2'] : '';

// ---------------------------------------------------------------------------
// OPERACIONES CON CADENAS
// ---------------------------------------------------------------------------

/*
 * El operador de concatenación "." une dos cadenas formando una sola.
 * Es el operador de manipulación de cadenas del apartado 2.5.2.
 */
$concatenacion = $cadena1 . " " . $cadena2;

/*
 * mb_strlen() devuelve la cantidad de caracteres de una cadena que contiene
 * caracteres Unicode, es decir, respetando tildes, ñ y diéresis.
 *
 * Es importante usarla y no strlen(): strlen() cuenta BYTES, y en UTF-8 la
 * "ñ" ocupa 2 bytes, así que strlen() daría un número demasiado alto.
 * La teoría lo explica con el ejemplo de "Martín Martín León":
 *   strlen()  -> 21  (cuenta los bytes)
 *   mb_strlen() -> 18  (cuenta los caracteres reales)
 */
$longitud1 = mb_strlen($cadena1, 'UTF-8');
$longitud2 = mb_strlen($cadena2, 'UTF-8');

/*
 * mb_substr() extrae una parte de la cadena. El primer parámetro es la
 * cadena, el segundo la posición desde la que empieza (el primer carácter
 * ocupa la posición 0) y el tercero cuántos caracteres se quieren.
 *
 * El truco para los ÚLTIMOS 10 caracteres es poner un inicio NEGATIVO:
 * como indica la teoría, "si el inicio es negativo, la cadena devuelta
 * empezará en el inicio que pongamos pero contando desde el final".
 * Por eso -10 significa "empieza 10 caracteres antes del final".
 */
$ultimos10 = mb_substr($cadena2, -10, null, 'UTF-8');

/*
 * str_replace() busca un texto dentro de una cadena y lo sustituye por
 * otro. str_replace('pepe', 'Juan', $cadena) cambia "pepe" por "Juan".
 * Sustituye todas las apariciones y distingue mayúsculas de minúsculas.
 *
 * strtr() es la alternativa cuando hay varios textos que sustituir a la vez.
 */
$cadena1Sustituida = str_replace('pepe', 'Juan', $cadena1);
$cadena2Sustituida = str_replace('pepe', 'Juan', $cadena2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operaciones con Cadenas - UT2_3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">

        <h1 class="h3 mb-4">Operaciones con Cadenas</h1>

        <!-- Formulario GET para poder cambiar los textos y probarlo -->
        <form method="get" action="cadena.php" class="row g-3 align-items-end mb-5">
            <div class="col-md-4">
                <label for="cadena1" class="form-label">Cadena 1 (una sola palabra)</label>
                <input type="text" class="form-control" id="cadena1" name="cadena1"
                       value="<?php echo htmlspecialchars($cadena1, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
                <label for="cadena2" class="form-label">Cadena 2 (varias palabras, con acentos)</label>
                <input type="text" class="form-control" id="cadena2" name="cadena2"
                       value="<?php echo htmlspecialchars($cadena2, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success">Operar</button>
            </div>
        </form>

        <table class="table table-striped table-bordered w-auto">
            <caption class="caption-top">Resultados de las operaciones con cadenas</caption>
            <thead>
                <tr>
                    <th scope="col">Operación</th>
                    <th scope="col">Resultado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Cadena 1 recibida</th>
                    <td><?php echo htmlspecialchars($cadena1, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Cadena 2 recibida</th>
                    <td><?php echo htmlspecialchars($cadena2, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Concatenación (cadena1 + cadena2)</th>
                    <td><?php echo htmlspecialchars($concatenacion, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Longitud de la cadena 1 (mb_strlen)</th>
                    <td><?php echo $longitud1; ?></td>
                </tr>
                <tr>
                    <th scope="row">Longitud de la cadena 2 (mb_strlen)</th>
                    <td><?php echo $longitud2; ?></td>
                </tr>
                <tr>
                    <th scope="row">Longitud de la cadena 2 con strlen (para comparar)</th>
                    <td><?php echo strlen($cadena2); ?></td>
                </tr>
                <tr>
                    <th scope="row">Últimos 10 caracteres de la cadena 2</th>
                    <td><?php echo htmlspecialchars($ultimos10, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Cadena 1 con "pepe" sustituido por "Juan"</th>
                    <td><?php echo htmlspecialchars($cadena1Sustituida, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Cadena 2 con "pepe" sustituido por "Juan"</th>
                    <td><?php echo htmlspecialchars($cadena2Sustituida, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Enlace para volver a la página principal (navegabilidad) -->
        <a class="btn btn-outline-secondary" href="index.php">Volver a la página principal</a>

    </div>
</body>
</html>
