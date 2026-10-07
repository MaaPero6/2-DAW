# 🐘 Guía Práctica de PHP para Programadores provenientes de Java

Bienvenido a PHP. Si ya sabes programar en **Java**, tienes una base muy sólida de lógica de programación (variables, condicionales, bucles, funciones). Sin embargo, **PHP funciona de manera muy distinta a nivel de arquitectura y web**.

Esta guía está diseñada específicamente para ti: compararemos la sintaxis de **Java vs PHP** y explicaremos paso a paso **todas las etiquetas HTML** que se utilicen en los ejemplos para que no te pierdas.

---

## ☕ 1. De Java a PHP: Cambio de Mentalidad

| Concepto | ☕ Java | 🐘 PHP |
|---|---|---|
| **Paradigma base** | 100 % Orientado a Objetos (Todo debe estar dentro de una `class`). | Híbrido/Procedural. Puedes escribir scripts línea a línea sin crear clases. |
| **Punto de entrada** | `public static void main(String[] args)` | No hay `main`. El servidor lee el archivo `.php` de arriba a abajo. |
| **Tipado** | **Estático y Fuerte:** `int x = 5;` (No cambia de tipo). | **Dinámico y Débil:** `$x = 5;` (Puede pasar a ser String o Array después). |
| **Compilación** | Compila a *bytecode* (`.class`) ejecutado en la **JVM**. | **Interpretado al vuelo** en el servidor web (Apache / Nginx) en cada petición. |
| **Sintaxis de variables** | `String nombre = "Ana";` | `$nombre = "Ana";` (Toda variable empieza obligatoriamente por `$`). |
| **Concatenar texto** | Operador suma `+`: `"Hola " + nombre` | Operador punto `.`: `"Hola " . $nombre` |

---

## 🌐 2. ¿Cómo se mezcla PHP con HTML?

En Java, cuando haces una aplicación de consola usas `System.out.println()`. En la web con PHP, **la salida (`echo`) se envía directamente al navegador como código HTML**.

```
  ┌───────────────────────────────────────────────────────────┐
  │ 1. El cliente (navegador) pide: http://localhost/index.php│
  └─────────────────────────────┬─────────────────────────────┘
                                │
                                ▼
  ┌───────────────────────────────────────────────────────────┐
  │ 2. El servidor Apache procesa el archivo index.php        │
  │    - Lee el HTML normal.                                  │
  │    - Al encontrar <?php ... ?>, ejecuta el código.       │
  │    - Sustituye el bloque PHP por lo que emita con echo.   │
  └─────────────────────────────┬─────────────────────────────┘
                                │
                                ▼
  ┌───────────────────────────────────────────────────────────┐
  │ 3. El cliente recibe ÚNICAMENTE HTML plano generado       │
  └───────────────────────────────────────────────────────────┘
```

---

## 🏷️ 3. Glosario Rápido de Etiquetas HTML que vas a ver

Como estás empezando con HTML, aquí tienes la explicación de las etiquetas básicas que usaremos en los ejemplos de código:

| Etiqueta HTML | Significado | ¿Para qué sirve? |
|---|---|---|
| `<!DOCTYPE html>` | Declaración de documento | Le dice al navegador que el archivo usa la versión **HTML5**. |
| `<html> ... </html>` | Raíz | Enuelve absolutamente todo el documento web. |
| `<head> ... </head>` | Cabecera invisible | Contiene metadatos, título de la pestaña y configuración de caracteres (`utf-8`). |
| `<body> ... </body>` | Cuerpo visible | Contiene todo lo que el usuario ve en la pantalla (textos, botones, tablas). |
| `<h1>` a `<h6>` | Encabezados (*Headings*) | Títulos. `<h1>` es el título principal (más grande) y `<h6>` el sub-subtítulo más pequeño. |
| `<p> ... </p>` | Párrafo | Bloque de texto normal. |
| `<br>` | Salto de línea | Equivale a pulsar *Enter* en el texto visual (no necesita etiqueta de cierre). |
| `<strong> ... </strong>` | Negrita | Destaca un texto en negrita. |
| `<ul>` y `<li>` | Lista No Ordenada | `<ul>` crea una lista con viñetas (*Unordered List*) y cada `<li>` es un elemento (*List Item*). |
| `<table>`, `<tr>`, `<td>` | Tabla de datos | `<table>` crea la tabla, `<tr>` crea una fila (*Table Row*) y `<td>` una celda de datos (*Table Data*). |

