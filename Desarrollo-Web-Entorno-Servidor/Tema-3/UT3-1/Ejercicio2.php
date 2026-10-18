<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Adivinar la nota</title>
</head>

<body>

    <h1>Adivinar la nota:</h1>
    <?php
        $nota = random_int(0, 10);
        echo "Tu nota es un: <strong>" . $nota . "</strong>, por lo que: ";

        if($nota <= 4) {
            echo "Estas suspenso.";
        } elseif($nota == 5) {
            echo "Tienes un suficiente.";
        } elseif($nota == 6) {
            echo "Tu nota es un bien.";
        } elseif($nota == 7 || $nota == 8) {
            echo "Tienes un notable.";
        } else if($nota == 9 || $nota == 10) {
            echo "Tienes un sobresaliente.";
        }
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
