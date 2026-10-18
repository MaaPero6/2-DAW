<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7 - Frutas Aleatorias</title>
</head>

<body>

    <h1>Ejercicio de Frutas:</h1>
    <h2>Apartado 1: Generar Frutas:</h2>
    <?php
        $numero = random_int(7,20);
        $listaFrutas= [];
        for($i = 0; $i < $numero; $i++) {
            $fruta = random_int(127815,127827);
            $listaFrutas[] = $fruta;
            echo "&#" . $fruta . ";";
        }
    ?>

    <h2>Apartado 2: Selección y conteo aleatorio de nº de frutas:</h2>
    <?php
        $frutaParaContar = $listaFrutas[array_rand($listaFrutas)];

        $contador = 0;
        for($i = 0; $i < $numero; $i++) {
            if($listaFrutas[$i] == $frutaParaContar) {
                $contador += 1;
            }
        }

        echo "La fruta &#" . $frutaParaContar . " aparece " . $contador . " veces.";
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>