---

## 📝 4. Inserción de Código y Ejemplo "Hola Mundo"

### Comparativa: Salida por Pantalla

#### ☕ En Java:
```java
public class HolaMundo {
    public static void main(String[] args) {
        System.out.println("Hola Mundo desde Java");
    }
}
```

#### 🐘 En PHP (dentro de una página web HTML):
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Primera Página PHP</title>
</head>
<body>

    <!-- Las etiquetas <h1> son el título de la página en HTML -->
    <h1>Bienvenido a mi sitio web</h1>

    <!-- 
        Abrimos el modo PHP con <?php y lo cerramos con ?>
        La instrucción 'echo' es el equivalente a System.out.println()
    -->
    <p>
        <?php 
            echo "Hola Mundo desde PHP"; 
        ?>
    </p>

</body>
</html>
```

> 💡 **Nota clave:** Todo lo que escribas dentro de `echo` se imprimirá como contenido dentro del HTML. ¡Incluso puedes meter etiquetas HTML dentro del `echo`!
> ```php
> echo "<strong>Este texto saldrá en negrita</strong>";
> ```

---

## 🔢 5. Variables, Tipos de Datos y Operadores

### Declaración de Variables

En Java debes especificar siempre el tipo de dato (`int`, `double`, `String`, `boolean`). **En PHP NO se pone tipo, pero SIEMPRE debes poner el signo del dólar (`$`) antes del nombre.**

```java
// ☕ En Java (Tipado Estático)
int edad = 20;
double precio = 15.50;
String nombre = "Carlos";
boolean esEstudiante = true;
```

```php
// 🐘 En PHP (Tipado Dinámico)
$edad = 20;
$precio = 15.50;
$nombre = "Carlos";
$esEstudiante = true;
```

### Concatenación de Cadenas (¡Cuidado! Diferencia vital con Java)

En Java usas el operador `+` para unir texto y variables. **En PHP el operador `+` es EXCLUSIVAMENTE para sumar números.** Para concatenar texto en PHP se usa el **PUNTO (`.`)**.

```java
// ☕ En Java
String saludo = "Hola " + nombre + ", tienes " + edad + " años.";
```

```php
// 🐘 En PHP (Uso del punto .)
$saludo = "Hola " . $nombre . ", tienes " . $edad . " años.";
```

### Comillas Dobles (`" "`) vs Comillas Simples (`' '`) en PHP

En Java, las comillas simples `'a'` son para un solo carácter (`char`) y las dobles `"Hola"` para `String`.
En PHP, ambas sirven para `String`, pero funcionan diferente:

```php
$nombre = "Ana";

// Comillas dobles: EVALÚAN e INTERPOLAN las variables dentro del texto (¡Muy cómodo!)
echo "Hola $nombre, bienvenida"; // Imprime: Hola Ana, bienvenida

// Comillas simples: Tratan todo como TEXTO LITERAL
echo 'Hola $nombre, bienvenida'; // Imprime: Hola $nombre, bienvenida
```

---

## 🔀 6. Estructuras de Control (Comparadas con Java)

Las estructuras de control en PHP son **casi idénticas a Java**, con pequeñas diferencias sintácticas.

### Condicionales: `if`, `elseif`, `else`

En Java escribes `else if` (separado). En PHP puedes escribir `else if` o la palabra compacta `elseif`.

```php
$nota = 7;

if ($nota >= 9) {
    echo "<p>Sobresaliente</p>";
} elseif ($nota >= 5) { // También se puede escribir "else if"
    echo "<p>Aprobado</p>";
} else {
    echo "<p>Suspenso</p>";
}
```

### Comparación de Igualdad: `==` vs `===` (Crucial en PHP)

En Java usas `x == y` para primitivos y `.equals()` para objetos.
En PHP no existe `.equals()`, pero hay **dos tipos de comparadores de igualdad**:

```php
$numero = 5;      // entero (int)
$texto = "5";     // cadena (string)

// 1. Igualdad débil (==): Compara SOLO EL VALOR (convierte tipos automáticamente)
if ($numero == $texto) {
    echo "Son iguales en valor"; // ¡SE EJECUTA! (PHP convierte "5" a 5)
}

