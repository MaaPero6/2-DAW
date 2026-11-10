# Desarrollo web en entorno cliente - Tema 2: Sintaxis del lenguaje JavaScript

## 📌 Resumen Ejecutivo y Objetivos

JavaScript es el único lenguaje de programación nativo que entienden todos los navegadores modernos. No se instala: lo interpreta el motor del navegador (V8 en Chromium y Edge, SpiderMonkey en Firefox, JavaScriptCore en Safari). Esa ubicuidad, su modelo asíncrono y su reutilización en el servidor mediante Node.js lo han convertido en el estándar del *front-end*, por delante de alternativas históricas como los applets de Java, Adobe Flash o VBScript, y de dialectos que se transpilan a JavaScript puro, como TypeScript o JSX.

El tema corresponde al **Resultado de Aprendizaje RA2** («Escribe sentencias simples, aplicando la sintaxis del lenguaje y verificando su ejecución sobre navegadores Web») y se desglosa en ocho criterios:

| Criterio | Enunciado | Apartado | Peso en RA2 |
|---|---|---|---|
| CE 2.a | Se ha seleccionado un lenguaje de programación de clientes web | 2.1 | 10 % |
| CE 2.b | Se han utilizado los distintos tipos de variables y operadores | 2.2 | 10 % |
| CE 2.c | Se han identificado los ámbitos de utilización de las variables | 2.3 | 20 % |
| CE 2.d | Se han reconocido las peculiaridades de las conversiones de tipo | 2.4 | 8 % |
| CE 2.e | Se han utilizado mecanismos de decisión | 2.5 | 20 % |
| CE 2.f | Se han utilizado bucles y verificado su funcionamiento | 2.6 | 20 % |
| CE 2.g | Se han añadido comentarios al código | 2.7 | 2 % |
| CE 2.h | Se han utilizado herramientas de programación, prueba y depuración | 2.8 | 10 % |

Al terminar, el alumnado debe saber justificar la elección de JavaScript, predecir el resultado de una expresión, determinar el ámbito de cualquier variable, elegir la estructura de control adecuada y depurar con breakpoints.

## 📖 Desarrollo Teórico Detallado

### 2.1. Selección de un lenguaje de programación de clientes web

Tres etapas lo explican. Primero, los navegadores dependían de *plugins*: los **applets de Java** (pesados y con historial de vulnerabilidades), **Adobe Flash** (dominador de multimedia hasta que Apple lo excluyó del iPhone por consumo de batería) y **VBScript** (limitado a Internet Explorer). Después llegó la consolidación: hoy el 100 % de los navegadores ejecuta un único lenguaje nativo, JavaScript bajo ECMAScript. Por último, los dialectos actuales se **transpilan** a él: **TypeScript** añade tipado estático; **JSX** mezcla estructuras similares a HTML con código y sostiene los componentes de React.

Las razones técnicas son cuatro: estandarización sin extensiones (*zero plugins*), descarga del cálculo al cliente, modelo asíncrono no bloqueante basado en el bucle de eventos y uso del mismo lenguaje en cliente y servidor.

ECMAScript es la **especificación** (ECMA-262) y JavaScript su **implementación**. ES6/ES2015 introdujo `let` y `const`, clases, funciones flecha y métodos declarativos de array (`map`, `filter`, `reduce`). El **punto y coma** separa sentencias y, aunque ASI (*Automatic Semicolon Insertion*) permite omitirlo, conviene escribirlo siempre. El lenguaje es **case-sensitive** (`Time` y `time` son distintos); los identificadores empiezan por letra, `$` o `_`, nunca por dígito, y no pueden ser palabras reservadas. Las convenciones son `camelCase` para variables y funciones, `PascalCase` para clases, `UPPER_SNAKE_CASE` para constantes y `$` para nodos del DOM. El caso clásico del ASI es el retorno partido: si el objeto literal va en la línea siguiente a `return`, el motor inserta allí un punto y coma y la función devuelve `undefined`.

### 2.2. Tipos de variables y operadores

El tipado es **débil y dinámico**: el tipo pertenece al valor, no a la variable. El estándar moderno reconoce **siete primitivos** más un tipo de referencia.

