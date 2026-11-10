# Desarrollo web en entorno servidor - Tema 2: Lenguaje PHP. Inserción de código en páginas web

## 📌 Resumen Ejecutivo y Objetivos

PHP (*PHP: Hypertext Preprocessor*) es un lenguaje de programación para el desarrollo web en el **lado servidor**. Aparecido en 1994, es uno de los más utilizados por su flexibilidad: permite escribir pequeños scripts con rapidez y, frente a Java, exige menos código y resulta menos engorroso.

La idea central del tema es que una página PHP no es un programa que se ejecute en el navegador, sino un documento HTML con código incrustado que **el servidor procesa antes de enviar la respuesta**: localiza los bloques `<?php ... ?>`, los ejecuta y sustituye cada uno por su salida. El cliente recibe solo HTML; si se consulta el código fuente (Ctrl + U) no aparece ni una línea de PHP.

El tema cubre el resultado de aprendizaje 2 («Escribe sentencias ejecutables por un servidor Web reconociendo y aplicando procedimientos de integración del código en lenguajes de marcas») y sus criterios: mecanismos de generación de páginas con código embebido, etiquetas de inclusión, sintaxis, sentencias simples y sus efectos, tipos de variables y operadores, ámbitos y diseño de aplicaciones web sencillas.

Objetivos de aprendizaje:

- Poner en marcha un entorno de ejecución (XAMPP/Apache) y publicar páginas en `htdocs`.
- Crear proyectos PHP en NetBeans y ejecutarlos contra Apache o el servidor integrado.
- Escribir bloques PHP correctamente delimitados dentro de HTML5 válido.
- Manejar variables, constantes y los distintos tipos de dato.
- Distinguir asignación por copia de asignación por referencia y explicar el ámbito.
- Emplear operadores respetando la precedencia y las funciones nativas habituales.

## 📖 Desarrollo Teórico Detallado

### 2.1. PHP y HTML: el modelo de código incrustado

Un archivo `.php` es un documento HTML con bloques de código intercalados. Las etiquetas `<?php` y `?>` permiten entrar y salir del «modo PHP» tantas veces como haga falta. El bloque es la unidad básica y contiene sentencias separadas por punto y coma.

```php
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Hola mundo</title>
</head>
<body>
  <?php
    echo "Hola Mundo";
  ?>
</body>
</html>
```

Al solicitar la página, el bloque desaparece y en su lugar aparece «Hola Mundo». La palabra reservada `echo` muestra el valor de una variable o de una cadena.

Recomendación del manual: **si un fichero contiene solo PHP, no debe cerrarse la etiqueta del último bloque**. Un `?>` final deja escapar un salto de línea o un espacio que puede dar problemas cuando la respuesta involucra varios ficheros (por ejemplo, al enviar cabeceras).

### 2.2. Cómo ejecutar el código para visualizarlo en el navegador

El PDF describe dos vías:

1. **Apache de XAMPP.** Se crea la página en `c:/xampp/htdocs/`, se inicia Apache y se solicita `http://localhost/hola.php`.
2. **NetBeans.** `File > New Project > PHP > PHP Application`; se indica nombre, ubicación y codificación. Se elige ejecutar contra el Apache de XAMPP (el proyecto debe estar en `c:/xampp/htdocs/`; URL `http://localhost/proyecto1`) o contra el servidor propio de NetBeans, que abre `http://localhost:8000` sea cual sea la ubicación.

Todo proyecto debe tener un `index.php`, página que se carga por defecto al escribir la URL del proyecto (`http://localhost/proyecto1/`). Para el resto hay que indicar el fichero: `http://localhost/proyecto1/nombrepagina.php`.

### 2.3. Sintaxis: bloques, sentencias y comentarios

Cada sentencia termina en punto y coma. Los comentarios son **de bloque**, entre `/*` y `*/`, o **de línea**, con `//` o `#`. Comentar el código se considera buena práctica y los enunciados de ejercicios lo exigen.

