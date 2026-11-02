# Guía Definitiva de Estudio: Tema 2 JavaScript (DWEC)

Este documento compacta los **6 PDFs oficiales del Tema 2 (2.1 a 2.7)** y el análisis del examen anterior. Está diseñado específicamente para que **pienses como el motor de JavaScript**, caces al vuelo las preguntas "trampa" del tipo test y tengas claras las reglas para escribir código.

---

## Bloque 1: Sintaxis, Identificadores y Reglas del Motor (PDF 2.1 y 2.7)

Aunque parezca teoría, de aquí salen preguntas trampa muy rápidas de responder si conoces cómo lee el código el navegador.

### 1. El Peligro del Punto y Coma Automático (*ASI - Automatic Semicolon Insertion*)

JavaScript intenta poner puntos y coma automáticamente si haces un salto de línea, pero tiene una **trampa mortal con la sentencia `return`**:

* Si pones `return` y bajas a la línea siguiente para abrir la llave `{` de un objeto, el motor mete un `;` invisible justo después del `return` y **devuelve `undefined`**.

```javascript
// ❌ MAL: El motor inserta un ';' automático justo después de return
function crearConfiguracion() {
    return // <-- El motor interpreta: return; (sale de la función devolviendo undefined)
    {
        modo: "oscuro"
    };
}
console.log(crearConfiguracion()); // Imprime: undefined

// ✅ BIEN: Abriendo la llave en la misma línea del return
function crearConfiguracionCorrecta() {
    return {
        modo: "oscuro"
    };
}
console.log(crearConfiguracionCorrecta()); // Imprime: { modo: "oscuro" }
```

### 2. Reglas de Identificadores y *Case-Sensitive*

* **Case-Sensitive (Sensible a mayúsculas):** `totalVentas` y `TotalVentas` son **dos variables distintas**. Además, escribir palabras reservadas o funciones nativas con mayúscula inicial (`Function`, `Const`, `If`, `Alert()`, `Console.log()`) lanza un **Error** (`SyntaxError` o `ReferenceError`).
* **Nombres de variables válidos:** Solo pueden empezar por **letra**, signo dólar (`$`) o guion bajo (`_`).
  * ✅ Válidos: `_totalFactura`, `$elementoDOM`, `montoTotal2`.
  * ❌ Inválidos (`SyntaxError`): `1erUsuario` (empieza por número), `precio-final` (lleva guion medio, JS cree que es una resta), `nombre usuario` (lleva espacio), `class` o `function` (palabras reservadas).
* **Convenciones de código limpio (*Clean Code*):**
  * `camelCase`: Variables y funciones (`nombreCliente`, `calcularDescuento()`).
  * `PascalCase`: Clases y constructores (`UsuarioRegistrado`).
  * `UPPER_SNAKE_CASE`: Constantes globales fijas (`MAX_REINTENTOS`).
  * Prefijo `$` (`$botonEnviar`): Elementos del DOM. Prefijo `_` (`_token`): Propiedades privadas.

```javascript
// 1. Diferenciación entre mayúsculas y minúsculas (Case-Sensitive)
let totalVentas = 500;
let TotalVentas = 1200; // Es OTRA variable completamente distinta
console.log(totalVentas); // Imprime: 500
console.log(TotalVentas); // Imprime: 1200

// 2. Identificadores VÁLIDOS vs INVÁLIDOS
let _privada = 10;      // ✅ Válido
let $boton = "Enviar";  // ✅ Válido
// let 1erPuesto = "Ana"; // ❌ SyntaxError (no puede empezar por número)
// let precio-total = 50; // ❌ SyntaxError (el guion '-' se lee como una resta)
// If (true) {}           // ❌ SyntaxError / ReferenceError ('If' con mayúscula no existe)
```

### 3. Comentarios y sus Trampas (PDF 2.7)

* **Prohibido anidar comentarios multilínea (`/* ... */`):** Si abres un `/*` y dentro ya había otro `/* ... */`, el comentario se cerrará en el **primer `*/`** que encuentre, dejando el resto del texto al descubierto y provocando un **`SyntaxError`**.
* **Tipos especiales de comentarios:**
  * `/*! ... */` (Con exclamación): Comentario de licencia legal. Los empaquetadores/minificadores (Vite, Esbuild) **no lo borran** al comprimir el código para producción.
  * `#!/usr/bin/env node` (*Hashbang*): Solo es válido si está exactamente en la **línea 1, columna 1** del archivo.
  * `/** ... */` (**JSDoc**): Documenta tipos en JS puro (`@param {number} x`, `@returns {boolean}`, `@throws`, `@typedef`). Si pones `// @ts-check` en la primera línea del archivo `.js`, el editor revisa los tipos como si fuera TypeScript, **pero recuerda: si te equivocas de tipo, el navegador ejecuta el archivo `.js` igualmente sin bloquearlo**.

```javascript
// ❌ TRAMPA DE EXAMEN: Comentario multilínea anidado
/*
   Quiero desactivar este bloque temporalmente:
   let base = 100;
   /* Calculamos el IVA */ // <-- ¡EL COMENTARIO SE CIERRA AQUÍ!
   let total = base * 1.21;
*/ // <-- ¡SyntaxError: Unexpected token '*'! Esta línea quedó fuera del comentario.

// ✅ JSDoc con @ts-check (El editor avisa en rojo, pero el navegador NO da error al ejecutar)
// @ts-check
/**
 * @param {number} a
 * @param {number} b
 * @returns {number}
 */
function sumar(a, b) {
    return a + b;
}
console.log(sumar(5, "10")); // Imprime: "510" (JS lo ejecuta igual concatenando el texto)
```

