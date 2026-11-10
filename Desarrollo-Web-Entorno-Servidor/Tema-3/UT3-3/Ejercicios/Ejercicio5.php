<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
    <style>
        body {
            background-color: rgb(240, 240, 240);
            line-height: 2;
        }

        button {
            width: 200px;
            height: 30px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <?php
        function calcular_minimo($array) {
            $minimo = $array[0];
            foreach ($array as $valor) {
                if ($valor < $minimo) {
                    $minimo = $valor;
                }
            }
            return $minimo;
        }
    ?>
    <!-- PASO 1: Pedir cantidad (solo si no se ha pedido aún ni se han enviado números) -->
    <?php if (!isset($_POST['cantidad']) && !isset($_POST['mis_numeros'])): ?>
        <h2>Elementos del array:</h2>
        <form method="POST" action="">
            <label>Introduce el numero de elementos que quieres que tenga el array:</label>
            <input type="number" name="cantidad" min="1" required>
            <button type="submit">Crear casillas</button>
        </form>
    <?php endif; ?>

    <?php
    // PASO 2: Pintar casillas según la cantidad pedida
    if (isset($_POST['cantidad']) && !isset($_POST['mis_numeros'])) {
        $cantidad = (int)$_POST['cantidad'];
        echo "<h2>Introduce tus $cantidad números:</h2>";
        
        echo '<form method="POST" action="">';
        for ($i = 0; $i < $cantidad; $i++) {
            $numCasilla = $i + 1;
            echo "Número $numCasilla: ";
            echo '<input type="number" name="mis_numeros[]" step="any" required><br><br>';
        }
        echo '<button type="submit">Enviar valores</button>';
        echo '</form>';
    }

    // PASO 3: Recoger el array, mostrarlo y calcular el minimo
    if (isset($_POST['mis_numeros'])) {
        $lista = $_POST['mis_numeros'];

        echo "<h2>¡Valores recibidos con éxito!</h2>";
        echo "<p>El array contiene: [ ";
        foreach ($lista as $n) {
            echo $n . " ";
        }
        echo "]</p>";

        // Llamamos a la función pasándole la lista recibida
        $minimo = calcular_minimo($lista);
        echo "<p><strong>El mínimo es: " . $minimo . "</strong></p>";
        
        echo '<p><a href="">Empezar de nuevo</a></p>';
    }
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>
</body>
</html>