// 2. Igualdad estricta o Identidad (===): Compara VALOR Y TIPO DE DATO (Como en Java)
if ($numero === $texto) {
    echo "Son idénticos"; 
} else {
    echo "No son idénticos porque uno es int y el otro es string"; // ¡SE EJECUTA ESTE!
}
```

> 💡 **Buena práctica:** En PHP acostúmbrate a usar siempre **`===`** y **`!==`** para evitar sorpresas por conversiones implícitas de tipo.

### Bucles: `for`, `while`, `do-while`

La sintaxis es **exactamente idéntica a Java**:

```php
// Bucle FOR (Idéntico a Java)
for ($i = 0; $i < 5; $i++) {
    echo "Línea " . $i . "<br>";
}

// Bucle WHILE
$contador = 0;
while ($contador < 3) {
    echo "Contando: $contador <br>";
    $contador++;
}
```

---

## 📦 7. Arrays en PHP: El equivalente a ArrayList y HashMap de Java

En Java tienes distintos tipos de colecciones:
* Arrays fijos: `int[]`
* Listas dinámicas: `ArrayList<String>`
* Mapas Clave-Valor: `HashMap<String, Integer>`

**En PHP SOLO EXISTE UN TIPO DE ARRAY (`array`), pero es tan flexible que sirve para todo.**

### 1. Array Indexado (Equivalente a `ArrayList` en Java)

Las posiciones se numeran automáticamente con índices `0, 1, 2...`

```php
// Crear un array (usando la sintaxis corta de corchetes [])
$frutas = ["Manzana", "Plátano", "Naranja"];

// Añadir un elemento al final (equivalente a frutas.add("Uva") en Java)
$frutas[] = "Uva";

// Acceder a una posición (equivalente a frutas.get(0) en Java)
echo $frutas[0]; // Muestra: Manzana
```

### 2. Array Asociativo (Equivalente a `HashMap` en Java)

En lugar de índices numéricos, usas **cadenas de texto como claves**. Se usa el operador flecha de asignación **`=>`**.

```php
// Crear un mapa clave -> valor (como un HashMap<String, Object> en Java)
$persona = [
    "nombre" => "Carlos",
    "edad" => 25,
    "profesion" => "Programador"
];

// Acceder por clave (equivalente a persona.get("nombre") en Java)
echo $persona["nombre"]; // Muestra: Carlos
```

### Recorrer Arrays con `foreach` (El bucle estrella de PHP)

En Java usas `for (String f : frutas)`. En PHP se usa la sentencia **`foreach`**:

#### Recorrer solo valores (Array indexado):
```php
$frutas = ["Manzana", "Plátano", "Naranja"];

echo "<ul>"; // <ul> crea el inicio de una Lista HTML con viñetas
foreach ($frutas as $fruta) {
    // <li> representa un elemento de la lista en HTML
    echo "<li>$fruta</li>";
}
echo "</ul>";
```

##### 🖥️ Resultado en el navegador:
* Manzana
* Plátano
* Naranja

#### Recorrer Clave y Valor (Array asociativo / HashMap):
```php
$persona = [
    "Nombre" => "Ana",
    "Edad" => 28,
    "Ciudad" => "Madrid"
];

echo "<table border='1'>"; // <table> crea una tabla en HTML con borde 1
foreach ($persona as $clave => $valor) {
    // <tr> crea una FILA, y <td> crea una CELDA de datos en HTML
    echo "<tr>";
    echo "<td><strong>$clave</strong></td>";
    echo "<td>$valor</td>";
    echo "</tr>";
}
echo "</table>";
```

##### 🖥️ Resultado impreso como Tabla HTML:
| Nombre | Ana |
|---|---|
| Edad | 28 |
| Ciudad | Madrid |

---

## 📋 8. Formularios HTML e Interacción con PHP

En Java Servlets usarías `request.getParameter("usuario")`. En PHP, cuando el usuario envía un formulario HTML, los datos llegan automáticamente en las superglobales **`$_POST`** o **`$_GET`**.

### Glosario de etiquetas HTML para Formularios

| Etiqueta / Atributo HTML | Función |
|---|---|
| `<form action="..." method="...">` | Contenedor del formulario. <br>• `action`: Archivo PHP que procesará los datos.<br>• `method`: `POST` (envío oculto) o `GET` (envío por la URL). |
| `<label for="...">` | Etiqueta de texto asociada a un campo de entrada. |
| `<input type="text" name="...">` | Caja de texto para escribir. **El atributo `name` es la clave que leerá PHP.** |
| `<input type="password" name="...">` | Caja de texto que oculta lo que escribes (para contraseñas). |
| `<button type="submit">` | Botón para enviar el formulario al servidor. |

---

### Ejercicio Completo: Formulario y Procesamiento en la misma página

Este es el patrón estándar en PHP: el mismo archivo muestra el formulario (si entras por primera vez) y procesa los datos (cuando pulsas el botón Enviar).

Guarda este código como **`login.php`** en tu servidor local:

```php
<?php
// --- BLOQUE 1: LÓGICA DE PROCESAMIENTO (SERVIDOR) ---
$mensajeRespuesta = "";