### 4. Conceptos Flash de Arquitectura (Por si cae 1 pregunta teórica)

* **ECMAScript (ECMA-262):** Es la norma/estándar en papel. **JavaScript** es el lenguaje real que la implementa. **ES6 (ES2015)** fue el gran salto moderno (`let`, `const`, `class`, `=>`).
* **Dialectos que requieren transpilación (Babel / tsc):** **TypeScript** (añade tipado fuerte/estático, detecta errores en desarrollo) y **JSX** (HTML dentro de JS para React). El navegador **solo entiende JS nativo** (*Zero Plugins*: motores V8 en Chrome/Edge, SpiderMonkey en Firefox, JavaScriptCore en Safari).

---

## Bloque 2: Variables, Memoria y Ámbitos / Scope (PDF 2.2 y 2.3)

### 1. Memoria: Primitivos (*Stack*) vs. Referencias (*Heap*)

En ES6+ existen **7 tipos primitivos** (`number`, `bigint`, `string`, `boolean`, `undefined`, `null`, `symbol`) y **1 tipo de referencia** (`Object`: objetos, arrays y funciones).

* **Primitivos (Paso por Valor e Inmutables - Memoria *Stack*):**
  * Si copias una variable primitiva (`let b = a;`), se hace una fotocopia independiente.
  * Los Strings son **inmutables**: si haces `let texto = "HOLA"; texto[0] = "S";`, en modo normal JS lo ignora en silencio y sigue valiendo `"HOLA"`. **¡OJO!** Si el código tiene `"use strict";` arriba, intentar modificar una letra de un string lanza un **`TypeError`**.
* **Objetos y Arrays (Paso por Referencia y Mutables - Memoria *Heap*):**
  * Si asignas un array u objeto a otra variable (`const copia = lista;`), **NO creas una copia**, ambas variables apuntan a la misma dirección de memoria. Si haces `copia.push("JS")`, el array original `lista` también cambia.

```javascript
// 1. PRIMITIVOS: Paso por valor (Fotocopia independiente) e Inmutabilidad
let a = 100;
let b = a; // 'b' recibe una copia del valor 100
b = 200;
console.log(a); // Imprime: 100 ('a' no se entera de lo que le pase a 'b')

// Inmutabilidad de los Strings (Pregunta 26 del examen)
let texto = "HOLA";
texto[0] = "S";     // JS lo ignora en silencio (en "use strict" lanzaría TypeError)
console.log(texto); // Imprime: "HOLA" (sigue intacto)

// 2. OBJETOS Y ARRAYS: Paso por referencia (Misma caja en memoria) y Mutabilidad
const original = ["HTML", "CSS"];
const referencia = original; // ¡NO es una copia! Apuntan al mismo array en memoria
referencia.push("JS");       // Modificamos a través de la segunda variable
console.log(original);       // Imprime: ["HTML", "CSS", "JS"] (¡El original ha cambiado!)
```

### 2. `var` vs. `let` vs. `const` (Ámbito, Redeclaración y `window`)

| Característica | `var` (Clásico - Evitar) | `let` (Moderno) | `const` (Constantes) |
| :--- | :--- | :--- | :--- |
| **Ámbito (Scope)** | **Función** (se escapa de bloques `if`, `for`, `{}`). | **Bloque `{ ... }`** (muere al cerrarse la llave). | **Bloque `{ ... }`** (muere al cerrarse la llave). |
| **Redeclarar en mismo ámbito** | Permitido. Nota: `var x = "Juan"; var x;` conserva `"Juan"`, no lo borra. | ❌ **`SyntaxError`** inmediato. | ❌ **`SyntaxError`** inmediato. |
| **Reasignar valor (`=`)** | Permitido. | Permitido. | ❌ **`TypeError`** (Nota: en objetos/arrays sí puedes mutar sus propiedades/elementos internos). |
| **Sin inicializar** | Vale `undefined` (`var x;`). | Vale `undefined` (`let x;`). | ❌ **`SyntaxError`** (obligatorio darle valor al crearla). |
| **En ámbito Global** | Contamina el objeto `window` (`window.miVar`). | Global, pero **NO** se añade a `window`. | Global, pero **NO** se añade a `window`. |

```javascript
// 1. Fuga de 'var' fuera de un bloque vs aislamiento de 'let' (Pregunta 1 del examen)
if (true) {
    var protocolo = "HTTPS"; // 'var' ignora las llaves del if y se escapa fuera
    let puerto = 443;        // 'let' queda encerrado dentro de estas llaves
}
console.log(protocolo); // Imprime: "HTTPS"
// console.log(puerto); // ❌ ReferenceError: puerto is not defined

// 2. Redeclaración con 'var' vs 'let' (Preguntas 4 y 12 del examen)
var usuario = "Ana";
var usuario;          // Con 'var' es legal y NO borra el valor "Ana"
console.log(usuario); // Imprime: "Ana"

let tasaIVA = 0.21;
// let tasaIVA = 0.10; // ❌ SyntaxError: Identifier 'tasaIVA' has already been declared

// 3. 'const' en contadores vs 'const' en Objetos/Arrays (Preguntas 21 y 25 del examen)
// for (const i = 0; i < 3; i++) {} // ❌ TypeError al intentar hacer i++ en la 1ª vuelta

const config = { tema: "claro" };
config.tema = "oscuro"; // ✅ VÁLIDO: mutamos el interior del objeto, no usamos '=' en 'config'
// config = { tema: "azul" }; // ❌ TypeError: Assignment to constant variable
```

### 3. Sombreado (*Variable Shadowing*) y Cadena de Ámbitos (*Scope Chain*)

