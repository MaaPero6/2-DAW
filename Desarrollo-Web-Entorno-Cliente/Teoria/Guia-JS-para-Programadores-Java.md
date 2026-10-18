# ⚡ Guía Práctica de JavaScript (Cliente) para Programadores provenientes of Java

Bienvenido al desarrollo web en **entorno cliente (DWEC)**. Si vienes de **Java**, probablemente pienses que JavaScript es similar por el nombre. **No podrían ser más diferentes.**

Esta guía te ayudará a **traducir tus conocimientos de Java a JavaScript (ES6+)**, entender el modelo de ejecución en el navegador, aprender a manipular el HTML mediante el **DOM** y reaccionar a **eventos**.

---

## ☕ 1. De Java a JavaScript: Desmontando Mitos

| Concepto | ☕ Java | ⚡ JavaScript (Cliente) |
|---|---|---|
| **Nombre y Origen** | Creado por Sun Microsystems en 1995. Lenguaje compilado profesional. | Creado en 10 días por Brendan Eich en Netscape (1995). Se llamó JavaScript por puro marketing comercial. |
| **Dónde se ejecuta** | En la **JVM** (Servidor, escritorio o backend). | En el **Navegador del cliente** (Chrome, Firefox, Safari) usando motores JIT (como el motor **V8** de Google). |
| **Consumo de Recursos**| Memoria y procesador del servidor o máquina local. | Consume la **CPU, la RAM y la batería del dispositivo del usuario**. |
| **Modelo de Hilos** | **Multihilo (*Multi-threaded*):** Gestión manual o automática de `Threads`. | **Un solo hilo (*Single-threaded*):** Basado en un bucle de eventos (**Event Loop**) asíncrono y no bloqueante. |
| **Tipado** | **Estático y Fuerte:** `int edad = 20;` | **Dinámico y Débil:** `let edad = 20;` |
| **Tipos Numéricos** | `byte`, `short`, `int`, `long`, `float`, `double`. | **Un solo tipo:** `number` (Todos los números son flotantes de 64 bits IEEE 754). |
| **Clases y Objetos** | Clases rígidas. Todo objeto proviene de una `class`. | Basado en **Prototipos** (aunque desde ES6 existe la palabra `class`, por dentro sigue siendo prototípica). |

---

## 🌐 2. Cómo incluir JavaScript en una Página HTML

En entorno servidor (PHP o Java Servlets), el servidor genera el texto de la página antes de enviarla. En **entorno cliente**, el navegador descarga el HTML y **ejecuta el código JavaScript localmente**.

### La forma recomendada: Fichero `.js` externo

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Aplicación JS</title>

    <!-- 
        USO DE 'defer': 
        Descarga el script en segundo plano MIENTRAS el navegador dibuja el HTML, 
        y lo ejecuta justo cuando el árbol HTML (DOM) está totalmente construido.
    -->
    <script src="app.js" defer></script>
</head>
<body>

    <h1 id="titulo">Hola Mundo</h1>
    <button id="miBoton">Haz clic aquí</button>

</body>
</html>
```

### 🏷️ Glosario Rápido de Etiquetas y Atributos HTML clave para JS

| Etiqueta / Atributo HTML | Significado | Importancia para JavaScript |
|---|---|---|
| `<script src="app.js">` | Etiqueta de script | Enlaza el archivo de código JavaScript. |
| `id="miElemento"` | Identificador Único | Es el **DNI** del elemento. Permite a JS buscarlo rápido en la página: `document.getElementById("miElemento")`. |
| `class="boton-primario"` | Clase CSS | Agrupa múltiples elementos. JS puede buscar todos los elementos de esa clase o cambiar sus estilos visuales. |
| `<button>` | Botón interactivo | Elemento estándar para escuchar eventos de clic (`click`). |
| `<input type="text">` | Campo de entrada | Permite al usuario escribir texto. JS lee su valor con `.value`. |
| `<div>` y `<span>` | Contenedores | `<div>` es un contenedor en bloque (para agrupar secciones) y `<span>` es en línea (para envolver palabras o textos sueltos). |

---

## 📦 3. Variables: `let`, `const` y por qué NO usar `var`

En Java declaras variables con su tipo (`int a = 1; final double PI = 3.14;`).
En JavaScript moderno (ES6+), se usan dos palabras clave: **`let`** y **`const`**.

```java
// ☕ En Java
int contador = 0;
contador = 1; // Permitido