```php
<?php
/* Cálculo del importe total
   de una compra */
$precio = 19.95;
$unidades = 3;
$total = $precio * $unidades; // multiplicación
# también válido con almohadilla
echo $total;
```

### 2.4. Variables y tipado dinámico

PHP **no es fuertemente tipado**: no se indica el tipo al declarar y las variables, de hecho, no se declaran: **se crean la primera vez que se les asigna un valor**. El tipo depende del valor inicial. Esto agiliza la escritura, pero puede generar código de baja calidad y errores difíciles de depurar.

Reglas: el identificador va precedido de `$`, debe comenzar por letra o guion bajo (`_`) y puede contener números, letras y guiones bajos.

```php
<?php
$entero = 4;          // integer
echo $entero;
$entero = "cuatro";   // el tipo cambia al asignar otro tipo
```

### 2.5. Asignación por copia y por referencia

Por defecto la asignación es **por copia**: `$a = $b` crea una variable nueva con el valor de `$b`; ambas ocupan posiciones de memoria distintas. Con el ampersand (`&`) se crea una **referencia**: `$var2 = &$var1` hace que `$var2` apunte a la misma dirección, de modo que los dos nombres designan el mismo dato.

```php
<?php
$var1 = 10;
$var2 = &$var1;   // referencia
$var2 = 20;
echo $var1;       // 20

$copia = $var1;
$copia = 99;
echo $var1;       // sigue siendo 20
```

### 2.6. Variables no inicializadas

Si una variable no inicializada aparece en una expresión, esta se calcula tomando el **valor por defecto de su tipo**. Además se genera un error `E_NOTICE` que **no interrumpe** el script.

```php
<?php
$contador = $sin_inicializar + 1;  // E_NOTICE; vale 0
echo $contador;                    // 1
```

### 2.7. Constantes

Se definen con `define()`, que recibe nombre y valor. Por convenio se escriben en mayúsculas, no llevan `$` y no cambian.

```php
<?php
define("LIMITE", 1000);
echo LIMITE;
if (LIMITE > 500) {
    echo "El límite es alto";
}
```

### 2.8. Tipos de datos

PHP ofrece cuatro tipos **escalares** (integer, float, boolean, string) y varios **compuestos o especiales**.

| Tipo | Descripción | Ejemplo |
|---|---|---|
| `integer` | Enteros. Tamaño y rango dependen de la plataforma; se consultan con `PHP_INT_SIZE`, `PHP_INT_MAX` y `PHP_INT_MIN`. | `$n = 42;` |
| `float` | Reales; precisión habitual de unos 14 decimales. | `$p = 19.95;` |
| `boolean` | Solo `TRUE` o `FALSE`. | `$ok = true;` |
| `string` | Cadenas de caracteres. | `$s = "Hola";` |
| `array` | Colección de elementos. | `$a = array('Azul','Rojo');` |
| `object` | Instancia de clase; PHP soporta POO completa. | `$o = new stdClass();` |
| `callable` | Función de callback pasada a otra función. | — |
| `null` | Variable no asignada o asignada a `NULL`. | `$x = null;` |
| `resource` | Recurso externo, como una conexión a base de datos. | — |

La conversión entre `integer` y `float` es automática; también se fuerza con `(int)` y `(float)`.

**Cadenas y comillas.** Con comillas dobles («comillas mágicas») las variables de la cadena se sustituyen por su valor; con simples, no.

```php
<?php
$nombre = "Ana";
echo "Hola $nombre";   // Hola Ana
echo 'Hola $nombre';   // Hola $nombre
```

**Booleanos.** Al esperar un booleano y recibir otro tipo se aplican estas reglas:

| Tipo | Valor como boolean |
|---|---|
| `integer` | `FALSE` si es 0; en otro caso `TRUE` |
| `float` | `FALSE` si es 0.0; en otro caso `TRUE` |
| `string` | `FALSE` si es cadena vacía o `"0"`; en otro caso `TRUE` |
| Variable no inicializada | `FALSE` |
| `null` | `FALSE` |
| `array` | `FALSE` si está vacío; en otro caso `TRUE` |