Puedes tener una variable `let nivel = "Produccion"` fuera y declarar otra `let nivel = "Desarrollo"` dentro de una función o bloque `{ }`. No da error: dentro del bloque manda la más cercana (hace sombra a la externa), pero la variable de fuera queda intacta.

```javascript
// Ejemplo exacto de Sombreado (Pregunta 9 del examen)
let nivel = "Produccion"; // 1. Ámbito Global

function auditoria() {
    let nivel = "Preproduccion"; // 2. Ámbito de Función (hace sombra a la global)
    if (true) {
        let nivel = "Desarrollo"; // 3. Ámbito de Bloque (hace sombra a la de función)
        // Aquí dentro imprimiría "Desarrollo", pero muere en la línea siguiente
    }
    console.log(nivel); // Imprime: "Preproduccion" (la del bloque if ya murió)
}

auditoria();
console.log(nivel); // Imprime: "Produccion" (la global nunca fue modificada)
```

### 4. Elevación (*Hoisting*) y Zona Muerta Temporal (*TDZ*)

* **Con `var`:** Si haces `console.log(precio)` antes de la línea `var precio = 50;`, no da error: imprime **`undefined`** (la declaración se "eleva", pero su valor no).
* **Con `let` y `const` (TDZ):** El tramo desde que empieza el bloque `{` hasta la línea donde se declara la variable es la **Zona Muerta Temporal**. Si intentas usar una variable antes de su línea `let` (incluso si existía una global con el mismo nombre fuera), lanza un **`ReferenceError`**.

```javascript
// 1. Hoisting clásico con 'var'
console.log(precio); // Imprime: undefined (NO da error, pero aún no tiene el 50)
var precio = 50;

// 2. Zona Muerta Temporal (TDZ) con 'let' (Pregunta 13 del examen)
let servidor = "Apache";
function actualizar() {
    // Desde que se abre la llave '{' empieza la TDZ para el 'servidor' local
    console.log(servidor); // ❌ ReferenceError: Cannot access 'servidor' before initialization
    let servidor = "Nginx"; // Aquí termina la TDZ
}
actualizar();
```

### 5. Fugas de Ámbito (*Scope Leaks*), `"use strict"` e IIFE

* **Variable sin declarar:** Si dentro de una función escribes `resultado = 100;` olvidando poner `let`, `const` o `var` delante:
  * **En modo normal:** No da error; JS crea automáticamente una variable global en `window.resultado` (fuga de memoria).
  * **Con `"use strict";` activado:** Lanza un **`ReferenceError`** inmediato.
* **Patrón IIFE (`(function() { ... })();`):** Función encerrada entre paréntesis que se autoejecuta al instante para aislar variables y no contaminar el ámbito global.
* **Bucles `for` con `setTimeout`:** `for (let i = 0; i < 3; i++)` crea una variable `i` nueva por cada vuelta (el `setTimeout` imprime `0, 1, 2`). Con `for (var i = 0; ...)` comparten la misma variable que se queda en el valor final (imprime `3, 3, 3`).

```javascript
// 1. Fuga de ámbito por olvidar let/var vs "use strict"
function calcular() {
    fugaGlobal = 999; // Sin let/var: en modo normal se crea window.fugaGlobal = 999
                      // Si hubiera "use strict"; arriba, daría ReferenceError aquí mismo
}
calcular();
console.log(fugaGlobal); // Imprime: 999

// 2. Bucle asíncrono con setTimeout: 'var' vs 'let' (Pregunta 5 del examen)
for (var i = 0; i < 3; i++) {
    setTimeout(function() {
        console.log(i); // Imprime: 3, 3, 3 (comparten la misma 'i', que terminó valiendo 3)
    }, 50);
}

for (let n = 0; n < 3; n++) {
    setTimeout(function() {
        console.log(n); // Imprime: 0, 1, 2 ('let' crea una 'n' independiente en cada vuelta)
    }, 50);
}
```

---

## Bloque 3: Tipos de Datos, Coerción y Conversiones (PDF 2.2 y 2.4)

### 1. Peculiaridades de `number`, `bigint` y `symbol`

* **Precisión decimal (IEEE 754):** En JS, **`0.1 + 0.2 === 0.3` da `false`** (porque `0.1 + 0.2` es `0.30000000000000004`).
* **División entre cero:** `10 / 0` **no da error**, devuelve **`Infinity`** (o `-Infinity`).
* **Prefijos de bases numéricas:** Binario `0b101` (`5`), Octal `0o12` (`10`), Hexadecimal `0xFF` (`255`), Notación científica `2e3` (`2000`).
* **Reglas estrictas de `BigInt` (terminan en `n`, ej. `100n`):**
  * ❌ **Prohibido mezclar con `Number` en matemáticas:** `10n + 1` lanza **`TypeError`**.
  * ❌ **Prohibido el unario `+`:** `+10n` lanza **`TypeError`**.
  * ✅ **Permitido concatenar con String:** `500n + " bytes"` da `"500 bytes"` (desaparece la `n`).
  * ✅ **Booleano:** `0n` es *Falsy*, cualquier otro (`1n`, `-5n`) es *Truthy*.
* **Reglas estrictas de `Symbol`:**
  * Cada símbolo es irrepetible: **`Symbol("id") === Symbol("id")` da `false`**.
  * ❌ **Prohibido concatenar con `+` o convertir a número:** `"Hola " + Symbol("a")` o `+Symbol("a")` o `Number(Symbol("a"))` lanzan **`TypeError`**.
  * ✅ **Permitido convertir explícitamente a texto o booleano:** `String(Symbol("a"))` o `.toString()` funcionan; en booleano un `Symbol` es **siempre *Truthy*** (`true`).

