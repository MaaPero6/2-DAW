<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6 - Tabla de multiplicar</title>
</head>

<body>

    <h1>Tabla de multiplicar aleatoria:</h1>
    <?php
        $numero = random_int(1, 10);
        for ($i = 1; $i <= 10; $i++) {
            echo $numero . " x " . $i . " = " . ($numero * $i) . "<br>";
        }
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
