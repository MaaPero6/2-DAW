<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Prueba 2 de PHP</title>
</head>

<body>

    <section style="font-family: sans-serif; max-width: 600px; line-height: 1.5; padding: 16px; border: 1px solid #ccc; border-radius: 8px;">
    <h2>Ejercicio PHP: Evaluador de Inventario de Pociones</h2>
    <p>Crea un script en PHP que gestione el inventario básico de pociones de un jugador según los siguientes requisitos:</p>

    <h3>1. Variables iniciales</h3>
    <ul>
        <li>Nombre del jugador (texto).</li>
        <li>Cantidad actual de pociones de vida (entero).</li>
        <li>Precio unitario por poción (por ejemplo, 15 monedas).</li>
    </ul>

    <h3>2. Cálculo</h3>
    <ul>
        <li>Calcula el valor total en monedas del stock disponible.</li>
    </ul>

     <h3>3. Lógica condicional</h3>
     <ul>
        <li><strong>0 pociones:</strong> Mostrar alerta de peligro crítico (sin suministros).</li>
        <li><strong>De 1 a 3 pociones:</strong> Advertir que el stock es bajo y recomendar reabastecerse.</li>
        <li><strong>4 o más pociones:</strong> Confirmar que el equipamiento es adecuado.</li>
     </ul>

  <h3>4. Salida esperada</h3>
  <p>Imprime un resumen con el nombre del jugador, las pociones que lleva, el valor total del inventario y la recomendación correspondiente.</p>
</section>

    <p>
        <?php
        $nombre = "MaaPer";
        $cantidadPociones = 150;
        $precioPocion = 20;

        $valorTotal = $cantidadPociones * $precioPocion;

        if ($cantidadPociones == 0) {
            $recomendacion = "¡Peligro crítico! No tienes pociones de vida. ¡Reabastece tu inventario!";
        } elseif ($cantidadPociones >= 1 && $cantidadPociones <= 3) {
            $recomendacion = "Stock bajo. Te recomendamos reabastecerte pronto.";
        } else {
            $recomendacion = "Equipamiento adecuado. ¡Estás listo para la aventura!";
        }

        echo "<strong>Nombre del jugador:</strong> $nombre<br>";
        echo "<strong>Cantidad de pociones de vida:</strong> $cantidadPociones<br>";
        echo "<strong>Valor total del inventario:</strong> $valorTotal monedas<br>";
        echo "<strong>Recomendación:</strong> $recomendacion";

        ?>
    </p>

</body>

</html>