```javascript
// 1. Trampas numéricas clásicas
console.log(0.1 + 0.2 === 0.3); // false (da 0.30000000000000004)
console.log(10 / 0);            // Infinity (no lanza error)

// 2. Trampas con BigInt (Pregunta 8 del examen)
let maximo = 9007199254740991n;
// console.log(maximo + 1);     // ❌ TypeError: Cannot mix BigInt and other types
console.log(maximo + 1n);       // ✅ 9007199254740992n (ambos son BigInt)
console.log(500n + "MB");       // ✅ "500MB" (concatenar con texto sí es legal y quita la 'n')

// 3. Trampas con Symbol
let s1 = Symbol("clave");
let s2 = Symbol("clave");
console.log(s1 === s2);         // false (siempre son únicos)
// console.log("ID: " + s1);    // ❌ TypeError: Cannot convert a Symbol value to a string
console.log(String(s1));        // ✅ "Symbol(clave)" (conversión explícita sí permitida)
```

### 2. El Operador `typeof` y sus Trampas Clásicas

Devuelve siempre un **string** en minúsculas con el nombre del tipo:

* `typeof 42` $\rightarrow$ `"number"` | `typeof 100n` $\rightarrow$ `"bigint"` | `typeof "Hola"` $\rightarrow$ `"string"`
* ⚠️ **Trampas de examen con `typeof`:**
  * `typeof NaN` $\rightarrow$ **`"number"`** (¡Aunque signifique *Not-a-Number*, su tipo es numérico!).
  * `typeof null` $\rightarrow$ **`"object"`** (Bug histórico de JS de 1995).
  * `typeof [1, 2, 3]` $\rightarrow$ **`"object"`** (En JS los arrays son objetos).
  * `typeof function(){}` $\rightarrow$ **`"function"`**.

```javascript
console.log(typeof NaN);          // "number"  <-- ¡Cuidado!
console.log(typeof null);         // "object"  <-- ¡Bug histórico muy preguntado!
console.log(typeof [10, 20]);     // "object"  <-- Los arrays no devuelven "array"
console.log(typeof undefined);    // "undefined"
console.log(typeof function(){}); // "function"
```

### 3. Coerción Implícita (`+` vs `-`, `*`, `/`, `%`) y Explícita

* **Operador `+`:** Si uno de los dos lados es un String, convierte el otro a String y **concatena** (`12 + "5"` $\rightarrow$ `"125"`). Si no hay Strings, suma matemáticamente (`true + 7` $\rightarrow$ `8`, porque `true` pasa a `1`).
* **Operadores matemáticos (`-`, `*`, `/`, `%`, `**`):** Solo hacen matemáticas; obligan a convertir los textos y otros tipos a número:
  * `"50" - 10 + "5"` $\rightarrow$ Primero `"50" - 10` da `40` (number), y luego `40 + "5"` concatena y da **`"405"` (string)**.
  * **`null` vs `undefined` en matemáticas (¡Muy preguntado!):**
    * `null` se convierte en **`0`**: `null * 6` da **`0`**; `10 + null` da **`10`**.
    * `undefined` se convierte en **`NaN`**: `undefined / 7` da **`NaN`**; `10 + undefined` da **`NaN`**.
* **Conversión manual a Número (`Number` vs `parseInt` vs `+`):**
  * `Number("32px")` $\rightarrow$ **`NaN`** (es estricto, falla al ver letras).
  * `parseInt("32px", 10)` $\rightarrow$ **`32`** (lee números de izquierda a derecha hasta encontrar una letra; pero si empieza por letra como `parseInt("ancho: 100")` da **`NaN`**).
  * Unario `+`: `+"25"` $\rightarrow$ **`25`** (hace exactamente lo mismo que `Number("25")`).
* **Trampa con `.toString()`:** `String(null)` da `"null"`, pero hacer `null.toString()` o `undefined.toString()` lanza un **`TypeError`** que rompe el programa.
* **Comprobar `NaN`:** Nunca uses `x === NaN` (siempre da `false`). Usa **`Number.isNaN(x)`**.

```javascript
// 1. Mezcla de resta '-' y suma '+' (Pregunta 7 del examen)
let operacion = "50" - 10 + "5"; 
// Paso 1: "50" - 10 -> La resta convierte "50" a número: 50 - 10 = 40 (number)
// Paso 2: 40 + "5"  -> El '+' ve un string a la derecha y concatena: "405" (string)
console.log(operacion + "_" + typeof operacion); // Imprime: "405_string"

// 2. Diferencia entre null y undefined en cuentas matemáticas
console.log(10 + null);      // 10  (null se convierte en 0)
console.log(10 + undefined); // NaN (undefined se convierte en NaN)
console.log(true * 7);       // 7   (true vale 1, false vale 0)

// 3. Number() vs parseInt() (Pregunta 18 del examen)
let entrada = "32px";
console.log(Number(entrada));       // NaN (ve las letras 'px' y rechaza todo el texto)
console.log(parseInt(entrada, 10)); // 32  (rescata el 32 inicial e ignora 'px')
console.log(parseInt("px32", 10));  // NaN (como empieza por letra, no puede rescatar nada)
```

### 4. Tabla Maestra de Conversiones y los 8 Valores *Falsy*

Memoriza los **únicos 8 valores *Falsy*** de JavaScript:

> **`false`**, **`0`**, **`-0`**, **`0n`**, **`""`** (cadena vacía), **`null`**, **`undefined`** y **`NaN`**.
> *(¡Todo lo demás es **Truthy**, incluidos `"0"`, `"false"`, `" "` con espacio, `[]` array vacío y `{}` objeto vacío!).*