| Tipo | Naturaleza | Memoria | Ejemplo | `typeof` |
|---|---|---|---|---|
| `number` | Coma flotante IEEE 754 de 64 bits | Pila (valor) | `19.99`, `0xFF`, `2e-9` | `"number"` |
| `bigint` | Entero de precisión arbitraria | Pila | `9007199254740991n` | `"bigint"` |
| `string` | Inmutable | Pila | `` `Hola ${nombre}` `` | `"string"` |
| `boolean` | Verdadero o falso | Pila | `true` | `"boolean"` |
| `undefined` | Sin asignación | Pila | `let x;` | `"undefined"` |
| `null` | Vacío intencionado | Pila | `let x = null;` | `"object"` (anomalía) |
| `symbol` | Identificador único | Pila | `Symbol("id")` | `"symbol"` |
| `object` | Mutable | Montículo (*heap*) | `{}`, `[]`, `function(){}` | `"object"` / `"function"` |

Los primitivos se copian **por valor** y son **inmutables** (`texto[0] = "b"` se ignora). Los objetos se copian **por referencia**: `const copia = lista` no duplica el array, solo el enlace. `number` no distingue enteros de decimales y arrastra la imprecisión de IEEE 754: `0.1 + 0.2` da `0.30000000000000004`; para comparar importes se usa `Math.abs(a - b) < Number.EPSILON`. Los valores especiales son `Infinity`, `-Infinity` y `NaN`, detectable solo con `Number.isNaN()`. `bigint` cubre los enteros que superan $2^{53}-1$ (`Number.MAX_SAFE_INTEGER`).

| Aspecto | `var` | `let` | `const` |
|---|---|---|---|
| Ámbito | Función o global | Bloque | Bloque |
| Redeclaración | Permitida | `SyntaxError` | `SyntaxError` |
| Reasignación | Permitida | Permitida | `TypeError` |
| Inicialización obligatoria | No | No | Sí |
| Elevación | `undefined` | TDZ | TDZ |
| Propiedad de `window` | Sí (ámbito global) | No | No |

| Grupo | Operadores | Observación crítica |
|---|---|---|
| Aritméticos | `+ - * / % ** ++ --` | `+` concatena si un operando es texto |
| Asignación | `= += -= *= /= %= **=` | `??=` y `\|\|=` desde ES2021 |
| Comparación | `== != === !== < <= > >=` | `===` exige valor y tipo |
| Lógicos | `&& \|\| ! ??` | Devuelven un operando, no un booleano |
| Bit a bit | `& \| ~ ^ << >> >>>` | Operan sobre enteros de 32 bits |
| Especiales | `? :`, `?.`, `delete`, `in`, `instanceof`, `void`, `,` | El ternario es el único de tres operandos |

`++x` suma antes de asignar; `x++` asigna antes de sumar. `&&` devuelve el primer valor *falsy* o el último; `||` el primer *truthy*; `??` solo sustituye ante `null` o `undefined`, por lo que respeta el `0`. La precedencia va de paréntesis y accesos a propiedades hasta la coma, pasando por unarios, exponenciación (asociativa a la derecha), multiplicativos, aditivos, relacionales, igualdad, bit a bit, lógicos, ternario y asignación. Mezclar `||` y `??` sin paréntesis lanza `SyntaxError`.

### 2.3. Ámbitos de utilización de las variables

El **ámbito** determina dónde es visible una variable y cuándo se libera. Hay tres niveles: **global** (todo el script, viva hasta cerrar la pestaña), **de función** (nace y muere con la invocación) y **de bloque** (llaves de un `if`, `for` o `switch`).

`var` ignora el bloque: la contadora de un `for` sigue existiendo al salir, lo que produce fugas y colisiones; `let` y `const` desaparecen con las llaves. En el ámbito global, `var` crea una propiedad de `window`; `let` y `const` no lo contaminan.

Al buscar un identificador, el motor recorre la **cadena de ámbitos** hacia el global y lanza `ReferenceError` si no lo encuentra. Si un ámbito interno declara un nombre existente se produce **sombreado** (*shadowing*): la variable interna oculta la externa sin modificarla.

La **elevación** (*hoisting*) explica las diferencias: las declaraciones `var` se registran al inicio con valor `undefined` y pueden leerse antes de su línea; `let` y `const` también se elevan, pero quedan en la **Zona Muerta Temporal** (TDZ) hasta su inicialización. Una asignación sin declaración crea una global accidental; `"use strict"` en la primera línea lo convierte en error. Antes de los módulos nativos, el aislamiento se lograba con el patrón **IIFE**: `(function () { /* ... */ })();`.

### 2.4. Conversiones entre tipos de datos

