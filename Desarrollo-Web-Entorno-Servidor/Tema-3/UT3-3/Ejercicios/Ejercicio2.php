<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
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

    <h1>Ejercicio 2:</h1>

    <form method="POST" action="">
        <label for="num">Numero de elementos:</label>
        <input type="number" name="num" id="num" min="1" required><br><br>

        <label for="max">Maximo:</label>
        <input type="number" name="max" id="max" min="1" required><br><br>

        <label for="min">Minimo:</label>
        <input type="number" name="min" id="min" min="1" required><br><br>

        <button type="submit">Ejecutar:</button>
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero_de_elementos = (int)$_POST['num'];
            $max = (int)$_POST['max'];
            $min = (int)$_POST['min'];

            function inicializar_array($numero_de_elementos, $min, $max) {
               $resultado = [];
               for ($i = 0; $i < $numero_de_elementos; $i++) {
                    $resultado[] = random_int($min, $max);
                }
            return $resultado;
            }

            function mostrarArray($array) {
               echo "<p>Valores almacenados en el array: [ ";
               foreach ($array as $valor) {
                   echo $valor . " ";
               }
                echo "]</p>";
            }


           if ($min > $max) {
               echo "<p>Error: El valor mínimo no puede ser mayor que el máximo.</p>";
            } else {
                $numeros = inicializar_array($numero_de_elementos, $min, $max);
                mostrarArray($numeros);
            }
        }
    ?>
    <hr>

    <p><a href="index.php">Volver al index</a></p>

</body>

</html>