| Valor Original (`x`) | `Number(x)` (o `+x`) | `String(x)` | `Boolean(x)` (o `!!x`) |
| :--- | :--- | :--- | :--- |
| `false` / `true` | `0` / `1` | `"false"` / `"true"` | `false` / `true` |
| `""` (vacío) o `"   "` (espacios) | **`0`** | `""` / `"   "` | `false` (vacío) / **`true`** (con espacio) |
| `"0"` (texto con cero) | **`0`** | `"0"` | **`true`** (¡Trampa clásica!) |
| `"false"` | `NaN` | `"false"` | **`true`** (es texto lleno) |
| `null` | **`0`** | `"null"` | `false` |
| `undefined` | **`NaN`** | `"undefined"` | `false` |
| `[]` (Array vacío) | **`0`** (se pasa a `""` y luego a `0`) | `""` | **`true`** (es un objeto) |
| `[25]` (Array 1 núm) | **`25`** | `"25"` | **`true`** |
| `{}` (Objeto vacío) | `NaN` | `"[object Object]"` | **`true`** |

### 5. Igualdad Débil (`==`) vs. Igualdad Estricta (`===`)

* **`===`:** No convierte tipos. Si son de distinto tipo, da `false` directamente.
* **`==` (Reglas de conversión trampa):**
  * Si hay un booleano o número, convierte a **número** ambos lados:
    * `"0" == false` $\rightarrow$ `0 == 0` $\rightarrow$ **`true`** (¡Aunque `if ("0")` sea `true`!).
    * `"" == false` y `"  " == false` $\rightarrow$ `0 == 0` $\rightarrow$ **`true`**.
    * `[] == 0` y `[] == false` $\rightarrow$ `[]` se convierte en `""` y luego en `0` $\rightarrow$ **`true`**.
  * **Regla especial de `null` y `undefined`:**
    * `null == undefined` da **`true`** (son equivalentes entre sí con `==`).
    * Pero `null == 0` o `null == false` da **`false`** (`null` no se convierte a `0` dentro de un `==`).

```javascript
// El enigma del "0" y los espacios en blanco (Pregunta 11 del examen y PDF 2.4)
console.log("0" == false);  // true  (Ambos se convierten a número: 0 == 0)
console.log(Boolean("0"));  // true  (Como string no está vacío, así que es Truthy)

console.log("  " == false); // true  (Un string de espacios convertido a Number() da 0)
console.log([] == false);   // true  ([] pasa a "" y luego a 0: 0 == 0)

// Regla especial de null y undefined con ==
console.log(null == undefined);  // true  (son pareja especial en ==)
console.log(null === undefined); // false (distinto tipo)
console.log(null == 0);          // false (null NO se convierte a 0 en el operador ==)
```

---

## Bloque 4: Operadores Lógicos, Especiales y Precedencia (PDF 2.2 y 2.5)

### 1. Cortocircuito (`&&`, `||`, `??`) y Asignación Lógica (`&&=`, `||=`, `??=`)

Los operadores `&&`, `||` y `??` **devuelven el valor exacto del operando donde se detienen** (no devuelven necesariamente `true` o `false`):

* **AND (`A && B`):** Busca el **primer *Falsy***. Si `A` es *Falsy*, se para y devuelve `A` (no ejecuta `B`). Si `A` es *Truthy*, evalúa y devuelve `B`.
  * Ej: `"Servidor OK" && 200` devuelve **`200`**. `false && funcion()` **no ejecuta** la función.
* **OR (`A || B`):** Busca el **primer *Truthy***. Si `A` es *Truthy*, se para y devuelve `A`. Si `A` es *Falsy* (ej. `0` o `""`), evalúa y devuelve `B`.
  * Ej: `0 || 3000` devuelve **`3000`** (porque `0` es *Falsy*).
* **Coalescencia Nula (`A ?? B`):** Solo salta a `B` si `A` es **Nullish (`null` o `undefined`)**.
  * Ej: `0 ?? 3000` devuelve **`0`** (respeta el `0`, el `false` y el `""` como valores válidos y **no ejecuta** la derecha).
  * ⚠️ **Trampa sintáctica:** Mezclar `||` o `&&` con `??` sin poner paréntesis (ej. `a || b ?? c`) lanza un **`SyntaxError`** directo.
* **Asignaciones lógicas (`??=`, `||=`, `&&=`):**
  * `x ??= 10`: Solo asigna `10` si `x` era `null` o `undefined` (si `x` era `0` o `false`, no lo cambia).
  * `x ||= 10`: Asigna `10` si `x` era cualquier valor *Falsy* (`0`, `""`, `false`, `null`, `undefined`).
  * `x &&= "OK"`: Solo asigna `"OK"` si `x` era *Truthy* (si era `false`, se queda en `false`).

```javascript
// 1. Diferencia entre || y ?? para ejecutar funciones (Preguntas 10, 19 y 23 del examen)
let stock = 0; // 0 es Falsy, pero NO es Nullish (no es ni null ni undefined)

stock || console.log("Con || SÍ me ejecuto porque 0 es Falsy");
stock ?? console.log("Con ?? NO me ejecuto porque 0 es un número válido");

let sesionActiva = false;
sesionActiva && console.log("Con && NO me ejecuto porque la izquierda es false");

// 2. Asignaciones lógicas ??= y &&= (Preguntas 24 y 27 del examen)
let contador = 0;
let etiqueta = null;
let flag = false;

contador ??= 10;     // Como 0 NO es null/undefined, se queda en 0
etiqueta ??= "Base"; // Como era null, ahora vale "Base"
flag ??= true;       // Como false NO es null/undefined, se queda en false
console.log(`${contador}_${etiqueta}_${flag}`); // Imprime: "0_Base_false"

let admin = true;
let invitado = false;
admin &&= "AUTORIZADO";    // Como era true (Truthy), cambia a "AUTORIZADO"
invitado &&= "AUTORIZADO"; // Como era false (Falsy), se queda en false
console.log(`${admin}_${invitado}`); // Imprime: "AUTORIZADO_false"
```