La **coerción** transforma un valor de un tipo a otro según el contexto; puede ser implícita (motor) o explícita (programador). La implícita depende del operador: `+` concatena si hay un texto (`12 + "5"` → `"125"`), mientras que `-`, `*`, `/`, `%` y `**` fuerzan la conversión numérica (`"10" - 2` → `8`). En contexto numérico, `true` vale 1, `false` y `null` valen 0, y `undefined` produce `NaN`. En contexto booleano rige la lista de **ocho valores falsy**: `false`, `0`, `-0`, `0n`, `""`, `null`, `undefined` y `NaN`. Todo lo demás es *truthy*, incluidos `"0"`, `"false"`, `[]` y `{}`.

Las conversiones explícitas usan `Number()`, `String()` y `Boolean()`. `Number("42px")` devuelve `NaN` porque exige el valor completo; `parseInt("42px", 10)` devuelve `42` porque lee hasta el primer carácter inválido; `parseFloat("19.95 euros")` devuelve `19.95`. `String(null)` devuelve `"null"`, pero `null.toString()` lanza `TypeError`; `!!valor` equivale a `Boolean(valor)`.

| Valor | `Number(x)` | `String(x)` | `Boolean(x)` |
|---|---|---|---|
| `0` | `0` | `"0"` | `false` |
| `"0"` | `0` | `"0"` | `true` |
| `""` | `0` | `""` | `false` |
| `"false"` | `NaN` | `"false"` | `true` |
| `true` | `1` | `"true"` | `true` |
| `null` | `0` | `"null"` | `false` |
| `undefined` | `NaN` | `"undefined"` | `false` |
| `NaN` | `NaN` | `"NaN"` | `false` |
| `[]` | `0` | `""` | `true` |
| `[25]` | `25` | `"25"` | `true` |
| `{}` | `NaN` | `"[object Object]"` | `true` |

El operador `==` aplica coerción antes de comparar y produce resultados contraintuitivos: `0 == false`, `"" == 0`, `[] == 0` y `null == undefined` son `true`; con `===` todos son `false`. La norma profesional es usar igualdad estricta.

`symbol` y `bigint` incorporan barreras deliberadas. Un `Symbol` no admite conversión implícita a texto ni a número (`"Usuario: " + sym` lanza `TypeError`), solo `String(sym)` explícito, y es siempre *truthy*. Un `BigInt` no se mezcla con `number` en aritmética sin conversión explícita; `0n` es falsy y los demás son truthy.

### 2.5. Mecanismos de decisión

Los mecanismos de decisión alteran el flujo lineal al evaluar condiciones booleanas. Un **bloque** agrupa sentencias entre llaves y delimita el ámbito de `let` y `const`.

`if / else if / else` encadena condiciones y, en cuanto una resulta verdadera, ejecuta su bloque y sale de la estructura. Las llaves pueden omitirse en sentencias únicas, aunque es mala práctica: una segunda línea añadida después se ejecuta siempre.

`switch` compara una expresión con valores discretos usando **igualdad estricta**: `"1"` no coincide con `case 1`. Sin `break` se produce **fall-through**, aprovechable para agrupar casos con la misma lógica. `default` no tiene por qué ir al final; si se coloca al principio o en medio, su `break` es obligatorio para no caer en cascada sobre los `case` siguientes.

El **ternario** `condición ? valorSiTrue : valorSiFalse` es el único operador de tres operandos y devuelve un valor, por lo que puede insertarse en una plantilla literal. Los operadores lógicos permiten decisiones abreviadas: `condicion && accion()`, `obtenerDatos() || usarRespaldo()` y `valor ?? porDefecto`.

Frente al anidamiento piramidal (*Arrow Anti-Pattern*) se aplican **cláusulas de guarda** y **retorno temprano**: las precondiciones se validan al inicio y, si fallan, la función retorna de inmediato. La razón es la **complejidad ciclomática** de McCabe:

$$M = 1 + \sum_{i=1}^{n} d_i$$

donde $d_i$ son los puntos de decisión (`if`, `else if`, `case`, `&&`, `||`, `?:`). Una función lineal tiene $M = 1$; una con un `if`, un `else if` y un `&&` tiene $M = 4$ y exige cuatro casos de prueba.

### 2.6. Utilización de bucles

Un bucle repite un bloque mientras se cumpla una condición. La elección depende de si se conoce el número de iteraciones y de si el cuerpo debe ejecutarse al menos una vez.

