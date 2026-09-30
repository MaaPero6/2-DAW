<?php
/**
 * index.php - Página principal de los Ejercicios UT2_3
 *
 * Muestra los datos del estudiante y dos botones (Bootstrap) que enlazan
 * con las páginas de ejercicios pasando parámetros por el método GET.
 */

$nombre = "Miguel Ángel Antúnez Ruiz";
$curso  = "2º DAW";
$modulo = "Desarrollo web en entorno servidor";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicios UT2_3 - Inicio</title>
    <!-- Bootstrap 5.3: estilos y componentes (botones, tablas, grid) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">

        <!-- Cabecera con los datos del estudiante, del curso y del módulo -->
        <header class="text-center mb-5">
            <h1 class="display-5"><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="lead text-muted mb-1">Curso: <?php echo htmlspecialchars($curso, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="lead text-muted">Módulo: <?php echo htmlspecialchars($modulo, ENT_QUOTES, 'UTF-8'); ?></p>
        </header>

        <h2 class="h4 mb-4">Ejercicios</h2>

        <div class="d-flex flex-wrap gap-3">
            <!--
                Los dos enlaces pasan parámetros por el método GET.
                Se usan parámetros "vacíos" en la URL: ?num1=3&num2=5&num3=8
                y ?cadena1=pepe&cadena2=...
                El símbolo & dentro del atributo href se escribe &amp;
                porque en HTML válido el ampersand debe ir escapado.
            -->

            <!-- Botón 1: Operaciones Matemáticas -->
            <a class="btn btn-primary btn-lg" href="matematicas.php?num1=3&amp;num2=5&amp;num3=8">
                Operaciones Matemáticas
            </a>

            <!-- Botón 2: Operaciones con Cadenas -->
            <a class="btn btn-success btn-lg" href="cadena.php?cadena1=pepe&amp;cadena2=El%20ni%C3%B1o%20peque%C3%B1o%20canta%20una%20canci%C3%B3n%20en%20la%20cocina">
                Operaciones con Cadenas
            </a>

            <!-- Botón 3: Información del servidor (no necesita parámetros) -->
            <a class="btn btn-secondary btn-lg" href="infoServidor.php">
                Información del servidor
            </a>
        </div>

    </div>
</body>
</html>
