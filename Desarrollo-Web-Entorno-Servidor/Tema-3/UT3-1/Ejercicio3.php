<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Comparar numeros</title>
</head>

<body>

    <h1>Comparacion de numeros:</h1>
    <form method="POST" action="">
        <label for="n1">Primer número:</label>
        <input type="number" name="n1" id="n1" min="1" required><br><br>

        <label for="n2">Segundo número:</label>
        <input type="number" name="n2" id="n2" min="1" required><br><br>

        <label for="n3">Tercer número:</label>
        <input type="number" name="n3" id="n3" min="1" required><br><br>

        <button type="submit">Buscar:</button>
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numeros = [
            (int)$_POST['n1'], 
            (int)$_POST['n2'], 
            (int)$_POST['n3']
            ];

            $conteo = array_count_values($numeros);

            $maxima_repeticion = max($conteo);

            $numero_repetido = array_search($maxima_repeticion, $conteo);

            if ($maxima_repeticion == 3) {
                echo "Hay tres números iguales a $numero_repetido.";
            } 
            elseif ($maxima_repeticion == 2) {
                echo "Hay dos números iguales a $numero_repetido.";
            } 
            else {
                echo "No hay números iguales.";
            }    
        }
    ?>

    <hr>
    <p><a href="index.php">Volver al index</a></p>

</body>

</html>
