<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
    <style>
        body{
            background-color:rgb(240, 240, 240);
            line-height: 2;
        }

        button{
            width: 200px;
            height: 30px;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <h1>Ejercicio 1:</h1>
    <h2>Apartado A</h2>

    <?php
        $a = 4;
        $b = 1;
        $c = 2;
        $d = 9;
        $e = 6;

        function mostrarNumeros($a, $b, $c, $d, $e) {
            $suma = $a + $b + $c + $d + $e;
            echo($suma);
        }
        mostrarNumeros($a, $b, $c, $d, $e);
    ?>

    <hr>

    <h2>Apartado B</h2>

    <?php
        $a = random_int(0, 9);
        $b = random_int(0, 9);
        $c = random_int(0, 9);
        $d = random_int(0, 9);
        $e = random_int(0, 9);

        function dividirAleatorio($a, $b, $c, $d, $e) {
            $numeros = [$a, $b, $c, $d, $e];

            echo "Los 5 numeros generados: [ ";
            foreach ($numeros as $n) {
                echo $n . " ";
            }
            echo "]" . '<br>'; 

            $eleccionNumeros = array_rand($numeros, 2);
            $elegido1 = $numeros[$eleccionNumeros[0]];
            $elegido2 = $numeros[$eleccionNumeros[1]]; 

            echo "Los dos numeros elegidos son " . $elegido1 . " y " . $elegido2 . '<br>';

            if($elegido2 == 0) {
                throw new Exception("No se puede dividir un numero entre 0");
            }

            $tmp = $elegido1/$elegido2;
            return $tmp;
        }

        try {
            $resultado = dividirAleatorio($a, $b, $c, $d, $e);
            echo "Resultado de la división: " . $resultado;
        } catch (Exception $error) {
            echo "Aviso: " . $error->getMessage();
        }
    ?>

    <hr>

    <h2>Apartado C</h2>

    <form method="POST" action="">
        <label for="radio">Radio del cilindro:</label>
        <input type="number" name="radio" id="radio" min="1" required><br><br>

        <label for="altura">Altura del cilindro:</label>
        <input type="number" name="altura" id="altura" min="1" required><br><br>

        <button type="submit">Calcular volumen total:</button>
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $radio = (float)$_POST['radio'];
            $altura = (float)$_POST['altura'];

            function calcularVolumen($radio, $altura) {
                return M_PI * $radio * $radio * $altura;
            }
        
            echo "El volumen total del cilindro es: " . calcularVolumen($radio, $altura);
        }
    ?>

    <hr>

    <p><a href="index.php">Volver al index</a></p>

</body>

</html>