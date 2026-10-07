# Teoría Completa y Compactada — Desarrollo Web en Entorno Servidor (DWES)

Apuntes explicados **desde cero**, simplificados y estructurados formalmente para el módulo de **Desarrollo Web en Entorno Servidor** (2º DAW). Se abarcan los tres primeros bloques de la asignatura: **UT1** (Arquitecturas Web), **UT2** (Fundamentos de PHP e inserción de código) y **UT3** (Estructuras de control, arrays y formularios).

---

## 📌 MÓDULO 1: Arquitecturas de Desarrollo Web (UT1)

### 1.1 El Modelo Cliente-Servidor y Arquitectura en 3 Capas

#### ¿Qué es el modelo Cliente-Servidor?
Es la arquitectura distribuida básica de la Web. Divide los sistemas en dos roles diferenciados:
* **Cliente:** Dispositivo y programa (normalmente un navegador web) que **inicia la comunicación** enviando una **solicitud** (*request*).
* **Servidor:** Equipo o sistema que escucha peticiones, procesa la lógica de negocio y **devuelve una respuesta** (*response*).

```
 ┌──────────────────────┐        Petición HTTP / HTTPS         ┌──────────────────────┐
 │       CLIENTE        │ ───────────────────────────────────► │       SERVIDOR       │
 │ (Navegador Web/User) │ ◄─────────────────────────────────── │ (Apache, Nginx, PHP) │
 └──────────────────────┘         Respuesta (HTML/CSS/JS)      └──────────────────────┘
```

#### Protocolos de comunicación
La comunicación utiliza el protocolo **HTTP** (*HyperText Transfer Protocol*) o su versión cifrada y segura **HTTPS** (*HTTP Secure*).
* **Puerto HTTP:** 80 (por defecto, tráfico no cifrado).
* **Puerto HTTPS:** 443 (utiliza certificados SSL/TLS para cifrar el tráfico).

#### Arquitectura a Tres Capas (Desacoplamiento)
Para evitar crear programas monolíticos difíciles de mantener, la lógica de una aplicación web se divide en tres niveles independientes:

| Capa | Nombre | Dónde se ejecuta | Tecnologías | Función Principal |
|---|---|---|---|---|
| **1ª Capa** | **Presentación** (Front-end) | Navegador del usuario | HTML, CSS, JavaScript | Muestra la interfaz gráfica y recoge las acciones del usuario. |
| **2ª Capa** | **Negocio** (Back-end) | Servidor Web / Aplicaciones | PHP, Node.js, Python, Java | Procesa las reglas de la app, autenticación, seguridad y cálculos. |
| **3ª Capa** | **Datos** (Persistencia) | Servidor de Base de Datos | MySQL, PostgreSQL, MongoDB | Almacena y gestiona la información de forma permanente. |

> 💡 **Regla de oro de comunicación:** La capa de **Presentación NUNCA habla directamente con la capa de Datos**. Siempre debe pasar a través de la capa de **Negocio** para garantizar la seguridad y validación de las reglas del sistema.

#### Perfiles profesionales
* **Front-end Developer:** Especialista en la capa de presentación (interfaz visual, usabilidad y rendimiento en el navegador).
* **Back-end Developer:** Especialista en la capa de negocio y servidor (APIs, seguridad, procesamiento de datos y bases de datos).
* **Full-stack Developer:** Perfil versátil con conocimientos generales de ambas capas.

---

### 1.2 Páginas Estáticas vs Dinámicas y Mecanismos de Ejecución

#### Páginas Estáticas vs Dinámicas
* **Página Estática (HTML/CSS):** El servidor simplemente lee un archivo almacenado en su disco duro y lo envía **tal cual** al cliente. El contenido no cambia a menos que el programador edite el archivo a mano.
* **Página Dinámica (PHP/Python/Node):** El servidor **ejecuta un programa** en tiempo real al recibir la petición. Genera un documento HTML a medida (por ejemplo, mostrando los datos del usuario logueado) y envía ese HTML resultante al cliente.

