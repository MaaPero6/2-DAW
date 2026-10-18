<?php
    $rutaCara = "photos/Cara.jpg";
    $descripcionCara = "Cara de una moneda";
    $rutaCruz = "photos/Cruz.jpg";
    $descripcionCruz = "Cruz de una moneda";
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Lanzar una moneda</title>
</head>

<body>

    <h1>Cara o cruz:</h1>
    <?php
        $n = random_int(1, 2);
        if($n == 1) {
            echo '<img src="' . $rutaCara . '" alt="' . $descripcionCara . '" width="300">';
        } else {
            echo '<img src="' . $rutaCruz . '" alt="' . $descripcionCruz . '" width="300">';
        }
    ?>

    <hr>
    <p><a href="../index.php">Volver al index</a></p>

</body>

</html>
