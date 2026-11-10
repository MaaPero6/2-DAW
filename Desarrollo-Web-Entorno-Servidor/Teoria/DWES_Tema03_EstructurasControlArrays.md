# Desarrollo web en entorno servidor - Tema 3: Estructuras de control, arrays y formularios

## 📌 Resumen Ejecutivo y Objetivos

El tema completa el aprendizaje de PHP iniciado en el Tema 2. Si allí se estudiaba cómo incrustar código en HTML y cómo manejar variables, tipos y operadores, aquí se incorporan los tres mecanismos que convierten un script en un programa útil: las **estructuras de control** (decisión y repetición), los **arrays** como contenedor de datos y los **formularios** como cauce de entrada desde el navegador. El resultado de aprendizaje es el número 3: «Escribe bloques de sentencias embebidos en lenguajes de marcas, seleccionando y utilizando las estructuras de programación», con criterios que abarcan decisión, bucles, arrays, funciones, recuperación de datos de formulario, comentarios y herramientas de prueba y depuración.

La idea vertebradora es que el flujo de un documento PHP no es lineal: el intérprete ejecuta las sentencias en orden, pero puede saltar bloques, repetirlos, delegar en otro fichero o detenerse ante un error. Dominar ese flujo permite generar respuestas distintas ante entradas distintas, que es la razón de ser de una aplicación web.

Objetivos de aprendizaje:

- Escribir condiciones con `if`, `if-else`, `if-elseif` y `switch`, eligiendo la más legible en cada caso.
- Construir bucles `for`, `while` y `do-while`, y controlar su ejecución con `break` y `continue`.
- Reutilizar código mediante `include`, `require` y sus variantes `_once`, comprendiendo el distinto tratamiento del error.
- Declarar, recorrer, modificar y ordenar arrays indexados y asociativos, incluidos los multidimensionales.
- Distinguir los operadores `==`, `===` y `+` aplicados a arrays.
- Definir funciones con argumentos opcionales y diferenciar el paso por copia del paso por referencia.
- Conocer el modelo de errores y excepciones de PHP y las directivas que lo gobiernan.
- Recibir y filtrar datos de formularios con `$_POST`, `filter_input()` y `htmlspecialchars()`, integrando formulario y procesamiento en un mismo fichero.

## 📖 Desarrollo Teórico Detallado

### 3.1. Estructuras condicionales

PHP incorpora las estructuras habituales de la programación estructurada, con sintaxis cercana a Java o C. La condición se evalúa según las reglas de conversión a booleano: son falsos `0`, `0.0`, `""`, `"0"`, `null`, `false` y los arrays vacíos. Para agrupar varias sentencias en una rama se usan llaves.

```php
<?php
$edad = 17;

if ($edad >= 18) {
    echo "Puede acceder al sistema";
} else {
    echo "Acceso restringido: menor de edad";
}
```

Cuando se anidan varias condiciones se emplea `elseif` (equivalente a `else if`), que evita el anidamiento y hace explícito que las ramas son mutuamente excluyentes:

```php
<?php
$nota = 7.4;

if ($nota < 5) {
    $calificacion = "Insuficiente";
} elseif ($nota < 6) {
    $calificacion = "Suficiente";
} elseif ($nota < 7) {
    $calificacion = "Bien";
} elseif ($nota < 9) {
    $calificacion = "Notable";
} else {
    $calificacion = "Sobresaliente";
}
echo "Calificación: $calificacion";
```

Un error frecuente es encadenar `if` independientes cuando las condiciones son excluyentes: si la primera rama modifica la variable que evalúan las siguientes, el resultado no es el esperado. Con `elseif` la primera condición verdadera detiene la cadena.

Para comparar un mismo valor contra una lista de casos, `switch` resulta más legible. Compara con igualdad laxa (`==`), de modo que `"1"` y `1` coinciden; la sección `default` se ejecuta cuando ningún `case` encaja. **Cada `case` necesita su `break`**: sin él, la ejecución «cae» al siguiente caso y se ejecutan sentencias no deseadas. Varios `case` consecutivos sin sentencias entre ellos comparten el mismo bloque.

```php
<?php
switch ($calificacion) {
    case "Suficiente":
    case "Bien":
        echo "Objetivos alcanzados";
        break;
    default:
        echo "Revisar el expediente";
}
```