### 2. Operadores Especiales y a Nivel de Bits (PDF 2.2)

* **Encadenamiento opcional (`?.`):** `usuario.contacto?.telefono`. Si `contacto` es `null` o `undefined`, no rompe el programa con `TypeError`, se detiene y devuelve **`undefined`**.
* **Operador Coma (`,`):** Evalúa de izquierda a derecha y **devuelve solo el último valor**: `let x = (1 + 2, 3 + 4);` guarda **`7`**. En un condicional: `if (x++, x * 2 > 0)` primero incrementa `x` y luego comprueba si `x * 2 > 0`.
* **Operador `void`:** Evalúa la expresión pero devuelve siempre **`undefined`** (`void(5 + 5)` $\rightarrow$ `undefined`).
* **`in`, `delete`, `instanceof`:**
  * `"curso" in alumno`: Devuelve `true` si la propiedad existe en el objeto.
  * `delete alumno.activo`: Borra esa propiedad del objeto.
  * `hoy instanceof Date`: Devuelve `true` si el objeto fue creado con esa clase.
* **Operadores Bitwise (Binarios):** Convierten los números a binario (ej. `5` es `0101`, `1` es `0001`):
  * `&` (AND bit a bit): `5 & 1` $\rightarrow$ `0101 & 0001` = `0001` (**`1`**). *(Truco: `x & 1` da `1` si `x` es impar, y `0` si `x` es par)*.
  * `|` (OR bit a bit): `5 | 1` $\rightarrow$ `0101 | 0001` = `0101` (**`5`**).
  * `<<` (Desplazar a la izquierda): `5 << 1` multiplica por 2 (**`10`**). `>>` divide entre 2 (**`2`**).

```javascript
// 1. Encadenamiento opcional (?.) y propiedades de objetos
const alumno = { nombre: "Carlos", contacto: null };
console.log(alumno.contacto?.telefono); // undefined (sin '?.' lanzaría TypeError)
console.log("nombre" in alumno);        // true
delete alumno.contacto;                 // Elimina la propiedad 'contacto'

// 2. Operador coma (,) y operador void
let resultadoComa = (10 + 5, 20 * 2, 99);
console.log(resultadoComa);   // 99 (se queda solo con la última expresión)
console.log(void(100 + 200)); // undefined (void siempre devuelve undefined)

// 3. Operadores a nivel de bits (Bitwise)
console.log(5 & 1);  // 1  (0101 & 0001 = 0001 -> impar)
console.log(4 & 1);  // 0  (0100 & 0001 = 0000 -> par)
console.log(5 << 1); // 10 (desplazar 1 bit a la izquierda multiplica por 2)
```

### 3. Pre/Post Incremento (`++`) y Jerarquía de Precedencia

* **`++a` (Pre-incremento):** Primero suma 1 a la variable y entrega el valor **nuevo** a la operación.
* **`a++` (Post-incremento):** Primero entrega el valor **antiguo** a la operación y luego suma 1 a la variable.
* **Orden de prioridad en operaciones combinadas:**
  1. Paréntesis `()` y acceso `?.` / `.`
  2. Unarios: `++`, `--`, `!`, `typeof`, `void`, `+` (unario)
  3. Potencia: `**` *(Ojo: se calcula de derecha a izquierda)*
  4. Multiplicación `*`, División `/`, Módulo `%` *(de izquierda a derecha)*
  5. Suma `+`, Resta `-`
  6. Bits (`<<`, `>>`, luego `&`, `^`, `|`)
  7. Lógicos: primero `&&`, después `||` y `??`
  8. Ternario `? :`, Asignaciones `=` y por último la Coma `,`.

```javascript
// Caso 1: Pre y Post incremento en la misma línea (Pregunta 14 del examen)
let dato = 10;
let suma = ++dato + dato++;
// 1. '++dato' sube dato a 11 y suelta un 11.
// 2. 'dato++' suelta el 11 actual y LUEGO sube dato a 12.
// 3. suma = 11 + 11 = 22, mientras que dato termina en 12.
console.log(suma + "_" + dato); // Imprime: "22_12"

// Caso 2: Precedencia matemática con potencia y módulo (Pregunta 28 del examen)
let a = 3;
let b = 2;
let res = a++ - b ** 2 % ++b;
// 1. Evaluamos operandos de izquierda a derecha:
//    - 'a++' suelta 3 (y 'a' pasa a 4).
//    - 'b' vale 2.
//    - '++b' sube 'b' a 3 y suelta 3.
//    Queda la cuenta: 3 - (2 ** 2 % 3)
// 2. Primero potencia (**): 2 ** 2 = 4.
// 3. Segundo módulo (%):   4 % 3 = 1 (el resto de dividir 4 entre 3 es 1).
// 4. Último resta (-):     3 - 1 = 2.
console.log(`${res}_${a}_${b}`); // Imprime: "2_4_3"
```

---

## Bloque 5: Estructuras de Decisión y Bucles (PDF 2.5 y 2.6)

### 1. Condicionales, `switch` y Complejidad Ciclomática