#### Mecanismos para ejecutar código en el servidor
Para que un servidor web (como Apache) pueda ejecutar código de programación, existen tres mecanismos principales:
1. **CGI (Common Gateway Interface):** Mecanismo antiguo. Cada vez que llega una petición, el servidor arranca un proceso ejecutable nuevo. *Inconveniente:* Muy lento y consume muchísimos recursos si hay muchas visitas.
2. **Módulo del Servidor Web (e.g. `mod_php` en Apache):** El intérprete del lenguaje está integrado dentro del propio proceso del servidor web. *Ventaja:* Muchísimo más rápido y eficiente.
3. **Servlets y Contenedores Web (e.g. Tomcat para Java):** El servidor web delega la petición a un contenedor especializado que mantiene objetos en memoria para responder de forma asíncrona.

#### Lenguajes de Scripting en Servidor
Son lenguajes cuyos programas no se compilan previamente a un ejecutable binario, sino que son interpretados sobre la marcha por un motor en el servidor:
* **PHP:** El lenguaje más extendido en la Web tradicional (WordPress, Laravel, etc.).
* **JavaScript (Node.js):** Permite usar el mismo lenguaje en cliente y servidor.
* **Python:** Muy popular por su sencillez y potencia (Django, Flask).
* **Java (JSP / Servlets):** Usado habitualmente en entorno corporativo y bancario.
* **C# (ASP.NET):** La alternativa de Microsoft integrada en el ecosistema .NET.

---

### 1.3 Evolución Histórica de la Web

```
 Web 1.0 (60s-90s)        Web 2.0 (2004+)           Web 3.0 (2010+)           Web 4.0 (Actualidad)
┌─────────────────┐      ┌─────────────────┐      ┌─────────────────┐      ┌────────────────────┐
│  Solo Lectura   │ ───► │ Web Social/AJAX │ ───► │  Web Semántica  │ ───► │ Ubicua e Inteligente│
│ Páginas fijas   │      │ Comentarios     │      │ IA, Ontologías, │      │ Asistentes IA, Voz,│
│ HTML estático   │      │ Redes Sociales  │      │ Descentralizado │      │ Automatizaciones  │
└─────────────────┘      └─────────────────┘      └─────────────────┘      └────────────────────┘
```

1. **Web 1.0 (Lectura):** Documentos estáticos de solo lectura. El usuario solo podía consumir información publicada por el *Webmaster*.
2. **Web 2.0 (Lectura y Escritura - Web Social):** Surgimiento de redes sociales, blogs, wikis y AJAX. El usuario pasa a ser el generador de contenido.
3. **Web 3.0 (Web Semántica y Datos):** Procesamiento de la información atendiendo a su significado (semántica), uso de IA inicial, gráficos 3D acelerados (WebGL) y descentralización.
4. **Web 4.0 (Web Ubicua y Predictiva):** Integración total con IA proactiva, comandos de voz, IoT (*Internet of Things*) y asistentes que ejecutan acciones complejas por el usuario (reservas automatizadas, anticipación de necesidades).

---

### 1.4 Entornos de Desarrollo, IDEs y Servidores Web

#### Editor de Código vs IDE
* **Editor de Código (ej. VS Code, Sublime Text):** Programa ligero que permite escribir código. Se amplía mediante extensiones/plugins.
* **IDE - Entorno de Desarrollo Integrado (ej. PhpStorm, NetBeans, Eclipse PDT):** Herramienta pesada que incluye editor, depurador (*debugger*), control de versiones, integración con servidores y refactorización avanzada en una sola aplicación.

#### Servidores Web y el entorno local (Pila XAMPP / LAMP)
Un **Servidor Web** es un software que escucha peticiones HTTP en un puerto y sirve respuestas.
Para desarrollar localmente en PHP se suele instalar una pila como **XAMPP** (disponible para Windows, Linux, Mac):
* **X** → Multiplataforma.
* **A** → **Apache** (Servidor Web).
* **M** → **MariaDB / MySQL** (Servidor de Base de Datos).
* **P** → **PHP** (Intérprete del lenguaje).
* **P** → **Perl**.