### 2.9. Ámbito de las variables y variables predefinidas

El ámbito es la parte del código en que una variable es visible:

- Una variable declarada en un fichero está disponible en ese fichero **y en los que se incluyan desde él**.
- Las funciones definen **ámbito local**: sus variables solo se ven desde la propia función y desde ella no se accede a variables externas salvo locales o argumentos.
- Para usar globales dentro de una función: la palabra `global` o la variable `$GLOBALS`.

Las **superglobales** son variables predefinidas disponibles en cualquier ámbito; cada una guarda un tipo de información.

| Superglobal | Contenido |
|---|---|
| `$_SERVER` | Información del servidor y del entorno (nombre, software, etc.). |
| `$_GET` | Parámetros enviados por URL. |
| `$_POST` | Datos enviados en el cuerpo de la petición. |
| `$_FILES` | Ficheros subidos por formulario. |
| `$_COOKIE` | Cookies del cliente. |
| `$_SESSION` | Variables de sesión. |
| `$_ENV` | Variables de entorno. |
| `$_REQUEST` | Datos combinados de GET, POST y cookies. |
| `$GLOBALS` | Todas las variables del ámbito global. |

```php
<?php
echo $_SERVER['SERVER_NAME'];
echo $_SERVER['SERVER_SOFTWARE'];
echo phpversion();
```

### 2.10. Expresiones y operadores

Una **expresión** es «cualquier cosa que tiene un valor»; en PHP casi todo lo es. Las formas básicas son constantes y variables: en `$a = 5`, tanto `5` como `$a` valen 5.

| Grupo | Operadores |
|---|---|
| Asignación | `=`, y combinados `+=`, `-=`, `*=`, `/=`, `%=`, `.=` |
| Aritméticos | `+`, `-`, `*`, `/`, `%` (módulo), `**` (exponenciación) |
| Comparación | `==`, `!=`, `<>`, `===`, `!==`, `<`, `>`, `<=`, `>=`, `<=>` (PHP 7), `??` (PHP 7) |
| Lógicos | `and`, `or`, `xor`, `!`, `&&`, `\|\|` |
| Incremento | `++$a`, `$a++`, `--$a`, `$a--` |
| Cadena | `.` (concatenación) |
| Arrays | `+` (unión), `==`, `===`, `!=`, `<>`, `!==` |

Los operadores **idéntico** (`===`) y **no idéntico** (`!==`) no existen en todos los lenguajes: son verdaderos cuando las expresiones tienen el mismo valor **y el mismo tipo**. `==`, en cambio, intenta convertir los tipos antes de comparar.

```php
<?php
$a = 5;
$b = "5";
var_dump($a == $b);    // bool(true)
var_dump($a === $b);   // bool(false): distinto tipo
```

`<=>` devuelve un entero menor, igual o mayor que cero según que el operando izquierdo sea menor, igual o mayor que el derecho. `??` devuelve el primer operando, de izquierda a derecha, que exista y no sea `NULL`. En los incrementos, **pre** y **post** difieren en el orden: `++$a` suma y luego devuelve; `$a++` devuelve el valor original y luego suma.

```php
<?php
$a = 5;
echo $a++;   // 5, y $a pasa a 6
echo $a;     // 6
$b = 5;
echo ++$b;   // 6, y $b pasa a 6
```

En arrays, `+` añade el array derecho al izquierdo, pero **para claves presentes en ambos conserva las de la izquierda**. `==` exige las mismas parejas clave/valor; `===`, además, el mismo orden y los mismos tipos.

### 2.11. Orden de prioridad

Los operadores matemáticos y lógicos tienen precedencia. La recomendación del tema es tajante: **cuando una expresión combina varios operadores, usar paréntesis**; así no hay dudas ni interpretaciones distintas.