* **`if` sin llaves `{ }`:** Solo controla la **primera instrucción** que tiene debajo. La segunda línea se ejecuta **siempre** aunque esté tabulada hacia la derecha.
* **Reglas del `switch`:**
  1. Compara los `case` usando **igualdad estricta (`===`)**. Si la variable es `"1"` (string), **no** entrará en `case 1:` (number).
  2. **Efecto caída (*Fall-through*):** Desde que entra en un `case` o `default`, ejecuta todos los `case` de abajo hacia abajo hasta que encuentre un `break;` o se acabe el `switch`.
  3. **`default` arriba o en medio:** Es legal poner `default:` al principio del `switch`. Si ningún `case` coincide, entra en `default:` y, **si no tiene `break;`, se cae hacia abajo ejecutando el `case` siguiente**.

```javascript
// 1. Trampa del 'if' sin llaves {} (Pregunta 15 del examen)
let autorizado = false;
let puntos = 100;
if (autorizado)
    puntos += 50; // Esta línea pertenece al 'if' (NO se ejecuta porque es false)
    puntos += 10; // ¡TRAMPA! Esta línea está FUERA del 'if' (SÍ se ejecuta siempre)
console.log(puntos); // Imprime: 110

// 2. Trampa del 'switch' con 'default' arriba sin break (Pregunta 2 del examen)
let opcion = 99;
let texto = "";
switch (opcion) {
    default:
        texto += "Defecto_"; // Entra aquí porque ningún case es 99... ¡pero NO hay break!
    case "A":
        texto += "OpcionA_"; // Cae aquí dentro (fall-through) aunque opcion no sea "A"
        break;               // Aquí por fin se detiene y sale del switch
    case "B":
        texto += "OpcionB";
        break;
}
console.log(texto); // Imprime: "Defecto_OpcionA_"
```

* **Complejidad Ciclomática de McCabe y Cláusulas de Guarda (PDF 2.5):**
  * Fórmula para calcular cuántos caminos/tests necesita una función:
    $$\text{Complejidad Ciclomática} = 1 + \text{Número de puntos de decisión}$$
    *(Cuentan como $+1$ cada `if`, `else if`, `while`, `for`, `case`, `?:`, `&&`, `||`, `??`)*.
  * **Cláusulas de Guarda (*Guard Clauses*):** Para reducir el anidamiento piramidal (*Arrow Anti-Pattern*), se validan los errores al principio de la función haciendo `return` temprano (*Early Return*) sin usar `else`, dejando el camino principal (*Happy Path*) al final sin indentación.

```javascript
// Cálculo de Complejidad Ciclomática (Base = 1):
function clasificar(edad, tienePermiso) {
    if (edad >= 18) return "Adulto";                  // +1 (if)
    if (edad >= 16 && tienePermiso) return "Joven";   // +2 (un if + un &&)
    return "Menor";
} // Complejidad total = 1 (base) + 3 (decisiones) = 4 caminos posibles.
```

### 2. Bucles (`while`, `do...while`, `for`) y Etiquetas (*Labels*)

* **`while` vs `do...while`:** `while` comprueba antes de entrar (si es `false`, da **0 vueltas**). `do { ... } while (cond);` comprueba al final (garantiza que se ejecuta **al menos 1 vez**).
* **Variantes válidas del bucle `for`:**
  * Puedes dejar huecos vacíos en el `for`: `for (; i < 5; )` o `for (;;)` (bucle infinito que requiere un `if (...) break;` dentro).
  * Si olvidas actualizar la variable de control en un `while` o `for`, provocas un **bucle infinito** que congela la pestaña del navegador.
* **Etiquetas (`nombreEtiqueta:`):**
  * Se pueden colocar delante de un bucle (`externo: for (...)`) o de un simple bloque de llaves (`bloqueDatos: { ... }`).
  * `break nombreEtiqueta;` rompe y sale completamente del bloque o bucle principal al que apunta la etiqueta.
  * `continue nombreEtiqueta;` salta directamente a la siguiente vuelta del bucle etiquetado.

```javascript
// 1. Bucle 'while' con cuerpo vacío haciendo todo en la condición (Pregunta 6 del examen)
let x = 4;
let y = 0;
while (--x > 0 && (y += x)) {
    // Cuerpo vacío:
    // Vuelta 1: --x deja x=3 (3>0) -> y += 3 (y=3)
    // Vuelta 2: --x deja x=2 (2>0) -> y += 2 (y=5)
    // Vuelta 3: --x deja x=1 (1>0) -> y += 1 (y=6)
    // Vuelta 4: --x deja x=0 (0>0 es false, corta el && y sale del bucle)
}
console.log(`${x}_${y}`); // Imprime: "0_6"

// 2. Bucle 'for (;;)' sin parámetros en los paréntesis (Pregunta 20 del examen)
let acumulador = 0;
let paso = 1;
for (;;) { // Es 100% legal: equivale a un while(true)
    acumulador += paso;
    paso *= 2;
    if (acumulador >= 10) break; // Corta cuando acumulador llega a 15 (1+2+4+8) y paso a 16
}
console.log(`${acumulador}_${paso}`); // Imprime: "15_16"

// 3. Etiquetas (Labels) en bucles anidados y bloques sueltos (Preguntas 16, 29 y 30)
let pasos = 0;
externo: for (let fila = 1; fila <= 3; fila++) {
    for (let col = 1; col <= 3; col++) {
        pasos++;
        if (fila === 2 && col === 1) {
            break externo; // Rompe los DOS bucles de golpe (en fila 1 hizo 3 pasos + 1 en fila 2 = 4)
        }
    }
}
console.log(pasos); // Imprime: 4

// Etiqueta en un bloque normal sin bucle (Pregunta 29)
let reg = "";
bloqueDatos: {
    reg += "A_";
    break bloqueDatos; // Salta fuera de las llaves inmediatamente
    reg += "B_";       // Código inalcanzable
}
console.log(reg); // Imprime: "A_"
```

