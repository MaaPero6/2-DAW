<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
    <style>
        body{
            background-color:rgb(201, 201, 201);
            line-height: 2;
        }
    </style>
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

        echo "<hr>";

        sort($listaNumeros);
        $tresMinimos = array_slice($listaNumeros, 0, 3);
        $tresMaximos = array_slice($listaNumeros, 7, 9);

        echo "Los 3 numeros mas chicos en el array son: ";
        $cont = 0;
        foreach ($tresMinimos as $n) {
            if ($cont < 2) {
                echo $n . ", ";
            } else {
                echo $n;
            }
            $cont ++;
        }

        echo "<hr>";

        echo "Los 3 numeros mas grandes en el array son: ";
        $cont = 0;
        foreach ($tresMaximos as $n) {
            if ($cont < 2) {
                echo $n . ", ";
            } else {
                echo $n;
            }
            $cont ++;
        }

        echo "<hr>";

        $arrayCopiado = [];
        $arrayCopiado = array_merge($listaNumeros, $arrayCopiado);

        echo "Array copiado y ordenado: [ ";
        foreach ($arrayCopiado as $n) {
            echo $n . " ";
        }
        echo "]";

        echo "<hr>";

        unset($arrayCopiado[1]);
        $arrayCopiado = array_values($arrayCopiado);
        echo "Array tras eliminar el segundo elemento: [ ";
        foreach ($arrayCopiado as $n) {
            echo $n . " ";
        }
        echo "]";
        
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