### 3.2. Estructuras de repetición

Los bucles repiten un conjunto de instrucciones mientras se cumpla una condición.

| Estructura | Sintaxis | Cuándo usarla | Particularidad |
|---|---|---|---|
| `for` | `for (inic; cond; iter)` | Número de repeticiones conocido | Inicialización una sola vez; iteración tras cada vuelta |
| `while` | `while (cond)` | Repeticiones que dependen de un estado | La condición se evalúa **antes**; puede no ejecutarse nunca |
| `do-while` | `do { ... } while (cond);` | Se requiere al menos una ejecución | La condición se evalúa **después** del cuerpo |
| `foreach` | `foreach ($arr as $k => $v)` | Recorrer arrays completos | Una iteración por elemento; no requiere contador |

En el `for`, las tres expresiones son opcionales y pueden contener varias instrucciones separadas por comas; el cuerpo se repite mientras la condición sea verdadera:

```php
<?php
for ($i = 1; $i <= 10; $i++) {
    echo "$i x 5 = " . ($i * 5) . "<br>";
}
```

El `while` no incluye inicialización ni iteración: ambas se escriben fuera y al final del cuerpo. Olvidar la actualización de la variable de control produce un **bucle infinito**. El `do-while` es adecuado cuando el cuerpo debe ejecutarse al menos una vez, como al pedir datos hasta que sean válidos.

### 3.3. break, continue y return

`break` abandona el bucle o `switch` en que aparece; admite un entero con los niveles de anidamiento a abandonar (`break 2;` sale de dos bucles). `continue` no abandona el bucle: salta el resto de la iteración y pasa a evaluar la condición para la siguiente.

```php
<?php
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        continue;      // ignora los pares
    }
    if ($i > 7) {
        break;         // detiene el bucle al llegar a 9
    }
    echo $i . " ";
}
// Salida: 1 3 5 7
```

`return`, en cambio, finaliza la ejecución del fichero cuando aparece fuera de una función: el `echo` posterior no se ejecuta y, si el script se incluyó con `include` o `require`, la ejecución continúa en el fichero que lo incluyó. Dentro de una función termina esa función y devuelve el argumento indicado.

### 3.4. Inclusión de ficheros: include y require

`include` y `require` insertan y ejecutan otro fichero. Solo se diferencian en el tratamiento del error: si el fichero no existe, `include` genera un `E_NOTICE` (un aviso) y el script sigue, mientras que `require` genera un error fatal y detiene la ejecución. `include_once` y `require_once` comprueban antes si el fichero ya se incluyó y, si es así, no lo procesan de nuevo, lo que evita redeclaraciones.

Las funciones y clases del fichero incluido quedan declaradas globalmente. Sus sentencias sueltas se ejecutan en el punto de inclusión y **comparten el ámbito de variables del principal**, pero solo las inicializadas *antes* de la llamada: una variable creada después provoca un aviso al usarse dentro.

### 3.5. Arrays: concepto y declaración

Un array PHP es un **mapa ordenado** que unifica en un solo tipo lo que otros lenguajes resuelven con vectores, listas y diccionarios. Cada elemento tiene una clave (entero o cadena) y un valor de cualquier tipo, incluido otro array; el orden interno es el de inserción.

```php
<?php
$frutas = array("manzana", "plátano", "uva");   // función array()
$valores = [10, 20, 30, 40];                   // sintaxis corta (PHP 5.4+)
$persona = [                                   // asociativo
    "nombre" => "Juan",
    "edad"   => 30,
    "ciudad" => "México"
];
$vacio = [];
$numeros = range(1, 5);                        // [1,2,3,4,5]
```

Si se omite la clave, PHP asigna enteros desde 0; al añadir sin clave se usa el **mayor entero existente más uno**. Se accede con `$array[clave]` y se elimina con `unset()`, que **no reindexa**: tras borrar el índice 1 quedan 0 y 2, y el siguiente elemento toma el 3. Un `string` se comporta como array de caracteres (`$palabra[2]`) y `preg_split()` separa una frase en un array; `split()` está eliminado desde PHP 7.

### 3.6. Recorrido y modificación: foreach

`foreach` recorre el array sin contador. Para modificar los valores durante el recorrido hay que declarar la variable por referencia (`&$valor`); si no, se trabaja sobre una copia. Conviene anular la referencia con `unset($valor)` al terminar.

