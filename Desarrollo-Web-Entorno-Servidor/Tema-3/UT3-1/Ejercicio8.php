<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8 - Tablas</title>
</head>

<body>

    <h1> Ejercicios de tablas:</h1>
    <h2>Apartado 1: Tabla del 1 al 100</h2>
    <table border="1">
        <?php
            $numero = 1;
            for ($fila = 1; $fila <= 10; $fila++) {
                echo "<tr>";
                    for ($columna = 1; $columna <= 10; $columna++) {
                        echo "<td>" . $numero . "</td>";
                        $numero++;
                    }   
                echo "</tr>";
            }   
        ?>
    </table>

    <hr>
    <hr>

    <h2>Apartado 2: Tabla con emoticonos aleatorios</h2>
    <table border="1">
        <?php
        $opciones = [128169, 128168, 127866, 128405, 129313];

        for ($fila = 1; $fila <= 10; $fila++) {
            echo "<tr>";
            for ($columna = 1; $columna <= 10; $columna++) {
                $indice = array_rand($opciones);
                $emoticono = $opciones[$indice];
                echo "<td>&#" . $emoticono . ";</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