| Bucle | Comprobación | Mínimo | Uso típico |
|---|---|---|---|
| `while` | Al inicio (pre-test) | 0 | Condición dinámica |
| `do...while` | Al final (post-test) | 1 | Validación de entradas |
| `for` | Al inicio, con contador | 0 | Iteraciones conocidas |
| `for...of` | Iterador de valores | 0 | Arrays y cadenas (ES6) |
| `for...in` | Enumeración de claves | 0 | Propiedades de objetos |

El `for` compacta inicialización, condición y actualización. Declarar el contador con `let` lo aísla del exterior; con `var` se filtra. Omitir la condición equivale a `true` y exige un `break` interno.

`for...of` recorre valores de iterables sin contadores. `for...in` recorre claves y **no debe usarse con arrays**: devuelve índices como cadenas (`"0"`, `"1"`), incluye propiedades del prototipo y no garantiza orden. La alternativa segura es `forEach((valor, indice) => ...)`, que da índice numérico y respeta el orden, aunque no admite `break` ni `continue` y omite las posiciones vacías.

`break` interrumpe el bucle; `continue` salta a la siguiente iteración. Las **etiquetas** permiten que un `break` interno actúe sobre un bucle exterior: `bucleExterior: for (...) { ... break bucleExterior; }`. Al filtrar un array en el mismo sentido aparece el desplazamiento de índices: tras `splice(i, 1)`, el siguiente elemento ocupa esa posición y el contador lo salta; se corrige recorriendo en sentido inverso o creando un array nuevo.

### 2.7. Inclusión de comentarios en el código

El analizador léxico descarta los comentarios: no generan código máquina ni alteran el flujo. Hay cuatro formas: línea (`//`), bloque (`/* ... */`), *hashbang* (`#!`, ECMAScript 2023, obligatoriamente en la línea 1 de los scripts con Node.js) y bloque de licencia (`/*! ... */`), que los minificadores conservan. Los bloques **no se anidan**: el analizador cierra en el primer `*/`, de modo que comentar un fragmento que ya contiene uno deja el resto expuesto y provoca `SyntaxError`. Las etiquetas `TODO`, `FIXME` y `NOTE` son indexadas por los IDE.

El estándar profesional es **JSDoc**: bloques `/** ... */` con `@param {tipo} nombre`, `@returns {tipo}`, `@throws`, `@type` y `@typedef`. Con `// @ts-check`, VS Code valida tipos en `.js` puros; `npx jsdoc index.js` genera un portal HTML en `out/`. El código debe ser autoexplicativo: los comentarios justifican el **por qué**, no el **qué** evidente; se elimina el código muerto comentado y el comentario-disculpa que compensa nombres pobres.

### 2.8. Herramientas y entornos de programación, prueba y depuración

El entorno profesional combina un editor con análisis estático (Visual Studio Code) y las **DevTools** del navegador (F12). El panel *Console* ofrece niveles de severidad (`log`, `warn`, `error`), agrupación (`group`/`groupEnd`), inspección (`log` frente a `dir`) y traza (`trace`); `console.table()` tabula colecciones, `console.assert()` comprueba sin detener la página y `console.count()` audita invocaciones.

La depuración real se hace en *Sources* con breakpoints: de línea, **condicional** (solo pausa si se cumple una expresión, imprescindible en bucles masivos), **logpoint** (registra sin modificar el archivo) y `debugger;`. Existen además interrupciones por petición `fetch`/XHR, por mutación del DOM y por tipo de evento. La navegación usa F8 (continuar), F10 (paso por encima), F11 (entrar) y Shift+F11 (salir), apoyada en el *Call Stack* y las expresiones vigiladas. Los errores son sintácticos (`SyntaxError`, al cargar), de ejecución (`TypeError`, `ReferenceError`) o de lógica (el script corre, pero el resultado es incorrecto).

## 💡 Ejemplos Prácticos y Aplicaciones

**1. El peligro del ASI.** Este código devuelve `undefined` porque el motor inserta un punto y coma tras `return` y el bloque siguiente queda como sentencia aparte:

```javascript
function crearConfiguracion() {
  return
  {
    modo: "oscuro"
  };
}

console.log(crearConfiguracion()); // undefined
```

La versión correcta mantiene la llave de apertura en la misma línea:

```javascript
function crearConfiguracion() {
  return {
    modo: "oscuro"
  };
}

console.log(crearConfiguracion()); // { modo: "oscuro" }
```

**2. Cláusulas de guarda frente al anidamiento piramidal.** La función conserva el comportamiento con un solo nivel de indentación:

```javascript
function calcularMatricula(datos) {
  if (!datos) {
    return { valido: false, error: "Parámetros de matrícula inválidos." };
  }
  if (typeof datos.precioBase !== "number" || datos.precioBase <= 0) {
    return { valido: false, error: "El precio base debe ser un número positivo." };
  }

  const descuentos = { general: 0, desempleado: 0.3, socio: 0.15 };
  const descuento = descuentos[datos.tipoEstudiante];
  if (descuento === undefined) {
    return { valido: false, error: "Tipo de estudiante no reconocido." };
  }

  let total = datos.precioBase * (1 - descuento);
  if (datos.codigoDescuento === "WEB2026") total -= 10;

  return { valido: true, total: Math.max(total, 0) };
}
```

**3. Validación de entrada con `do...while`.** Garantiza al menos un intento:

```javascript
let codigo;
do {
  codigo = prompt("Código numérico de 4 dígitos:");
  if (codigo === null) break; // el usuario canceló
} while (!/^\d{4}$/.test(codigo ?? ""));

console.log(codigo ? `Aceptado: ${codigo}` : "Cancelado.");
```

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

**Conceptos clave**

1. **ECMAScript vs. JavaScript**: la norma ECMA-262 y su implementación por cada motor.
2. **Tipado débil y dinámico**: el tipo pertenece al valor; una variable puede cambiar de tipo.
3. **Por valor vs. por referencia**: primitivos en la pila, objetos en el montículo mediante enlace.
4. **`var` / `let` / `const`**: diferencias de ámbito, redeclaración, reasignación y elevación.
5. **TDZ (Zona Muerta Temporal)**: intervalo en que `let` y `const` existen pero no son accesibles.
6. **Coerción implícita y explícita**: `+` concatena, `-` convierte; `Number`, `parseInt`, `parseFloat`.
7. **Los ocho valores falsy**: `false`, `0`, `-0`, `0n`, `""`, `null`, `undefined`, `NaN`.
8. **`==` frente a `===`**: la igualdad abstracta convierte tipos; la estricta no.
9. **`??` frente a `||`**: la coalescencia nula solo sustituye `null` y `undefined`.
10. **`switch` con igualdad estricta** y **fall-through** intencionado o accidental.

**Preguntas de autoevaluación**

**1. ¿Qué imprime `typeof null` y por qué?**
`"object"`. Es un error histórico de 1995 conservado por compatibilidad: la etiqueta de tipo de `null` quedó codificada como la de los objetos. Se comprueba con `valor === null`.

**2. ¿Cuál es el resultado de `0.1 + 0.2 === 0.3`?**
`false`. `0.1` y `0.2` no tienen representación exacta en binario de 64 bits y la suma es `0.30000000000000004`. La comparación correcta es `Math.abs((0.1 + 0.2) - 0.3) < Number.EPSILON`.

**3. ¿Qué diferencia hay entre `let x;` y `x = 5;` sin declaración previa en modo no estricto?**
La primera crea una variable local con valor `undefined`; la segunda, una propiedad de `window`, fuga que en modo estricto lanza `ReferenceError`.

**4. Explica por qué la función devuelve `undefined` si el objeto literal está en la línea siguiente a `return`.**
Por el ASI: el motor considera terminada la sentencia `return` en el salto de línea e inserta un punto y coma, de modo que el objeto siguiente queda como sentencia independiente.

**5. ¿Qué imprimen `5 == "5"`, `5 === "5"` y `5 + "5"`?**
`true`, `false` y `"55"`. La igualdad abstracta convierte el texto a número; la estricta exige mismo tipo; `+` con un operando de texto concatena.

**6. ¿Por qué `if ("0")` entra al bloque si `"0" == false` es `false`?**
Son evaluaciones distintas. En `"0" == false` se convierten ambos a `0`, resultando `true`. En `if ("0")` no hay comparación: toda cadena no vacía es truthy, incluida `"0"`.

**7. En un `switch` sobre la cadena `"1"`, ¿se ejecuta `case 1:`?**
No. `switch` compara con igualdad estricta (`===`) y `"1" !== 1`, así que el flujo cae al `default`. Es un error frecuente al leer formularios, cuyos valores llegan como cadena.

**8. Dado `const lista = [1, 2]; lista.push(3);`, ¿es legal? ¿Y `lista = [4]`?**
`push` es legal: `const` impide reasignar la referencia, no mutar el contenido. La reasignación lanza `TypeError: Assignment to constant variable`.