### 3. Recorrido de Colecciones (`for...of`, `for...in`, `forEach`) y Trampa `.splice()`

* **`for...of` (Valores):** Recorre los **valores** de un array o las letras de un string (`for (const item of lista)`).
* **`for...in` (Claves/Propiedades):** Recorre las **claves** de un objeto. **¡Peligro en Arrays!** Si usas `for...in` en un array, el índice `i` es un **string** (`"0"`, `"1"`, por lo que `i + 1` concatena `"01"`) y además lee métodos añadidos a `Array.prototype`.
* **`.forEach()`:** Método de arrays seguro (`typeof index` es `number` e ignora el prototipo), pero **tiene 2 reglas estrictas:**
  1. ❌ **No permite usar `break` ni `continue`** (da `SyntaxError`).
  2. Ignora los huecos vacíos en *Sparse Arrays* (ej. `[1, , 3]`).

```javascript
const colores = ["Rojo", "Azul"];

// 1. for...of -> Saca los VALORES directamente
for (const color of colores) {
    console.log(color); // Imprime: "Rojo", luego "Azul"
}

// 2. for...in -> Saca las CLAVES como STRING (¡Cuidado en Arrays!)
for (const i in colores) {
    console.log(typeof i, i + 1); // Imprime: "string" "01", luego "string" "11"
}

// 3. .forEach() -> Recibe (elemento, indiceNumérico)
colores.forEach((color, index) => {
    // if (index === 0) break; // ❌ SyntaxError: Illegal break statement
    console.log(index, color); // Imprime: 0 "Rojo", luego 1 "Azul"
});
```

* **La Trampa Mortal de `.splice(i, 1)` dentro de un `for` creciente (PDF 2.6 y Pregunta 25):**
  * `valores.splice(i, 1)` borra el elemento en la posición `i` **modificando el array en vivo**, lo que hace que el elemento de la derecha (`i + 1`) caiga a la posición `i`.
  * Como en la siguiente vuelta el bucle hace `i++`, **se salta sin comprobar el elemento que acaba de caer a la posición `i`**.

```javascript
// Pregunta 25 del examen y Actividad 1 del PDF 2.6:
const valores = [2, 4, 6, 8, 9];

for (let i = 0; i < valores.length; i++) {
    if (valores[i] % 2 === 0) {
        valores.splice(i, 1); // Borra 1 elemento en el índice 'i'
    }
}
// TRAZA PASO A PASO:
// - i = 0: mira el 2 (par) -> lo borra. El array muta a [4, 6, 8, 9]. ¡El 4 cae a la pos 0!
// - i = 1: como i subió a 1, ¡SE SALTA EL 4! Mira la pos 1 que ahora es el 6 (par) -> lo borra.
//          El array muta a [4, 8, 9]. ¡El 8 cae a la pos 1!
// - i = 2: como i subió a 2, ¡SE SALTA EL 8! Mira la pos 2 que ahora es el 9 (impar). Fin.
console.log(valores.join(",")); // Imprime: "4,8,9"

// ✅ SOLUCIÓN SI TIENES QUE PROGRAMARLO: Recorrer el bucle hacia atrás (decreciente)
const numeros = [2, 4, 6, 8, 9];
for (let i = numeros.length - 1; i >= 0; i--) {
    if (numeros[i] % 2 === 0) {
        numeros.splice(i, 1); // Al borrar de derecha a izquierda, los índices pendientes no se mueven
    }
}
console.log(numeros.join(",")); // Imprime: "9" (todos los pares borrados correctamente)
```

---

## 🎯 Escáner Rápido Anti-Trampas para el Día del Examen

Antes de ponerte a calcular qué imprime un código, pasa esta lista de control en 5 segundos:

1. **¿Salta la opción "Error" directa?**
   * ¿Dos `let` o `const` con el mismo nombre en el mismo bloque? $\rightarrow$ **`SyntaxError`**.
   * ¿Se modifica una variable `const` (ej. `for (const i = 0; ...; i++)`)? $\rightarrow$ **`TypeError`**.
   * ¿Se lee una variable antes de su `let`/`const` en el mismo ámbito (TDZ)? $\rightarrow$ **`ReferenceError`**.
   * ¿Se opera matemáticamente un `BigInt` (`10n`) con un `Number` normal (`1`), o se concatena un `Symbol` con `+`? $\rightarrow$ **`TypeError`**.
   * ¿Hay palabras reservadas con mayúscula (`If`, `Const`, `Function`, `Alert`) o un identificador que empieza por número (`1variable`) o lleva guion (`precio-final`)? $\rightarrow$ **Error**.
   * ¿Se mezcla `||` o `&&` con `??` sin paréntesis, o hay comentarios `/* /* */ */` anidados? $\rightarrow$ **`SyntaxError`**.
2. **¿Hay un `return` con salto de línea antes de `{`?** $\rightarrow$ El ASI mete un `;` y devuelve **`undefined`**.
3. **¿Hay un `${...}` dentro de comillas normales `""` o `''` en vez de `` ` ``?** $\rightarrow$ Imprime literalmente `${...}` sin sustituir la variable.
4. **¿Es un `if` sin llaves `{ }` o un `switch` sin `break` (sobre todo en `default` arriba)?** $\rightarrow$ En el `if` la segunda línea se ejecuta siempre; en el `switch` cae al siguiente `case`.