La carpeta donde se colocan los proyectos PHP en Apache para ser servidos se llama **`htdocs`** (o `var/www/html` en Linux nativo). Al acceder a `http://localhost/mi_proyecto/`, Apache busca automáticamente el archivo **`index.php`** como punto de entrada.

#### Métodos HTTP fundamentales: GET vs POST
* **Método GET:** Se utiliza para **recuperar** información. Los parámetros del formulario o enlace **viajan visibles en la URL** (`index.php?nombre=Juan&edad=20`).
  * ⚠️ *Límite de datos:* Limitado por la longitud máxima de la URL.
  * ⚠️ *Seguridad:* **NUNCA** usar GET para contraseñas o datos sensibles.
* **Método POST:** Se utiliza para **enviar/crear** información en el servidor. Los datos **viajan en el cuerpo (*body*) de la petición HTTP**, ocultos de la dirección del navegador.
  * Permite enviar grandes volúmenes de datos y archivos.

---

## 📌 MÓDULO 2: El Lenguaje PHP — Inserción de Código y Sintaxis Básica (UT2)

### 2.1 Sintaxis Básica e Integración con HTML

PHP es un lenguaje de **código embebido**. Se escribe intercalado dentro del HTML utilizando las etiquetas delimitadoras `<?php` y `?>`.

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo PHP</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>Hoy es: <?php echo date('d/m/Y'); ?></p>
</body>
</html>
```

#### ¿Cómo procesa esto el servidor?
1. El cliente pide el archivo `.php`.
2. El servidor Apache pasa el archivo al **intérprete de PHP**.
3. PHP ejecuta todo lo que está dentro de `<?php ... ?>` y su salida (`echo`) **reemplaza** al bloque PHP.
4. El cliente recibe únicamente código HTML puro. **El código fuente PHP jamás viaja al navegador**.

#### Sintaxis básica
* Toda sentencia en PHP debe terminar obligatoriamente con **punto y coma (`;`)**.
* Si un archivo contiene **únicamente código PHP** (sin HTML), la buena práctica oficial recomienda **OMITIR la etiqueta de cierre `?>`** para evitar que se cuelen espacios en blanco accidentales al final del archivo.

---

### 2.2 Variables, Tipos de Datos y Constantes

#### Variables (`$`)
* En PHP todas las variables comienzan obligatoriamente con el símbolo del dólar (`$`).
* PHP es de **tipado dinámico y débil**: no se declara el tipo de dato de una variable; el tipo se deduce del valor asignado.
* Sensible a mayúsculas y minúsculas (*case-sensitive*): `$numero` y `$Numero` son variables distintas.

```php
$edad = 25;           // integer
$precio = 19.99;      // float
$nombre = "Carlos";   // string
$esValido = true;     // boolean
```

#### Asignación por Copia vs por Referencia (`&`)
* **Por copia (predeterminado):**
  ```php
  $a = 10;
  $b = $a; // $b toma el valor 10, pero es una variable independiente
  $b = 20; // $a sigue valiendo 10
  ```
* **Por referencia (`&`):** Ambas variables apuntan al mismo espacio de memoria.
  ```php
  $a = 10;
  $b = &$a; // $b es un alias de $a
  $b = 20;  // ¡$a AHORA VALE 20 TAMBIÉN!
  ```

#### Constantes
Las constantes almacenan valores fijos que **no cambian** durante la ejecución. No llevan `$`.
* **Definición clásica:** `define("NOMBRE_CONSTANTE", valor);`
* **Definición moderna (dentro de clases o scripts):** `const NOMBRE_CONSTANTE = valor;`

```php
define("PI", 3.14159);
define("MAX_USUARIOS", 100);

