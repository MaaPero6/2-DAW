<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
</head>

<body>

    <h1>Imprimir valores de array aleatorio(1-30):</h1>

    <?php
        $listaNumeros = [];
        for($i = 0; $i < 10; $i++) {
            $n = random_int(1, 30);
            $listaNumeros[] = $n;
        }
        echo "Valores almacenados en el array: [ ";
        foreach ($listaNumeros as $valor) {
            echo $valor . " ";
        }
        echo "]";
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
