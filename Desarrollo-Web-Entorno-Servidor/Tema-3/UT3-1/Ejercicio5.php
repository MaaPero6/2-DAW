<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - Tabla Unicode</title>
</head>

<body>

    <h1>Tabla Unicode del 0 al 50000</h1>

    <table border="1">
        <?php
            $numero = 0;
            for ($fila = 0; $fila < 50000; $fila++) {
                echo "<tr>";
                for ($columna = 0; $columna < 10; $columna++) {
                    echo "<td>&#" . $numero . ";</td>";
                    $numero++;
                }
                echo "</tr>";
            }
        ?>
    </table>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