### 2.12. Funciones nativas: numéricas, de cadena, de tipo y de fecha

**Numéricas**

| Función | Comportamiento |
|---|---|
| `round($n, $precision)` | Redondeo al más cercano, con precisión opcional. Muy usado para promedios. |
| `floor($n)` | Siempre hacia abajo: `floor(1.50)` → 1. |
| `ceil($n)` | Siempre hacia arriba: `ceil(1.50)` → 2. |
| `rand($min, $max)` | Entero aleatorio en el rango, extremos incluidos. |

**Cadenas** (el primer carácter ocupa la posición 0)

| Función | Comportamiento |
|---|---|
| `strlen()` / `mb_strlen()` | Longitud en bytes / en caracteres Unicode. |
| `substr($s, $inicio, $long)` | Extrae un fragmento; un inicio negativo cuenta desde el final. |
| `mb_substr()` | Igual, con caracteres multibyte. |
| `strtoupper()` / `mb_strtoupper()` | A mayúsculas; `mb_` respeta tildes y eñes. |
| `strtolower()` / `mb_strtolower()` | A minúsculas. |
| `ucfirst()` | Primera letra de la cadena en mayúscula. |
| `ucwords()` | Primera letra de cada palabra en mayúscula. |
| `mb_convert_case($s, $modo)` | `MB_CASE_UPPER`, `MB_CASE_LOWER` o `MB_CASE_TITLE`, con Unicode. |
| `trim()` / `ltrim()` / `rtrim()` | Eliminan espacios (u otros caracteres) a ambos lados, izquierda o derecha. |
| `str_replace($buscar, $reemplazar, $cadena, $count)` | Sustituye apariciones; `$count` cuenta los reemplazos. |
| `strtr($cadena, $from, $to)` | Convierte carácter a carácter según las posiciones de `$from` y `$to`. |
| `substr_count($cadena, $subcadena)` | Cuenta apariciones; sirve para saber si una cadena contiene a otra. |
| `strstr($c1, $c2)` | Devuelve desde la primera aparición de `$c2` hasta el final; distingue mayúsculas. |
| `strpos()` / `stripos()` | Posición de la primera aparición, con o sin distinción de mayúsculas. |
| `str_contains()` (PHP 8) | `true` si la cadena contiene la subcadena. |
| `var_dump()` / `print_r()` | Muestran estructura y contenido de una variable; imprescindibles en desarrollo. |

Detalle crítico: al comprobar `strpos()` hay que usar `=== false`, porque `==` simple falla cuando la posición encontrada es 0 (el primer carácter).

**Conversión y comprobación de tipos**

| Conversión | Comprobación |
|---|---|
| `boolval()`, `intval()`, `floatval()`, `strval()` | `is_int()`, `is_float()`, `is_bool()`, `is_null()` |
| `settype($var, "integer")` (modifica la variable) | `is_numeric()`, `is_string()`, `is_array()`, `is_object()` |

**Fechas**

| Función | Comportamiento |
|---|---|
| `date($formato, $timestamp)` | Formatea una fecha; el segundo parámetro es opcional. |
| `mktime($h, $i, $s, $mes, $dia, $anio)` | Timestamp de una fecha concreta, en ese orden. |
| `time()` | Timestamp del momento actual. |
| `strtotime($cadena)` | Convierte una fecha en texto a timestamp (operación inversa). |
| `checkdate($mes, $dia, $anio)` | `true` si la fecha es válida; `false` en caso contrario. |

Formatos: `d` día con dos dígitos, `m` mes con dos dígitos, `Y` año con cuatro, `H` hora (24 h), `i` minutos, `s` segundos. En mayúscula, `D`/`l` y `M`/`F` dan el nombre del día y del mes. El timestamp o marca de tiempo Unix es el número de segundos desde el 1/1/1970 a las 00:00:00.

## 💡 Ejemplos Prácticos y Aplicaciones

### Ejemplo 1: página completa con bloque incrustado y fecha

