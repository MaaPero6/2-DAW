<?php
/**
 * matematicas.php - Operaciones Matemáticas
 *
 * Recibe tres números por el método GET (num1, num2, num3) y muestra
 * la suma, el producto, la media, el mayor y el menor en una tabla.
 *
 * Solo se utilizan contenidos de la teoría de la UT2:
 *   - Variables y comentarios (apartados 2.3 y 2.4)
 *   - $_GET, superglobal de datos enviados por el cliente (apartado 2.3.7)
 *   - Operadores aritméticos, de comparación y lógicos (apartado 2.5.2)
 *   - Estructura condicional if / elseif / else
 *   - Funciones nativas: is_numeric(), is_int(), is_float(), round() (anexos)
 */

// ---------------------------------------------------------------------------
// RECOGIDA DE LOS PARÁMETROS QUE LLEGAN POR EL MÉTODO GET
// ---------------------------------------------------------------------------

/*
 * $_GET es una superglobal: un array asociativo disponible en cualquier
 * parte del script que guarda los parámetros enviados por el cliente en la
 * URL. Si la URL es  matematicas.php?num1=3&num2=5&num3=8
 * entonces $_GET['num1'] vale "3", $_GET['num2'] vale "5" y $_GET['num3'] vale "8".
 *
 * Los parámetros llegan como texto, por eso hay que convertirlos a número
 * antes de operar. El operador de asignación "=" es el que asigna el valor.
 */

// Comprobamos que el parámetro existe con isset() y lo convertimos a número
// decimal con el operador de casting (float). Si viniera texto, (float)
// lo convertiría en 0 y la página no se rompería nunca.
$num1 = isset($_GET['num1']) ? (float) $_GET['num1'] : 0;
$num2 = isset($_GET['num2']) ? (float) $_GET['num2'] : 0;
$num3 = isset($_GET['num3']) ? (float) $_GET['num3'] : 0;

/*
 * is_numeric() indica si un valor es un número. La usamos para saber si
 * el usuario ha escrito algo que se pueda usar en las operaciones.
 */
$sonNumeros = is_numeric($_GET['num1'] ?? $num1)
    && is_numeric($_GET['num2'] ?? $num2)
    && is_numeric($_GET['num3'] ?? $num3);

/*
 * Para saber si el número escrito es entero o decimal miramos el texto
 * original con strpos(), que busca la posición de un carácter dentro de
 * una cadena y devuelve false si no lo encuentra.
 * Si el usuario ha escrito "3" no hay punto ni coma, luego es entero;
 * si ha escrito "3.75" o "3,75" sí lo hay, luego es decimal.
 *
 * Ojo: no sirve mirar is_int() sobre $num1 porque al convertirlo con
 * (float) PHP lo convierte siempre a decimal, y daría "decimal" incluso
 * para el número 3.
 */
$textoNum1 = $_GET['num1'] ?? '';
$tieneDecimales = strpos($textoNum1, '.') !== false || strpos($textoNum1, ',') !== false;
$tipoNum1 = $tieneDecimales ? "decimal" : "entero";

// ---------------------------------------------------------------------------
// OPERACIONES MATEMÁTICAS (operadores del apartado 2.5.2 de la teoría)
// ---------------------------------------------------------------------------

/*
 * Operadores aritméticos: + (suma), * (multiplicación) y / (división).
 * El orden de prioridad hace que la división se ejecute antes que la suma,
 * por eso entre paréntesis ($n1 + $n2 + $n3) se calcula primero.
 */
$suma     = $num1 + $num2 + $num3;
$producto = $num1 * $num2 * $num3;

// La media es la suma entre el número de valores. Siempre son 3, así que
// dividimos entre 3 directamente.
$media = ($num1 + $num2 + $num3) / 3;

/*
 * round() redondea un número decimal. Podemos indicar los decimales de
 * precisión como segundo parámetro: round($numero, 2) devuelve el número
 * con 2 decimales. Así la media no sale con muchos decimales.
 */