echo PI; // Muestra 3.14159 (sin el símbolo $)
```

#### Tipos de Datos en PHP
1. **Escalares:**
   * `integer`: Números enteros.
   * `float` / `double`: Números decimales.
   * `string`: Cadenas de texto.
   * `boolean`: `true` o `false`.
2. **Compuestos:**
   * `array`: Colecciones de datos (listas o mapas clave-valor).
   * `object`: Instancias de clases (Programación Orientada a Objetos).
   * `callable`: Funciones pasadas como variables.
3. **Especiales:**
   * `null`: Variable vacía o no inicializada.
   * `resource`: Referencias a recursos externos (conexión a BBDD, archivo abierto).

#### Comillas Simples `' '` vs Comillas Dobles `" "` (Interpolación)
En PHP hay una diferencia crítica entre ambos tipos de comillas para cadenas:
* **Comillas simples (`' '`):** Tratan el texto de forma **literal**. No procesan variables ni caracteres especiales.
* **Comillas dobles (`" "`):** **Evalúan e interpolan** las variables que contengan y procesan escapes como `\n` o `\t`.

```php
$nombre = "Ana";

echo 'Hola $nombre'; // Imprime literalmente: Hola $nombre
echo "Hola $nombre"; // Imprime: Hola Ana
```

---

### 2.3 Ámbito de las Variables y Superglobales

#### Ámbito (*Scope*)
* **Ámbito Local:** Las variables creadas **dentro de una función** solo existen dentro de esa función.
* **Ámbito Global:** Las variables creadas fuera de una función pertenecen al ámbito global.
  * ⚠️ *Importante:* A diferencia de otros lenguajes, en PHP **una función NO puede acceder directamente a una variable global** a menos que se indique explícitamente con la palabra reservada `global` o la superglobal `$GLOBALS`.

```php
$mensaje = "Hola mundo"; // Variable global

function probar() {
    global $mensaje; // Importamos la variable global
    echo $mensaje;
}
```

#### Variables Superglobales
Son arrays asociativos predefinidos por PHP que están **disponibles en cualquier lugar del código** (dentro o fuera de funciones):

| Superglobal | Contenido y Uso |
|---|---|
| `$_SERVER` | Información sobre el servidor web, rutas, cabeceras y método de la petición (`REQUEST_METHOD`, `PHP_SELF`, `HTTP_USER_AGENT`). |
| `$_GET` | Array asociativo con las variables enviadas por la URL (método GET). |
| `$_POST` | Array asociativo con las variables enviadas a través de un formulario con método POST. |
| `$_FILES` | Información sobre archivos subidos al servidor mediante formularios. |
| `$_COOKIE` | Datos guardados en las cookies del cliente. |
| `$_SESSION` | Variables de sesión persistentes entre distintas páginas para un mismo usuario. |
| `$_REQUEST` | Mezcla del contenido de `$_GET`, `$_POST` y `$_COOKIE` (se recomienda usar las específicas por seguridad). |
| `$GLOBALS` | Contiene todas las variables globales definidas en el script. |

---

### 2.4 Operadores y Expresiones

#### 1. Aritméticos
`+` (Suma), `-` (Resta), `*` (Multiplicación), `/` (División), `%` (Módulo / Resto), `**` (Exponenciación).

#### 2. Operadores de Asignación Combinada
`$a += 5` (Equivale a `$a = $a + 5`), `-=`, `*=`, `/=`, `.=` (Concatenación y asignación).

#### 3. Operadores de Comparación (CRUCIAL)
* `==` **Igualdad:** Comprueba si los valores son iguales, realizando conversión de tipos si hace falta (`"5" == 5` es `true`).
* `===` **Identidad:** Comprueba si los valores son iguales **Y ADEMÁS del mismo tipo de dato** (`"5" === 5` es `false`).
* `!=` o `<>` **Desigualdad.**
* `!==` **No idéntico:** Distinto valor o distinto tipo.
* `<=>` **Operador Nave Espacial (*Spaceship*):** Devuelve `-1` si `$a < $b`, `0` si `$a == $b`, y `1` si `$a > $b`.
* `??` **Operador de Fusión de Null (*Null Coalescing*):** Retorna el primer operando si existe y no es `null`.
  ```php
  $nombreUsuario = $_POST['nombre'] ?? 'Anónimo';
  ```

#### 4. Operadores Lógicos
* `&&` o `and`: Verdadero si ambos son `true`.
* `||` o `or`: Verdadero si al menos uno es `true`.
* `!` : Negación lógica.
* `xor`: Verdadero si uno es `true`, pero **NO ambos**.

#### 5. Pre-incremento vs Post-incremento
* `++$a` (Pre-incremento): Incrementa el valor de `$a` en 1 y **después** devuelve el valor.
* `$a++` (Post-incremento): Devuelve el valor actual de `$a` y **después** lo incrementa en 1.

```php
$x = 5;
echo ++$x; // Muestra 6