```php
<?php
$precios = [10, 20, 30];

foreach ($precios as $precio) {
    $precio *= 2;          // modifica la copia, no el array
}

foreach ($precios as &$precio) {
    $precio *= 2;          // modifica el array original
}
unset($precio);            // rompe la referencia

print_r($precios);         // [20, 40, 60]
```

En arrays multidimensionales se anidan bucles: uno externo recorre las claves y otro interno, el array de valores.

### 3.7. Operadores de arrays

| Operador | Nombre | Resultado |
|---|---|---|
| `==` | Igual | `true` si ambos tienen los mismos pares clave/valor, **sin importar el orden** ni el tipo |
| `===` | Idéntico | `true` solo si coinciden clave, valor, tipo y **el mismo orden** |
| `+` | Unión | Array con los elementos del izquierdo y, a continuación, los del derecho **cuya clave no exista** ya |
| `!=` / `!==` | Distinto / no idéntico | Negación de `==` y de `===` |

El operador `+` **no sobrescribe**: ante claves repetidas prevalece el array de la izquierda, a diferencia de `array_merge()`, que reemplaza las claves de cadena y renumera las numéricas. Desde PHP 7.4, `[...$a, ...$b]` es una alternativa más legible.

### 3.8. Funciones y ámbito

Una función agrupa instrucciones que realizan una tarea concreta; puede recibir argumentos y devolver o no un valor. PHP no exige declarar el tipo devuelto y una función puede retornar tipos distintos según el caso; muchas nativas devuelven `false` ante error.

Funciones imprescindibles para inspeccionar variables y arrays:

| Función | Comportamiento |
|---|---|
| `isset($v)` | `true` si la variable existe y no es `null` |
| `empty($v)` | `true` si no existe o su valor es falso (`0`, `""`, `null`, `[]`) |
| `is_null($v)` | `true` solo si vale `null` |
| `unset($v)` | Destruye la variable o el elemento del array |
| `is_int/is_float/is_bool/is_array` | Comprueban el tipo |
| `print_r($v)` / `var_dump($v)` | Muestran el contenido; `var_dump` añade tipos y longitudes |
| `count($v)` | Número de elementos |
| `sort/asort/ksort` y `rsort/arsort/krsort` | Ordenan por valor o por clave, ascendente o descendente |
| `array_merge()` / `json_encode()` | Fusionan arrays / convierten a JSON |

Los argumentos admiten **valores por defecto**, que se aplican cuando la llamada los omite, como el segundo parámetro de `date()`. PHP pasa los parámetros **por copia**: la función recibe una variable local y modificar el argumento no altera la original; para ello hay que devolver el valor y reasignarlo o declarar el parámetro por referencia con `&`. También se puede pasar una función como argumento escribiendo su nombre entre comillas, base de los *callbacks*.

El **ámbito** es local: una variable externa no es visible dentro de una función salvo con `global $var` o `$GLOBALS`; las variables de la función dejan de existir al terminar.

### 3.9. Errores y excepciones

El sistema básico genera errores identificados por una constante: `E_NOTICE` (aviso; el script continúa), `E_WARNING` (advertencia), `E_ERROR` (error fatal que detiene la ejecución) y `E_ALL` (todos). Se configuran en `php.ini` con `error_reporting` (qué se reporta; lo habitual es `E_ALL`), `display_errors` (mostrar en la salida, propio de desarrollo), `log_errors` (guardar en un fichero, propio de producción) y `error_log` (ruta de ese fichero).

Desde PHP 5 existen las excepciones con bloques `try`/`catch`/`finally`, similares a Java: si ninguna captura la excepción, la ejecución se detiene, y `finally` se ejecuta siempre. Desde PHP 7 los fallos graves se representan con clases que heredan de `Error` y no de `Exception`, de modo que se capturan con `catch (Error $e)` o con `catch (Throwable $e)`, interfaz común a ambas jerarquías.

### 3.10. Formularios HTML y recepción de datos

Un formulario envía datos al servidor: el usuario rellena controles, pulsa el botón y el navegador genera una petición HTTP. El atributo `action` indica la ruta del script que procesará los datos (si es relativa, respecto a la ubicación del formulario) y `method` el método HTTP, `POST` en la mayoría de los casos. Cada control enviado necesita un atributo `name`, que será la clave del dato en el servidor.