// Comprobamos si la página ha sido llamada mediante un envío POST (al pulsar el botón)
// $_SERVER['REQUEST_METHOD'] equivale a pedir el método HTTP de la petición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recuperamos los datos enviados desde los <input name="..."> del HTML
    // Usamos filter_input por seguridad para evitar avisos si el campo no existe
    $usuarioEnviado = filter_input(INPUT_POST, 'usuario_campo', FILTER_DEFAULT);
    $claveEnviada = filter_input(INPUT_POST, 'clave_campo', FILTER_DEFAULT);

    // Validación sencilla de credenciales
    if ($usuarioEnviado === "admin" && $claveEnviada === "1234") {
        $mensajeRespuesta = "<p style='color: green;'>¡Bienvenido, $usuarioEnviado! Acceso concedido.</p>";
    } else {
        $mensajeRespuesta = "<p style='color: red;'>Usuario o contraseña incorrectos.</p>";
    }
}
?>

<!-- --- BLOQUE 2: INTERFAZ VISUAL (HTML) --- -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Login en PHP</title>
</head>
<body>

    <h1>Iniciar Sesión</h1>

    <!-- Si hay un mensaje de respuesta (positivo o error), lo mostramos aquí -->
    <?php 
        if ($mensajeRespuesta !== "") {
            echo $mensajeRespuesta; 
        }
    ?>

    <!-- 
        FORMULARIO HTML:
        - action="login.php": Se envía a sí mismo.
        - method="POST": Envía los datos ocultos en el cuerpo de la petición.
    -->
    <form action="login.php" method="POST">
        
        <p>
            <label for="usr">Usuario:</label><br>
            <!-- El atributo name='usuario_campo' es lo que leerá $_POST['usuario_campo'] -->
            <input type="text" id="usr" name="usuario_campo" required>
        </p>

        <p>
            <label for="pwd">Contraseña:</label><br>
            <input type="password" id="pwd" name="clave_campo" required>
        </p>

        <p>
            <button type="submit">Entrar</button>
        </p>

    </form>

</body>
</html>
```

---

## 🛠️ 9. Funciones Útiles de PHP (Comparativa rápida con Java)

| Tarea | ☕ En Java | 🐘 En PHP |
|---|---|---|
| **Definir función** | `public int sumar(int a, int b) { return a + b; }` | `function sumar($a, $b) { return $a + $b; }` |
| **Saber si existe una variable** | Comprobar `if (obj != null)` | `if (isset($variable))` |
| **Saber si está vacía** | `str.isEmpty()` o `lista.isEmpty()` | `if (empty($variable))` (Devuelve true si es null, 0, "", false o array vacío) |
| **Longitud de un Array** | `lista.size()` o `arr.length` | `count($array)` |
| **Longitud de un String** | `texto.length()` | `strlen($texto)` |
| **Imprimir estructura completa (Depuración)** | `System.out.println(Arrays.toString(arr))` | `var_dump($variable)` o `print_r($variable)` |

---

## 💡 Resumen de Reglas de Oro para un Programador Java en PHP

1. 💲 **Todo lleva `$`:** No olvides nunca anteponer `$` a cualquier variable (`$x`, `$nombre`).
2. 🔗 **Concatena con punto (`.`):** No uses `+` para unir texto con variables; usa `.` (`"Hola " . $nombre`).
3. 🎯 **Usa `===` para comparar:** Evita sorpresas de tipo usando triple igual `===` en lugar de `==`.
4. 📦 **`array` sirve para todo:** Usa `[]` para listas indexadas y `["clave" => "valor"]` para mapas asociativos.
5. 🏷️ **HTML y PHP trabajan juntos:** PHP genera el código HTML que el navegador dibujará. Todo lo que envíes con `echo` se imprimirá directamente en la página web.