$mediaRedondeada = round($media, 2);

// ---------------------------------------------------------------------------
// NÚMERO MÁS GRANDE Y NÚMERO MÍNIMO
// Se resuelven con una estructura condicional y operadores de comparación,
// porque las funciones max() y min() no se han visto en la teoría.
// ---------------------------------------------------------------------------

/*
 * El operador de comparación ">" (mayor que) y el operador lógico "&&"
 * (Y lógico) nos permiten comprobar dos condiciones a la vez.
 * El operador de asignación con operación asociada "=" asigna el valor.
 */
if ($num1 > $num2 && $num1 > $num3) {
    $mayor = $num1;
} elseif ($num2 > $num3) {
    $mayor = $num2;
} else {
    $mayor = $num3;
}

// Con el operador "<" (menor que) obtenemos el mínimo, con la misma lógica.
if ($num1 < $num2 && $num1 < $num3) {
    $menor = $num1;
} elseif ($num2 < $num3) {
    $menor = $num2;
} else {
    $menor = $num3;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operaciones Matemáticas - UT2_3</title>
    <!-- Bootstrap: estilos y componentes (tabla y botones) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">

        <h1 class="h3 mb-4">Operaciones Matemáticas</h1>

        <!--
            Formulario con method="get": al enviarlo el navegador recarga
            esta misma página con los valores añadidos a la URL, que es el
            mismo mecanismo que usan los botones del index.php.
        -->
        <form method="get" action="matematicas.php" class="row g-3 align-items-end mb-5">
            <div class="col-auto">
                <label for="num1" class="form-label">Número 1</label>
                <input type="number" step="any" class="form-control" id="num1" name="num1"
                       value="<?php echo htmlspecialchars($_GET['num1'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-auto">
                <label for="num2" class="form-label">Número 2</label>
                <input type="number" step="any" class="form-control" id="num2" name="num2"
                       value="<?php echo htmlspecialchars($_GET['num2'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-auto">
                <label for="num3" class="form-label">Número 3</label>
                <input type="number" step="any" class="form-control" id="num3" name="num3"
                       value="<?php echo htmlspecialchars($_GET['num3'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Calcular</button>
            </div>
        </form>

        <table class="table table-striped table-bordered w-auto">
            <caption class="caption-top">Resultados de las operaciones</caption>
            <thead>
                <tr>
                    <th scope="col">Operación</th>
                    <th scope="col">Resultado</th>
                </tr>
            </thead>
            <tbody>
                <!--
                    htmlspecialchars() transforma los caracteres especiales
                    (<, >, ", &) en entidades HTML. Es lo que permite que la
                    página siga siendo HTML válido en el validador del W3C
                    aunque el usuario escriba caracteres especiales.
                -->
                <tr>
                    <th scope="row">Número 1 recibido</th>
                    <td><?php echo htmlspecialchars($_GET['num1'] ?? '', ENT_QUOTES, 'UTF-8'); ?> (<?php echo $tipoNum1; ?>)</td>
                </tr>
                <tr>
                    <th scope="row">Número 2 recibido</th>
                    <td><?php echo htmlspecialchars($_GET['num2'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Número 3 recibido</th>
                    <td><?php echo htmlspecialchars($_GET['num3'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Suma</th>
                    <td><?php echo $suma; ?></td>
                </tr>
                <tr>
                    <th scope="row">Producto</th>
                    <td><?php echo $producto; ?></td>
                </tr>
                <tr>
                    <th scope="row">Media</th>
                    <td><?php echo $mediaRedondeada; ?></td>
                </tr>
                <tr>
                    <th scope="row">Número más grande</th>
                    <td><?php echo $mayor; ?></td>
                </tr>
                <tr>
                    <th scope="row">Número mínimo</th>
                    <td><?php echo $menor; ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Enlace para volver a la página principal (navegabilidad) -->
        <a class="btn btn-outline-secondary" href="index.php">Volver a la página principal</a>

    </div>
</body>
</html>