$y = 5;
echo $y++; // Muestra 5 (y en la siguiente línea $y vale 6)
```

---

### 2.5 Resumen de Funciones Nativas Esenciales de PHP

#### Funciones Numéricas
* `round($val, $prec)`: Redondea un float al número de decimales indicado.
* `floor($val)`: Redondea siempre hacia abajo (entero inferior).
* `ceil($val)`: Redondea siempre hacia arriba (entero superior).
* `rand($min, $max)`: Genera un número entero aleatorio entre `$min` y `$max`.

#### Funciones de Cadenas (*Strings*)
> ⚠️ **Atención a las tildes y caracteres UTF-8:** Las funciones estándar como `strlen()` o `strtoupper()` cuentan bytes. Si la cadena contiene tildes, eñes o caracteres especiales, debes usar las funciones multicontenido con prefijo `mb_` (`mb_strlen`, `mb_strtoupper`, etc.).

* `strlen($str)` / `mb_strlen($str)`: Longitud de la cadena.
* `strtolower($str)` / `mb_strtolower($str)`: Convierte a minúsculas.
* `strtoupper($str)` / `mb_strtoupper($str)`: Convierte a mayúsculas.
* `ucfirst($str)`: Pone en mayúscula la primera letra de la cadena.
* `ucwords($str)`: Pone en mayúscula la primera letra de cada palabra.
* `trim($str)`: Elimina espacios en blanco u otros caracteres al principio y al final.
* `substr($str, $inicio, $longitud)`: Extrae una subcadena.
* `str_replace($buscar, $reemplazar, $cadena)`: Reemplaza apariciones de un texto por otro.
* `strpos($cadena, $buscar)`: Busca la posición de la primera aparición de una subcadena (devuelve `false` si no la encuentra).
* `str_contains($cadena, $buscar)`: Devuelve `true` si la cadena contiene la subcadena (disponible desde PHP 8).

#### Funciones de Inspección y Comprobación de Tipos
* `var_dump($var)`: Imprime el tipo de dato y valor estructurado de una variable (imprescindible para depurar).
* `print_r($var)`: Imprime información legible de arrays u objetos.
* `is_int($v)`, `is_float($v)`, `is_string($v)`, `is_bool($v)`, `is_array($v)`, `is_numeric($v)`: Comprueban el tipo y devuelven un booleano.
* `intval($v)`, `floatval($v)`, `strval($v)`: Convierten explícitamente el tipo de dato.

#### Funciones de Fecha y Hora
* `date($formato, $timestamp)`: Devuelve la fecha formateada (`'d/m/Y H:i:s'`). Si se omite el timestamp, toma la fecha/hora actual.
* `time()`: Devuelve la marca de tiempo Unix actual (*timestamp*: segundos transcurridos desde el 1 de enero de 1970).
* `mktime($h, $i, $s, $m, $d, $Y)`: Genera un timestamp Unix para una fecha específica.
* `strtotime($cadenaFecha)`: Convierte una descripción textual de fecha en inglés (ej. `"next Monday"`, `"2026-10-07"`) a timestamp Unix.
* `checkdate($mes, $dia, $anio)`: Valida si una fecha es legítima (comprueba años bisiestos, días del mes, etc.).

---

## 📌 MÓDULO 3: Estructuras de Control, Arrays y Formularios (UT3)

### 3.1 Estructuras de Control de Flujo

#### Condicionales

##### `if`, `else`, `elseif`
```php
$nota = 7.5;