final double PI = 3.14159;
// PI = 3.14; // ❌ Error de compilación
```

```javascript
// ⚡ En JavaScript
let contador = 0;
contador = 1; // Permitido: "let" permite reasignar valores

const PI = 3.14159;
// PI = 3.14; // ❌ Error en tiempo de ejecución: "const" NO se puede reasignar
```

### ⚠️ Regla de Oro: ¡Olvídate de `var`!
En tutoriales antiguos de JS verás la palabra `var`. **No la uses jamás.**
* `var` tiene ámbito de función y un comportamiento extraño llamado *hoisting* (elevación) que genera bugs invisibles.
* `let` y `const` tienen **ámbito de bloque (`{}`)**, comportándose exactamente igual que las variables en Java dentro de un `if` o `for`.

### 💡 El matiz de `const` con Objetos y Arrays
En Java, si marcas una `final List<String> lista = new ArrayList<>()`, no puedes asignar otra lista a la variable, pero **sí puedes añadir elementos a la lista**. En JS con `const` ocurre **exactamente lo mismo**:

```javascript
const frutas = ["Manzana", "Pera"];

// ❌ ERROR: No puedes reasignar la variable completa
// frutas = ["Naranja"]; 

// ✅ PERMITIDO: Puedes modificar el contenido interno del array u objeto
frutas.push("Naranja"); 
console.log(frutas); // ["Manzana", "Pera", "Naranja"]
```

---

## ❓ 4. Los valores nulos: `null` vs `undefined`

En Java solo existe `null` para indicar que una variable de tipo referencia no apunta a ningún objeto.
En JavaScript existen **dos conceptos distintos**:

```javascript
// 1. undefined: La variable ha sido declarada pero NADIE le ha asignado un valor aún.
let nombre;
console.log(nombre); // Imprime: undefined

// 2. null: Es un valor asignado explícitamente para indicar "ausencia intencionada de valor".
let usuarioLogueado = null; // No hay ningún usuario logueado en este momento
```

---

## 🔍 5. Comparaciones y plantilla de cadenas (*Template Literals*)

### 1. Plantilla de cadenas (*Template Literals* con Backticks `` ` ``)