```php
<?php
$mensaje = "¡Hola Mundo! Tu servidor PHP está funcionando correctamente.";
$fechaActual = date("d/m/Y H:i");

echo "<h2 class='h4 text-primary'>Mensaje desde el servidor:</h2>";
echo "<p class='lead'>$mensaje</p>";
echo "<hr>";
echo "<p class='text-secondary small'>Fecha y hora de generación: $fechaActual</p>";
?>
```

Este patrón —variables al inicio y salida HTML con `echo`— se repite en todos los ejercicios, siempre dentro de HTML5 válido y con Bootstrap.

### Ejemplo 2: operaciones aritméticas

```php
<?php
$primerNumero = 8;
$segundoNumero = 5;

echo "Resto de dividir el primero entre 5: " . ($primerNumero % 5) . "<br>";
echo "División: " . ($primerNumero / $segundoNumero) . "<br>";
echo "Suma: " . ($primerNumero + $segundoNumero) . "<br>";
?>
```

### Ejemplo 3: cadenas con acentos (multibyte)

```php
<?php
$palabra = "Martín Martínez León";
echo "Longitud: " . strlen($palabra);                 // 21 bytes
echo "<br>Longitud unicode: " . mb_strlen($palabra);  // 18 caracteres
echo "<br>Mayúsculas: " . mb_strtoupper($palabra);
echo "<br>Recorte: " . mb_substr($palabra, 5, 10);
?>
```

`strtoupper()` deja «MARTíN MARTíNEZ LEóN»; `mb_strtoupper()` produce «MARTÍN MARTÍNEZ LEÓN». Por eso las funciones `mb_*` son obligatorias con textos acentuados.

### Ejemplo 4: recuento de apariciones y reemplazo

```php
<?php
$text = 'This is a test';
echo strlen($text);              // 14
echo substr_count($text, 'is');  // 2

$frase = 'Una manzana y una manzana son dos manzanas';
echo str_replace('manzana', 'naranja', $frase);

$frase2 = 'Marge_creo_que_odio_a_Mickael_Jackson.';
$nueva = str_replace('_', '-', $frase2, $c);
echo "$nueva Cambios $c";   // ... Cambios 6
?>
```

Para contar todas las «t» hay que sumar mayúscula y minúscula (`substr_count($text, 't') + substr_count($text, 'T')`), porque la función distingue mayúsculas.

### Ejemplo 5: diferencia entre dos instantes con `mktime()`

```php
<?php
$mktime1 = mktime(19, 50, 02, 09, 07, 2020);
$mktime2 = mktime(18, 50, 02, 09, 07, 2020);
echo $mktime1 - $mktime2;            // 3600
echo date('d-m-Y H:i:s', $mktime1);  // 07-09-2020 19:50:02
?>
```

### Ejemplo 6: parámetros por GET y validación de fecha

```php
<?php
$num1 = $_GET['num1'] ?? 0;
$num2 = $_GET['num2'] ?? 0;
$num3 = $_GET['num3'] ?? 0;
$suma = $num1 + $num2 + $num3;
echo "Suma: $suma — Media: " . ($suma / 3) . " — Máximo: " . max($num1, $num2, $num3);

if (checkdate(11, 31, 1986)) {
    echo 'La fecha es correcta';
} else {
    echo 'La fecha es incorrecta';   // noviembre tiene 30 días
}
?>
```

El ejercicio avanzado obligatorio articula estos contenidos en tres páginas (`matematicas.php`, `cadena.php`, `infoServidor.php`) enlazadas desde `index.php`, con resultados en tablas Bootstrap, navegación de vuelta y parámetros por URL.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Errores típicos que se preguntan