if ($nota >= 9) {
    echo "Sobresaliente";
} elseif ($nota >= 5) {
    echo "Aprobado";
} else {
    echo "Suspenso";
}
```

##### `switch` / `case`
Ideal para evaluar una misma variable frente a múltiples valores concretos:
```php
$dia = 3;

switch ($dia) {
    case 1:
        echo "Lunes";
        break; // ¡Imprescindible para no ejecutar los siguientes casos!
    case 2:
        echo "Martes";
        break;
    case 3:
        echo "Miércoles";
        break;
    default:
        echo "Día inválido";
}
```

#### Bucles de Repetición

```php
// 1. Bucle FOR: Cuándo conocemos el número exacto de iteraciones
for ($i = 1; $i <= 5; $i++) {
    echo "Número: $i <br>";
}

// 2. Bucle WHILE: Se repite MIENTRAS la condición sea true (evalúa AL INICIO)
$j = 1;
while ($j <= 5) {
    echo "Número: $j <br>";
    $j++;
}

// 3. Bucle DO-WHILE: Se ejecuta AL MENOS UNA VEZ (evalúa AL FINAL)
$k = 1;
do {
    echo "Número: $k <br>";
    $k++;
} while ($k <= 5);
```

##### Control de bucles: `break` y `continue`
* `break`: Interrumpe y sale inmediatamente del bucle.
* `continue`: Salta el resto de la iteración actual y pasa a la evaluación de la siguiente iteración.

---

### 3.2 Modularidad de Código: Requerimiento de Ficheros

Para organizar aplicaciones grandes, dividimos el código en librerías o componentes y los incluimos mediante cuatro sentencias:

```
                      ┌─────────────────────────────────────────┐
                      │    ¿Cómo tratar el error si no existe   │
                      │               el archivo?               │
                      └────────────────────┬────────────────────┘
                                           │
                    ┌──────────────────────┴──────────────────────┐
                    ▼                                             ▼
          Error Leve (Warning)                          Error Fatal (Fatal Error)
        El script CONTINÚA                              El script SE DETIENE
        ┌──────────────────┐                            ┌──────────────────┐
        │     include      │                            │     require      │
        └────────┬─────────┘                            └────────┬─────────┘
                 │                                               │
                 ├───────────► ¿Evitar duplicados? ◄─────────────┤
                 │                                               │
                 ▼                                               ▼
        ┌──────────────────┐                            ┌──────────────────┐
        │   include_once   │                            │   require_once   │
        └──────────────────┘                            └──────────────────┘
```

#### Diferencias clave:
1. **`include "archivo.php"`:** Si el archivo no existe, lanza un **aviso de advertencia (`E_WARNING`)** pero **el script continúa ejecutándose**.
2. **`require "archivo.php"`:** Si el archivo no existe, lanza un **error fatal (`E_COMPILE_ERROR`)** y **la ejecución se detiene de inmediato**. Usar para archivos críticos (ej. configuración, base de datos).
3. **`include_once` / `require_once`:** Funcionan exactamente igual que sus parejas, pero **comprueban si el archivo ya ha sido incluido previamente**. Si es así, lo ignoran para **evitar colisiones y errores de redefinición de funciones o clases**.

---

### 3.3 Arrays en PHP

Los arrays en PHP son estructuras enormemente flexibles que combinan vectores ordenados y tablas hash (mapas clave-valor).

#### Tipos de Arrays

##### 1. Arrays Indexados (Numéricos)
Las claves son números enteros automáticos comenzando desde el `0`:
```php
$frutas = ["Manzana", "Plátano", "Naranja"]; // Sintaxis corta [] (recomendada)
echo $frutas[0]; // Muestra "Manzana"
```

##### 2. Arrays Asociativos
Las claves son cadenas de texto explícitas asociadas a un valor:
```php
$usuario = [
    "nombre" => "Juan",
    "email" => "juan@email.com",
    "edad" => 30
];

