<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
</head>

<body>

    <h1>Trabajar con array aleatorio:</h1>

    <?php
        $listaNumeros = [];
        for($i = 0; $i < 10; $i++) {
            $n = random_int(1, 30);
            $listaNumeros[] = $n;
        }
        echo "Valores almacenados en el array: [ ";
        foreach ($listaNumeros as $n) {
            echo $n . " ";
        }
        echo "]";

        echo "<hr>";

        $total = 0;
        foreach ($listaNumeros as $n) {
            $total += $n;
        }
        $valorMedio = $total / 10;
        echo "El valor medio de todos los numeros en el array es: " . $valorMedio;

    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