| Confusión | Regla correcta |
|---|---|
| `==` frente a `===` | `==` convierte tipos; `===` exige valor **y** tipo. |
| `strpos()` devuelve 0 | Comprobar con `=== false`, nunca con `== false`. |
| `floor()` frente a `ceil()` | `floor(1.5)=1`, `ceil(1.5)=2`, `round(1.5)=2`. |
| `strlen()` frente a `mb_strlen()` | `strlen` cuenta bytes; `mb_strlen`, caracteres. |
| Comillas simples y dobles | Solo las dobles interpolan variables. |
| Copia frente a referencia | `=` copia; `=&` comparte posición de memoria. |
| Cerrar `?>` en un fichero solo PHP | No se cierra: evita salidas accidentales. |
| `$a++` frente a `++$a` | Post devuelve el valor antiguo; pre, el nuevo. |

### Preguntas de autoevaluación

**1. ¿Qué hace el servidor con un bloque PHP?**
Lo ejecuta y lo sustituye por su salida. El bloque no llega al navegador; este solo recibe HTML.

**2. ¿Por qué una página `.php` no funciona abriéndola con doble clic?**
Porque el código lo debe ejecutar un intérprete PHP dentro de un servidor web. Sin servidor, el navegador recibiría el script como texto.

**3. ¿Diferencia entre `$a = $b` y `$a = &$b`?**
La primera crea una variable nueva con una copia del valor; la segunda crea un alias que apunta al mismo dato, de modo que modificar una afecta a la otra.

**4. ¿Qué ocurre al usar una variable no inicializada?**
Se genera un `E_NOTICE` que no detiene el script, y la expresión se evalúa con el valor por defecto del tipo (0, 0.0, cadena vacía o `false`).

**5. ¿Cómo se define una constante y en qué se diferencia de una variable?**
Con `define("NOMBRE", valor)`. No lleva `$`, no cambia de valor y por convenio va en mayúsculas.

**6. ¿Qué valores se convierten a `false` en contexto booleano?**
El entero 0, el float 0.0, la cadena vacía y `"0"`, una variable no inicializada, `null` y un array vacío.

**7. ¿Por qué `5 == "5"` es verdadero y `5 === "5"` falso?**
Porque `==` convierte el string a número antes de comparar, mientras que `===` exige además el mismo tipo.

**8. ¿Qué diferencia hay entre variable local y global en una función?**
La función tiene ámbito propio: no ve las externas salvo con `global` o `$GLOBALS`, y sus locales desaparecen al terminar.

**9. ¿Qué devuelve `mktime(19,50,02,09,07,2020)` y para qué sirve?**
El timestamp del 7/9/2020 a las 19:50:02, es decir, los segundos desde el 1/1/1970. Restar dos timestamps da la diferencia en segundos (3600 en el ejemplo de una hora).

**10. ¿Qué hace `checkdate(11, 31, 1986)` y por qué?**
Devuelve `false` porque noviembre tiene 30 días; valida mes, día y año en ese orden.

### Conceptos clave

1. **Código incrustado**: HTML con bloques `<?php ... ?>` que el servidor ejecuta y sustituye por su salida.
2. **Tipado dinámico**: la variable no se declara; su tipo depende del valor asignado y puede cambiar.
3. **Asignación por referencia**: `&` hace que dos nombres compartan la misma posición de memoria.
4. **Constante**: valor inmutable definido con `define()`, sin `$` y en mayúsculas por convenio.
5. **Ámbito**: parte del código donde una variable es visible; las funciones crean ámbito local.
6. **Superglobal**: variable predefinida accesible desde cualquier ámbito (`$_SERVER`, `$_GET`, `$_POST`...).
7. **Expresión**: cualquier construcción con un valor; constante, variable u operación.
8. **Idéntico (`===`)**: igualdad de valor y tipo, sin conversión previa.
9. **Precedencia**: orden de evaluación de operadores; se controla con paréntesis.
10. **Multibyte (`mb_*`)**: funciones que cuentan y transforman caracteres Unicode, no bytes.
11. **Timestamp**: segundos desde el 1/1/1970 00:00:00; base de `mktime()`, `time()` y `strtotime()`.
12. **`E_NOTICE`**: aviso por variable no inicializada; no interrumpe la ejecución.