echo $usuario["email"]; // Muestra "juan@email.com"
```

##### 3. Arrays Multidimensionales
Arrays dentro de otros arrays:
```php
$alumnos = [
    ["nombre" => "Ana", "nota" => 8],
    ["nombre" => "Pedro", "nota" => 6]
];

echo $alumnos[0]["nombre"]; // Muestra "Ana"
```

#### Recorrido de Arrays con `foreach`
Es la estructura idónea para iterar arrays en PHP:

```php
$colores = ["rojo" => "#FF0000", "verde" => "#00FF00", "azul" => "#0000FF"];

// Recorrer obteniendo Clave y Valor
foreach ($colores as $nombreColor => $codigoHex) {
    echo "El color $nombreColor tiene el código $codigoHex <br>";
}

// Recorrer obteniendo Solo el Valor
foreach ($colores as $codigoHex) {
    echo "Código: $codigoHex <br>";
}
```

> ⚠️ **Modificar elementos en un `foreach` (Paso por referencia):**
> Si intentas modificar `$valor` dentro de un `foreach` normal, el array original NO cambia. Debes anteponer el operador `&` (`foreach ($array as &$valor)`). ¡RECUERDA ejecutar `unset($valor)` al terminar el bucle para liberar la referencia!

#### Operadores con Arrays
* **Operador `+` (Unión):** Une dos arrays. Mantiene las claves del array de la izquierda. Si una clave existe en ambos, **se conserva la del array izquierdo y se ignora la del derecho**.
* **Operador `==` (Igualdad):** `true` si ambos arrays tienen las mismas parejas clave/valor (sin importar el orden).
* **Operador `===` (Identidad):** `true` si tienen las mismas parejas clave/valor, en el **mismo orden y con los mismos tipos de datos**.

---

### 3.4 Funciones Definidas por el Usuario

Sintaxis general:
```php
function calcularTotal(float $precio, int $cantidad = 1): float {
    return $precio * $cantidad;
}
```

#### Aspectos fundamentales:
1. **Valores por defecto en parámetros:** Se asignan en la cabecera (`$cantidad = 1`). Si al llamar a la función se omite el argumento, tomará el valor por defecto. Los parámetros opcionales deben colocarse siempre al final.
2. **Paso de parámetros por copia vs referencia:**
   * **Por copia (predeterminado):** Cambiar la variable dentro de la función no afecta al exterior.
   * **Por referencia (`&$parametro`):** Los cambios realizados dentro de la función alteran directamente la variable original.
   ```php
   function duplicar(&$num) {
       $num = $num * 2;
   }
   $x = 5;
   duplicar($x);
   echo $x; // Imprime 10
   ```
3. **Funciones comprobadoras de estado:**
   * `isset($var)`: Devuelve `true` si la variable ha sido inicializada y su valor **no es null**.
   * `empty($var)`: Devuelve `true` si la variable no existe, es `false`, `0`, `""` (cadena vacía), `null` o un array vacío.
   * `unset($var)`: Destruye la variable y la elimina de la memoria.
   * `is_null($var)`: Devuelve `true` solo si la variable vale `null`.

---

### 3.5 Control de Errores y Excepciones

#### Sistema Clásico de Errores
PHP categoriza las incidencias por niveles:
* `E_NOTICE` / `E_WARNING`: Advertencias menores (ej. usar una variable no inicializada o un `include` fallido). El script continúa.
* `E_ERROR` / `E_PARSE`: Errores fatales o de sintaxis. El script se interrumpe.

Directivas principales en `php.ini` para configuración de errores:
* `error_reporting`: Define qué nivel de errores deben notificarse (en desarrollo se usa `E_ALL`).
* `display_errors`: `On` en desarrollo (muestra errores por pantalla); `Off` en producción (para no revelar información del sistema a atacantes).
* `log_errors`: `On` para guardar los errores en un archivo de registros (*log*).

#### Manejo de Excepciones (`try / catch / finally`)

```php
try {
    $denominador = 0;
    if ($denominador === 0) {
        throw new Exception("División por cero no permitida.");
    }
    $resultado = 10 / $denominador;
} catch (Exception $e) {
    echo "Ha ocurrido un error: " . $e->getMessage();
} finally {
    echo "<br>Este bloque se ejecuta SIEMPRE (haya o no excepción).";
}
```

#### Jerarquía en PHP 7/8: La interfaz `Throwable`
Desde PHP 7, muchos errores fatales de motor (como llamar a una función que no existe) se lanzan como objetos de tipo `Error`. Tanto `Exception` como `Error` implementan la interfaz común **`Throwable`**.

```php
try {
    // Código potencialmente peligroso
} catch (Throwable $t) {
    // Captura TANTO excepciones de usuario COMO errores del motor de PHP
    echo "Capturado: " . $t->getMessage();
}
```

---

### 3.6 Formularios Web e Interacción con el Cliente

Los formularios HTML son el puente primario entre la entrada del usuario (cliente) y el script en el servidor.

#### Estructura HTML de un formulario
```html
<form action="procesar.php" method="POST">
    <label for="usr">Usuario:</label>
    <input type="text" id="usr" name="usuario_input" required>
    
    <label for="pwd">Contraseña:</label>
    <input type="password" id="pwd" name="clave_input" required>
    
    <button type="submit">Iniciar Sesión</button>