En Java concatenas texto con `+` o usas `String.format()`. En JavaScript moderno se usan los **backticks** (acentos invertidos `` ` ``) y la sintaxis `${variable}`:

```javascript
const nombre = "Elena";
const edad = 24;

// ❌ Forma antigua (incómoda):
const mensaje1 = "Hola " + nombre + ", tienes " + edad + " años.";

// ✅ Forma moderna con Template Literals:
const mensaje2 = `Hola ${nombre}, tienes ${edad} años.`;
console.log(mensaje2); // Imprime: Hola Elena, tienes 24 años.
```

### 2. Comparaciones: `==` vs `===`

Igual que vimos en PHP, en JavaScript existe la igualdad débil (`==`) y la **igualdad estricta (`===`)**:

```javascript
const numero = 10;
const texto = "10";

console.log(numero == texto);  // true  (¡Cuidado! Convierte el string a número implícitamente)
console.log(numero === texto); // false (Recomendado: Compara VALOR Y TIPO, como en Java)
```

> 💡 **En JavaScript usa SIEMPRE `===` y `!==`.**

### 3. Valores "Truthy" y "Falsy"

En Java, la condición de un `if(condicion)` debe ser estrictamente un `boolean`. En JS, cualquier valor se puede evaluar dentro de un `if`.

Valores que equivalen a **`false` (Falsy)** en JS:
* `false`
* `0` (el número cero)
* `""` (cadena vacía)
* `null`
* `undefined`
* `NaN` (*Not a Number*)

**Cualquier otro valor (incluyendo arrays vacíos `[]` u objetos vacíos `{}`) equivale a `true` (Truthy).**

```javascript
const nombre = "";

if (nombre) {
    console.log("Tiene nombre");
} else {
    console.log("El nombre está vacío"); // ¡Se ejecuta este bloque!
}
```

---

## 🎯 6. Funciones: "Ciudadanas de Primera Clase"

En Java, un método pertenece obligatoriamente a una clase. En JavaScript, las funciones son **valores de primera clase**: se pueden guardar en variables, pasar como parámetros a otras funciones (llamadas **callbacks**) y retornar desde otras funciones.

### Las tres formas de escribir una función en JS

```javascript
// 1. Declaración tradicional (Equivalente al método en Java)
function sumar(a, b) {
    return a + b;
}

// 2. Expresión de función (Guardada en una variable constante)
const restar = function(a, b) {
    return a - b;
};

// 3. Funciones Flecha (Arrow Functions - ES6)
// Equivalente a las expresiones Lambda en Java: (a, b) -> a * b
const multiplicar = (a, b) => {
    return a * b;
};

// Si la función flecha solo tiene una línea, el 'return' y las llaves son IMPLÍCITOS:
const duplicar = x => x * 2;

console.log(duplicar(5)); // Imprime: 10
```

---

## 🛠️ 7. Arrays y Métodos de Programación Funcional

En Java usas la Stream API (`lista.stream().map(...).collect(...)`). En JavaScript, los arrays vienen con estos métodos funcionales **integrados de forma nativa**:

```javascript
const numeros = [1, 2, 3, 4, 5];

// 1. forEach: Recorre el array (como el for-each de Java)
numeros.forEach(num => {
    console.log(`Número: ${num}`);
});

// 2. map: Transforma cada elemento y devuelve un NUEVO array
const dobles = numeros.map(num => num * 2);
console.log(dobles); // [2, 4, 6, 8, 10]

// 3. filter: Filtra los elementos que cumplan una condición
const pares = numeros.filter(num => num % 2 === 0);
console.log(pares); // [2, 4]

// 4. find: Devuelve el PRIMER elemento que cumpla la condición (o undefined)
const mayorQueTres = numeros.find(num => num > 3);
console.log(mayorQueTres); // 4
```

---

## 🌳 8. El DOM (Document Object Model): Conectando JS con el HTML

El **DOM** es el árbol de objetos que el navegador crea en memoria a partir del código HTML. JavaScript interactúa con la página a través del objeto global **`document`**.

```
                document
                   │
                <html>
           ┌───────┴───────┐
        <head>          <body>
           │          ┌────┴────┐
        <title>      <h1>      <button>
```

### 1. Seleccionar elementos del HTML

```javascript
// Seleccionar por ID (El método más rápido)
const titulo = document.getElementById("tituloPrincipal");

// Seleccionar usando sintaxis de selectores CSS (Muy versátil)
const primerBoton = document.querySelector(".btn-guardar"); // Busca por clase CSS
const todosLosParrafos = document.querySelectorAll("p");   // Devuelve una lista con todos los <p>
```

### 2. Modificar el contenido y aspecto visual

```javascript
const titulo = document.getElementById("tituloPrincipal");

// Cambiar el texto de forma segura (Equivalente a cambiar el texto interno)
titulo.textContent = "¡Texto cambiado desde JavaScript!";

// Cambiar estilos CSS directamente desde JS (Usa formato camelCase)
titulo.style.color = "blue";
titulo.style.fontSize = "32px"; // En CSS es font-size, en JS es fontSize

// Añadir o quitar clases CSS (La mejor práctica para cambiar estilos)
titulo.classList.add("destacado");
titulo.classList.remove("oculto");
```

---

## 🖱️ 9. Eventos: La Web Reacciona a las Acciones del Usuario

En Java Swing/JavaFX tenías `ActionListener`. En JavaScript escuchamos eventos con el método **`addEventListener()`**.

### Sintaxis general:
`elemento.addEventListener("tipoDeEvento", funcionCallback);`

```javascript
const boton = document.getElementById("miBoton");

// Escuchar el clic del usuario
boton.addEventListener("click", (event) => {
    console.log("¡El usuario ha hecho clic en el botón!");
    alert("¡Boton pulsado!");
});
```

---

## 🚀 10. Ejemplo Práctico Completo: Aplicación de Lista de Tareas (*Todo List*)

A continuación tienes un ejemplo real y completo paso a paso. Guarda ambos archivos en la misma carpeta y ábrelos en tu navegador:

### 📄 Archivo 1: `index.html`

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Lista de Tareas con JS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .completada { text-decoration: line-through; color: gray; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 8px 0; cursor: pointer; }
    </style>
    <!-- Enlazamos nuestro archivo JS con defer para esperar a que cargue el HTML -->
    <script src="app.js" defer></script>
</head>
<body>

    <h1>Lista de Tareas (DWEC)</h1>

    <!-- FORMULARIO PARA AÑADIR TAREAS -->
    <form id="formTarea">
        <input type="text" id="inputTarea" placeholder="Escribe una tarea..." required>
        <button type="submit">Añadir Tarea</button>
    </form>

    <h2>Mis Tareas:</h2>
    <!-- Aquí JavaScript inyectará dinámicamente las tareas -->
    <ul id="listaTareas"></ul>

</body>
</html>
```

### 📄 Archivo 2: `app.js`

```javascript
// --- 1. SELECCIÓN DE ELEMENTOS DEL DOM ---
const formulario = document.getElementById("formTarea");
const inputTarea = document.getElementById("inputTarea");
const listaTareas = document.getElementById("listaTareas");

// Array para guardar nuestras tareas en memoria (como un ArrayList en Java)
const tareas = [];

// --- 2. ESCUCHAR EL EVENTO SUBMIT DEL FORMULARIO ---
formulario.addEventListener("submit", (event) => {
    // PREVENIR el comportamiento por defecto de los formularios HTML 
    // (evita que la página se recargue al pulsar Submit)
    event.preventDefault();

    // Obtener el texto del input quitando espacios en blanco a los lados
    const texto = inputTarea.value.trim();

    if (texto !== "") {
        // Crear un objeto tarea
        const nuevaTarea = {
            id: Date.now(), // Marca de tiempo única
            texto: texto,
            completada: false
        };

        // Añadir al array de tareas
        tareas.push(nuevaTarea);

        // Limpiar el campo de texto
        inputTarea.value = "";

        // Volver a renderizar la lista en pantalla
        renderizarTareas();
    }
});

// --- 3. FUNCIÓN PARA DIBUJAR LAS TAREAS EN EL HTML ---
function renderizarTareas() {
    // Limpiar el contenido actual del <ul>
    listaTareas.innerHTML = "";

    // Recorrer el array de tareas
    tareas.forEach((tarea) => {
        // Crear un nuevo elemento <li> en memoria
        const li = document.createElement("li");
        li.textContent = tarea.texto;

        // Si la tarea está completada, le añadimos la clase CSS .completada
        if (tarea.completada) {
            li.classList.add("completada");
        }

        // Al hacer clic en el <li>, cambiamos el estado de completada
        li.addEventListener("click", () => {
            tarea.completada = !tarea.completada; // Invertir booleano
            renderizarTareas(); // Redibujar
        });

        // Añadir el <li> como hijo dentro del <ul> en la página
        listaTareas.appendChild(li);
    });
}
```

---

## 💡 Resumen de Reglas de Oro de Java a JavaScript

1. ⚠️ **Usa `const` por defecto, y `let` solo si vas a reasignar.** Jamás uses `var`.
2. 🎯 **Usa siempre `===` y `!==`** para evitar fallos de conversión implícita de tipos.
3. 🔤 **Template Literals:** Acostúmbrate a usar backticks `` `Hola ${nombre}` `` para concatenar texto.
4. ⚡ **Funciones Flecha:** `(param) => { ... }` es tu mejor aliada para callbacks.
5. 🛡️ **`event.preventDefault()`:** Recuerda usarlo en eventos `submit` de formularios para evitar que la página se recargue.
6. 🌐 **El DOM es tu interfaz:** Usa `document.getElementById()` o `querySelector()` para buscar elementos HTML y modificar su `.textContent`, `.style` o `.classList`.