| Método | Dónde viaja la información | Uso típico |
|---|---|---|
| `GET` | En la cadena de consulta de la URL (`?clave=valor`) | Búsquedas, enlaces, parámetros no sensibles |
| `POST` | En el cuerpo de la petición | Login, altas, datos sensibles o voluminosos |

En el script de destino los datos están en las superglobales `$_POST` o `$_GET`, indexadas por el `name` de cada control. Las versiones actuales desaconsejan el acceso directo y emiten avisos; la práctica recomendada es filtrar con `filter_input()`:

```php
<?php
// Nunca usar $_POST['nombre'] sin comprobar
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$email  = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($nombre === null || $email === false) {
    echo "Datos ausentes o inválidos";
} else {
    echo "Bienvenido, " . htmlspecialchars($nombre);
}
```

`filter_input()` devuelve `null` si el parámetro no llegó, `false` si no valida y el valor filtrado si es correcto. Para mostrar datos del usuario se aplica `htmlspecialchars()`, que neutraliza `<`, `>` y comillas e impide inyecciones de HTML o JavaScript (XSS).

### 3.11. Autenticación y procesamiento en un único fichero

Un formulario de login compara las credenciales y, según el resultado, da acceso o muestra un error. La redirección se hace con `header("Location: pagina.php")`, que **debe ejecutarse antes de cualquier salida**: si ya se ha hecho `echo`, las cabeceras están enviadas y la llamada falla.

Cuando formulario y procesamiento conviven en el mismo fichero hay que distinguir la primera visita (petición `GET`, se muestra el formulario) del envío (petición `POST`, se procesan los datos), consultando `$_SERVER['REQUEST_METHOD']`. Como destino del `action` se recomienda `htmlspecialchars($_SERVER['PHP_SELF'])`, que apunta al propio fichero y filtra los caracteres peligrosos de la URL.

## 💡 Ejemplos Prácticos y Aplicaciones

**1. Contador de frutas (ejercicio obligatorio UT3_1).** Se genera un array de entre 7 y 20 frutas elegidas al azar entre los códigos Unicode 127815–127827, se muestran y se cuenta cuántas veces aparece una fruta también aleatoria:

```php
<?php
$total = random_int(7, 20);
$frutas = [];
for ($i = 0; $i < $total; $i++) {
    $frutas[] = random_int(127815, 127827);   // código de fruta
}
foreach ($frutas as $codigo) {
    echo "&#$codigo; ";
}

$buscada = $frutas[array_rand($frutas)];
$contador = 0;
foreach ($frutas as $codigo) {
    if ($codigo === $buscada) {
        $contador++;
    }
}
echo "<p>La fruta &#$buscada; aparece $contador veces.</p>";
```

**2. Sustituir valores de un array (ejercicio obligatorio UT3_2).** Array de 50 elementos entre 1 y 10; los menores que 5 pasan a valer `"suspenso"`. Es el caso típico de modificación durante el recorrido, que exige referencia:

```php
<?php
$notas = [];
for ($i = 0; $i < 50; $i++) {
    $notas[] = random_int(1, 10);
}
echo implode(", ", $notas) . "<br>";

foreach ($notas as &$nota) {
    if ($nota < 5) {
        $nota = "suspenso";
    }
}
unset($nota);
echo implode(", ", $notas);
```

**3. Array multidimensional país → ciudades.** Cada posición externa es un array interno que se recorre con un segundo `foreach`:

```php
<?php
$paises = [
    "España"  => ["Madrid", "Sevilla", "Valencia"],
    "Francia" => ["París", "Lyon", "Niza"],
    "Italia"  => ["Roma", "Milán", "Nápoles"]
];

foreach ($paises as $pais => $ciudades) {
    echo "<h3>$pais</h3><ul>";
    foreach ($ciudades as $ciudad) {
        echo "<li>$ciudad</li>";
    }
    echo "</ul>";
}
```

**4. Formulario y procesamiento en un solo fichero.** El bloque de validación solo se ejecuta al enviar; la primera visita muestra el formulario:

```php
<?php
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = filter_input(INPUT_POST, 'usuario');
    $clave   = filter_input(INPUT_POST, 'clave');

    if ($usuario === "usuario" && $clave === "12345") {
        header("Location: bienvenido.html");
        exit;
    }
    $error = "Credenciales incorrectas";
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Acceso</title></head>
<body>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Usuario: <input type="text" name="usuario" required></label><br>
    <label>Clave: <input type="password" name="clave" required></label><br>
    <button type="submit">Entrar</button>
  </form>
  <p><?php echo $error; ?></p>
</body>
</html>
```

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Conceptos clave

1. **Condición y comparación laxa**: `if` convierte la expresión a booleano; `switch` compara con `==`, por lo que `"1"` y `1` coinciden.
2. **Caída de case**: sin `break`, `switch` ejecuta también los casos siguientes.
3. **do-while**: garantiza al menos una ejecución porque evalúa la condición al final.
4. **break N / continue**: `break 2` abandona dos niveles de anidamiento; `continue` solo salta la iteración actual.
5. **include vs require**: `E_NOTICE` y continuación frente a error fatal y detención del script.
6. **Array como mapa ordenado**: clave entera o cadena, valor de cualquier tipo, orden de inserción; sin clave, el mayor entero más uno.
7. **foreach por referencia**: `&$valor` permite modificar el array; sin `&` se modifica una copia.
8. **`==` vs `===` en arrays**: igualdad sin importar orden ni tipos frente a identidad con orden y tipos.
9. **Operador `+`**: unión sin sobrescribir claves; prevalece el array izquierdo.
10. **Paso por copia y ámbito**: los cambios en argumentos no afectan al original salvo referencia `&`; una función no ve variables externas sin `global`.
11. **`filter_input()`**: devuelve `null` si falta el parámetro y `false` si no valida.
12. **`header()` y `REQUEST_METHOD`**: la redirección precede a cualquier salida; `POST` distingue el envío del formulario de la visita inicial (`GET`).

### Preguntas de autoevaluación

**1. ¿Qué diferencia hay entre `if-elseif` y varios `if` independientes?**
Con `elseif` las ramas son excluyentes: al ser verdadera una condición no se evalúan las demás. Con `if` independientes todas se comprueban, y si la primera modifica la variable evaluada las siguientes pueden dar resultados no previstos.

**2. ¿Por qué es imprescindible el `break` en un `switch`?**
Porque `switch` no abandona la estructura al encontrar coincidencia: sin `break` sigue en el `case` siguiente y ejecuta sentencias de casos que no correspondían al valor evaluado.

**3. ¿Cuándo conviene `do-while` frente a `while`?**
Cuando el cuerpo debe ejecutarse al menos una vez, por ejemplo al pedir datos hasta que sean válidos: la condición solo puede comprobarse tras la primera lectura.

**4. ¿Qué ocurre si un `include` apunta a un fichero inexistente? ¿Y con `require`?**
`include` genera un `E_NOTICE` y el script prosigue; `require` produce un error fatal y detiene la ejecución. Por eso `require` se reserva para piezas imprescindibles.

**5. ¿Están disponibles en el fichero incluido las variables del principal?**
Sí, si se inicializaron antes de la inclusión, porque comparten ámbito. Una variable creada después no existe dentro y su uso genera un aviso.

**6. ¿Cómo se añade un elemento al final de un array sin indicar clave?**
Con `$array[] = $valor;`. PHP asigna el mayor entero existente más uno, o 0 si el array está vacío.

**7. ¿Por qué `foreach ($a as $v) { $v *= 2; }` no modifica el array?**
Porque `$v` es una copia de cada valor. Para alterar el array hay que recorrer por referencia (`as &$v`) o modificar por índice (`$a[$k] *= 2`).

**8. ¿Qué devuelven `[1,2] == [2=>1, 1=>2]` y `[1,2] === [2=>1, 1=>2]`?**
La primera es `true`: mismos pares clave/valor, sin importar el orden. La segunda es `false`: `===` exige mismo orden y tipos.

**9. ¿Qué diferencia hay entre `$a + $b` y `array_merge($a, $b)`?**
`+` añade de `$b` solo las claves que no existan en `$a`, por lo que las repetidas conservan el valor de `$a`. `array_merge()` sobrescribe las claves de cadena de `$b` y renumera las numéricas.

**10. ¿Qué hace `unset($a[1])` y qué efecto tiene sobre los índices?**
Elimina el elemento de clave 1 sin reindexar: los índices restantes conservan su valor y el próximo elemento añadido sin clave tomará el mayor entero más uno.