</form>
```
* **Atributo `action`:** Ruta del archivo PHP que recibirá y procesará los datos.
* **Atributo `method`:** `GET` o `POST`.
* **Atributo `name` (CRUCIAL):** El valor de este atributo será la **clave asociativa** con la que accederemos al dato en PHP (`$_POST['usuario_input']`).

#### Recuperación Básica y Segura de Datos

##### Método tradicional (Vulnerable a warnings si el campo falta):
```php
$usuario = $_POST['usuario_input'];
```

##### Método seguro con `filter_input()` (Recomendado):
Evita mensajes de advertencia si la clave no existe en la petición y permite sanear o validar entradas.

```php
// En procesar.php
$usuario = filter_input(INPUT_POST, 'usuario_input', FILTER_DEFAULT);
$clave = filter_input(INPUT_POST, 'clave_input', FILTER_DEFAULT);

if ($usuario === "admin" && $clave === "12345") {
    // Credenciales correctas
}
```

#### Formulario y Procesamiento en el Mismo Fichero (*Self-Processing*)
Es muy común tener la vista del formulario y la lógica de validación dentro del mismo archivo `index.php`. Se diferencia la primera visita del envío del formulario mediante `$_SERVER['REQUEST_METHOD']`:

```php
<?php
$error = "";

// Comprobamos si el formulario ha sido enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT);
    $clave = filter_input(INPUT_POST, 'clave', FILTER_DEFAULT);
    
    if ($usuario === "admin" && $clave === "12345") {
        // Redirección HTTP segura a la zona privada
        header("Location: bienvenido.php");
        exit(); // ¡Siempre poner exit() tras un header Location!
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <?php if ($error !== ""): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <!-- Usamos htmlspecialchars para prevenir ataques XSS al llamar a PHP_SELF -->
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="clave" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
```

#### 🚨 La Regla de Oro de la Función `header()`
La función `header("Location: destino.php")` envía una cabecera HTTP de redirección al navegador.
* **REGLA ABSOLUTA:** `header()` debe llamarse **ANTES de que se envíe cualquier salida HTML o texto** al cliente (incluyendo espacios en blanco fuera de `<?php ?>` o llamadas a `echo`).
* Si intentas llamar a `header()` después de haber mostrado contenido en pantalla, PHP fallará estrepitosamente con el conocido error: *"Cannot modify header information - headers already sent"*.
