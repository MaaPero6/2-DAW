# Teoría Tema 1 — Arquitecturas y Tecnologías de Programación sobre Clientes Web

Apuntes compactados de **DWEC** (Desarrollo Web en Entorno Cliente). Todo el tema pertenece al **RA1** y se evalúa a través de **6 criterios curriculares** de igual peso:

| Criterio | Qué se evalúa | Apartado |
|---|---|---|
| CE 1.a | Modelos de ejecución en servidor y cliente | [1.1](#11-modelo-clienteservidor) |
| CE 1.b | Capacidades y mecanismos de los navegadores | [1.2](#12-el-navegador-web) |
| CE 1.c | Principales lenguajes de programación cliente | [1.3](#13-lenguajes-de-programación-cliente) |
| CE 1.d | Programación de guiones (scripts): ventajas y desventajas | [1.4](#14-programación-de-guiones-scripts) |
| CE 1.e | Integración de lenguajes de marcas con lenguajes de programación | [1.5](#15-integración-de-javascript-en-html) |
| CE 1.f | Herramientas de programación y prueba | [1.6](#16-herramientas-de-programación-y-prueba) |

---

## 1.1 Modelo cliente/servidor

### Contexto histórico

- **Origen de la Web:** 1989, en el laboratorio europeo de física de partículas (**CERN**). **Tim Berners-Lee** buscaba un sistema sencillo para que los científicos compartieran documentos con enlaces entre sí.
- **W3C** (World Wide Web Consortium): organismo internacional que crea los estándares para que las páginas funcionen igual en cualquier navegador. Su delegación española está en `www.w3c.es`.
- **La nube (cloud computing):** antes las empresas tenían sus propios servidores en dependencias físicas locales; ahora contratan espacio y potencia bajo demanda (p. ej. **AWS**).
- **Especialización del trabajo técnico:** con la complejidad de las apps web, los roles se separaron en:
  - **Diseñadores (UX/UI):** paleta de colores, tipografía y distribución de la interfaz.
  - **Programadores de cliente (Front-end):** componentes interactivos, menús y pantallas.
  - **Programadores de servidor (Back-end):** servicios que persisten datos, procesan transacciones y protegen accesos.
  - **Administradores de BBDD (DBA):** optimizan y garantizan la integridad de los datos.

### Entorno Servidor (Back-end)

Infraestructura **no visible** para el usuario final.

- **Dónde se ejecuta:** en servidores dedicados o instancias en la nube. El usuario nunca tiene acceso directo al código fuente.
- **Tareas principales:**
  - Autenticar la identidad de los usuarios (credenciales y sesiones).
  - Realizar cobros y pagos bancarios de forma segura.
  - Conectarse a sistemas gestores de bases de datos:
    - **Relacionales (SQL):** tablas con filas y columnas → MySQL, MariaDB, PostgreSQL, Oracle.
    - **Documentales (NoSQL):** bloques y documentos → MongoDB.
- **Lenguajes habituales:** PHP, Java, Python, Node.js (JS en servidor), C# (.NET).

### Entorno Cliente (Front-end)

Capa de presentación que se dibuja en la pantalla del dispositivo del usuario.

- **Dónde se ejecuta:** localmente, dentro del navegador. El cliente descarga los archivos por la red y el navegador los interpreta usando la **CPU y la RAM del propio dispositivo**.
- **Los tres pilares:**

  | Pilar | Rol | Ejemplos |
  |---|---|---|
  | **HTML** | Armazón estructural: elementos del documento | títulos, párrafos, tablas, imágenes, formularios |
  | **CSS** | Diseño y presentación visual | colores, tipografías, maquetación *responsive* |
  | **JavaScript** | Capa lógica interactiva | eventos de ratón/teclado, alterar el documento, validaciones |

- ⚠️ **Premisa de seguridad (visibilidad del código):** el código del cliente es **completamente público**. Cualquiera abre las DevTools (F12) y ve, audita o modifica tu HTML y JavaScript en tiempo de ejecución. Por tanto, **claves de cifrado, contraseñas y operaciones contables nunca deben vivir solo en el cliente**.

### Tabla comparativa

| Dimensión | Cliente (Front-end) | Servidor (Back-end) |
|---|---|---|
| **Entorno de ejecución** | Navegador del usuario (Chrome, Firefox, Safari, Edge) | Servidor remoto o instancia en la nube |
| **Visibilidad del código** | Público: inspeccionable con F12 | Privado: reside solo en el servidor |
| **Tecnologías clave** | HTML5, CSS3, JavaScript (React, Vue, Angular) | PHP, Python, Java, Node.js, C# |
| **Acceso a datos** | Indirecto: peticiones HTTP | Directo: conexión nativa a motores SQL/NoSQL |
| **Consumo de recursos** | CPU, RAM y batería del dispositivo | Potencia y memoria del servidor |
| **Latencia de respuesta** | Inmediata para acciones visuales | Sujeta a la latencia de red y carga del servidor |
| **Nivel de seguridad** | Bajo: modificable por el cliente | Alto: núcleo fiable de cobros, permisos y roles |

### De la web tradicional a la web moderna

- **Modelo tradicional:** cada clic o formulario disparaba una petición **síncrona** al servidor, que devolvía un HTML nuevo y completo → pantalla en blanco y parpadeo visible.
- **Modelo moderno (SPA — *Single Page Application*):**
  - La plantilla y los recursos base se descargan **una sola vez** al iniciar.
  - Al interactuar, la página **no se recarga**.
  - JavaScript pide solo los datos necesarios en **JSON** de forma asíncrona y actualiza selectivamente las partes del árbol visual que cambian.

### Criterio de asignación: ¿cliente o servidor?

> **Lo que aporta usabilidad e inmediatez → cliente. Lo que requiere integridad y seguridad → servidor.**

| Va en el **cliente** | Va **solo en el servidor** |
|---|---|
| Desplegar/ocultar menús, modales o acordeones | Cobros con pasarelas de pago (el importe se calcula en servidor para que el navegador no lo altere) |
| Cambiar estilos y colores según eventos (hover, clic) | Consultas complejas sobre miles o millones de registros |
| Ordenar y filtrar datos ya cargados en memoria | Comprobar privilegios y roles antes de conceder accesos administrativos |

### Vocabulario

- **Cliente:** dispositivo y software navegador con el que el usuario interactúa con la app.
- **Servidor:** máquina conectada a la red que aloja servicios, gestiona la lógica de negocio y responde a las peticiones.
- **Renderizar:** proceso por el que el motor del navegador interpreta HTML/CSS/JS y pinta los elementos en pantalla.
- **Base de datos:** sistema de almacenamiento estructurado, persistencia y consulta ágil de grandes volúmenes de datos.
- **DevTools:** utilidades de diagnóstico del navegador (F12) para auditar el DOM, monitorizar peticiones de red y depurar JavaScript.

---

## 1.2 El navegador Web

### Qué es

Aplicación cliente instalada en el ordenador o móvil del usuario. Su trabajo consiste en **pedir páginas** a servidores mediante HTTP/HTTPS, **interpretar** el código que recibe (HTML, CSS, JS) y **mostrarlo** de forma comprensible e interactiva.

### Los 7 módulos internos

Para que todo funcione sin fallos ni bloqueos, el interior de un navegador se divide en siete partes:

| # | Módulo | Función |
|---|---|---|
| 1 | **Interfaz de usuario (UI)** | Lo que tocamos: barra de direcciones, pestañas, adelante/atrás, recargar, menú |
| 2 | **Motor del navegador** | Puente entre la interfaz externa y los motores internos (abrir pestaña, mostrar alerta) |
| 3 | **Motor de renderizado** | Lee HTML y CSS, calcula tamaño y posición de cada elemento y lo dibuja |
| 4 | **Motor de JavaScript** | Interpreta el código y lo ejecuta. Usa **compilación JIT**: detecta las funciones que se ejecutan muchas veces y las traduce a código máquina nativo para ganar velocidad |
| 5 | **Capa de red** | Envía y recibe datos (descarga recursos, resuelve DNS, comprueba certificados HTTPS) |
| 6 | **Backend de interfaz** | Conecta con el sistema operativo (Windows, Linux, macOS, Android) para dibujar controles con aspecto nativo |
| 7 | **Almacenamiento de datos** | Cookies, caché y bases de datos locales guardadas en el disco del usuario |

> 💡 **Fundamental — Motores separados:** el motor de renderizado (dibuja) y el motor de JavaScript (ejecuta) son **piezas distintas**. Cuando JS cambia un texto en pantalla, el motor de JS debe **avisar** al de renderizado para que recalcule y repinte ese trozo.

### Los grandes motores del mercado

| Navegador | Motor de renderizado | Motor de JavaScript | Empresa |
|---|---|---|---|
| Google Chrome | Blink | V8 | Google |
| Microsoft Edge | Blink | V8 | Microsoft |
| Mozilla Firefox | Gecko | SpiderMonkey | Fundación Mozilla |
| Apple Safari | WebKit | JavaScriptCore | Apple |
| Brave / Opera | Blink | V8 | Varios |

- 📱 **iPhone y iPad:** las normas de la App Store obligan a que **cualquier** navegador (aunque se llame Chrome o Firefox) use por dentro **WebKit**.
- 📖 **Origen de Blink:** Chrome usaba WebKit. En **2013** Google hizo una copia del proyecto y siguió su desarrollo por separado bajo el nombre **Blink**, hoy usado por casi todos los navegadores basados en Chromium.

### Del código a los píxeles: el proceso de renderizado

Cuando el navegador recibe el HTML, da **cuatro pasos**:

1. **Creación del DOM y CSSOM** — lee el HTML y construye en memoria el árbol de etiquetas (**DOM**); a la vez lee el CSS y genera el árbol de reglas de estilo (**CSSOM**).
2. **Unión en el Render Tree** — combina ambos árboles. **Solo entran los elementos visibles**: `<head>` o cualquier elemento con `display: none;` quedan fuera porque no ocupan espacio visual.
3. **Disposición (Layout)** — calcula ancho, alto y coordenadas exactas de cada caja según el tamaño de la ventana.
4. **Pintado (Paint)** — dibuja colores, bordes, tipografías e imágenes píxel a píxel.

> ⚠️ **Cuidado con los scripts:** si el navegador encuentra un `<script>` mientras lee el HTML, **detiene la lectura** hasta que el archivo se descarga y se ejecuta por completo. Si el script es pesado, la pantalla se queda en blanco.

### APIs nativas del navegador

Funciones ya preparadas accesibles desde JavaScript:

1. **Manipulación del DOM:** cambiar textos, colores, ocultar cajas o crear elementos.
2. **Peticiones en segundo plano:** `fetch()` pide datos a un servidor sin recargar la página.
3. **Guardar datos en el equipo:**

   | Mecanismo | Persistencia | Tamaño | Uso típico |
   |---|---|---|---|
   | `cookies` | En cada petición al servidor | ~4 KB | Mantener la sesión iniciada |
   | `sessionStorage` | Mientras la pestaña siga abierta | pequeño | Se borra al cerrar la pestaña |
   | `localStorage` | Permanente (sobrevive al apagado) | 5–10 MB | Preferencias, tokens |
   | `IndexedDB` | Permanente | grande | App que funciona sin conexión |

4. **Acceso a dispositivos físicos** (siempre con permiso del usuario): geolocalización (GPS/Wi-Fi), cámara y micrófono, estado de batería y de red.

**Compatibilidad:** no todos los navegadores incorporan las novedades a la vez, así que se comprueba si la función existe antes de usarla:

```js
if ('geolocation' in navigator) {
  // El navegador soporta geolocalización
} else {
  // Es un navegador antiguo y no la soporta
}
```

Para consultar en qué versiones funciona cada característica está **Can I Use**.

### El DOM: puente de comunicación

El navegador construye en RAM una estructura de **árbol invertido** con todos los elementos de la página:

```
                window (BOM / navegador)
                        │
                      document
                        │
                       <html>
                  ┌─────┴─────┐
                <head>       <body>
                  │         ┌──┴──┐
                <title>   <h1>   <p>
                  │        │      │
                "Título"  "Título" "Texto..."
```

- **Definición:** el DOM es la representación estructurada de todos los elementos de la web (enlaces, botones, textos, imágenes, contenedores).
- **Rol de JavaScript:** JS **no dibuja directamente** en la tarjeta gráfica; se comunica con la interfaz del DOM para buscar nodos, leer propiedades, alterar contenido o borrar y crear etiquetas. Cada vez que JS cambia el DOM, el motor de renderizado recalcula el espacio de los elementos y vuelve a pintar.

### Vías de salida y comunicación

**1. Consola de depuración — `console.log()`**

- **Qué es:** canal directo al panel de diagnóstico. No altera la página ni es visible para el usuario.
- **Cómo se accede:** `F12` (o clic derecho → Inspeccionar) → pestaña Consola.
- **Utilidad:** depurar, verificar el valor de una variable en un instante o comprobar si una función se ejecutó.
- **Ampliación:** `console.error("Fallo crítico")`, `console.warn("Atención")`, y `console.time("proceso")` / `console.timeEnd("proceso")` para medir tiempos exactos.

**2. Modificación de contenido — `innerHTML`**

- **Qué es:** propiedad de los nodos del DOM para leer o sobrescribir todo el marcado y texto que contienen.
- **Mecanismo:** se localiza el elemento con `document.getElementById('id')` y se reasigna el contenido.

```html
<p id="parrafito"></p>
<script>
  document.getElementById("parrafito").innerHTML = 5 + 6;  // escribe "11"
</script>
```

- ⚠️ **Seguridad esencial (XSS):** si metes con `innerHTML` texto escrito por un usuario desconocido, un atacante podría inyectar un `<script>` malicioso y ejecutarlo en el navegador de otras personas (**Cross-Site Scripting**). Para insertar texto plano, más rápido e inmune a inyecciones, usa **`textContent`**.

**3. Flujo directo de marcado — `document.write()`**

- **Qué es:** método clásico que escribe texto o etiquetas HTML directamente en el flujo de la página mientras se está leyendo.
- ⚠️ **Comportamiento crítico:** funciona bien **durante** la carga de la página. Si se invoca **después** de que la página haya terminado de cargar (por ejemplo, dentro de un `onclick`), el navegador **borra irreversiblemente todo el documento** y deja solo lo escrito en esa llamada. **No se recomienda en desarrollos modernos.**

**4. Diálogos modales — `window.alert()`**

- **Qué es:** abre una ventana modal nativa del sistema operativo con un mensaje y un botón de aceptar.
- **Mecanismo:** pertenece al objeto global `window`, así que `window.alert()` y `alert()` son idénticos.
- ⚠️ **Efecto bloqueante:** es síncrono y bloqueante. Hasta que el usuario pulsa "Aceptar", **el hilo principal de JavaScript se congela**: las animaciones se detienen y la página no atiende ningún otro evento.

### Manipulación dinámica

A través del DOM, JS puede modificar en caliente los tres aspectos visuales de la página:

**1. Contenido de la página** — reescribir bloques informativos con botones:

```html
<p id="prueba">Modificando el contenido.</p>
<button onclick="document.getElementById('prueba').textContent = 'CAMBIADO!'">¡Dale!</button>
```

**2. Atributos HTML** — cualquier atributo (`href`, `width`, `src`…) es una **propiedad** accesible desde JS. Un caso clásico es una galería que conmuta la imagen al hacer clic:

```js
function cambiaPic() {
  const image = document.getElementById('myFPImage');
  // Si la imagen actual es la verde, pasa a la negra; y al revés
  if (image.src.match("green")) {
    image.src = "negra.jpeg";
  } else {
    image.src = "verde.jpeg";
  }
}
```

El navegador reacciona solo: descarga el recurso y lo repinta.

**3. Estilos CSS en tiempo real** — mediante la propiedad `.style`:

```js
function myFunction() {
  const x = document.getElementById("mytxt");
  x.style.fontSize = "25px";
  x.style.color = "red";
}
```

> 💡 **Regla camelCase:** como el guion `-` representa la resta en JavaScript, las propiedades CSS compuestas no pueden llevar guion. Se elimina y se pone en mayúscula la siguiente letra:
>
> | CSS | JavaScript |
> |---|---|
> | `background-color` | `style.backgroundColor` |
> | `font-size` | `style.fontSize` |
> | `margin-top` | `style.marginTop` |

### `window` y la jerarquía del BOM

- **`window`** representa la ventana o pestaña completa y es el **objeto raíz global** del entorno cliente.
- **`document` (el DOM)** es en realidad una **propiedad** que cuelga de `window`: `window.document`.
- **Ámbito global:** cualquier variable o función declarada a nivel superior (`var`), o cualquier método nativo de la ventana, pasa a formar parte de `window`. Por eso estas dos líneas son idénticas:

```js
window.alert("Mensaje");  // invocación formal
alert("Mensaje");         // invocación simplificada
```

### Reflow y Repaint

Cuando un script altera el DOM o los estilos, el navegador ejecuta una cadena de operaciones costosas en CPU y tarjeta gráfica:

| Concepto | Cuándo ocurre | Ejemplo | Qué hace el navegador |
|---|---|---|---|
| **Reflow** (re-layout) | Cambia la **geometría o posición** de un elemento | `x.style.fontSize = "25px"`, inyectar bloques con `innerHTML` | Recalcula el espacio del nodo y **recoloca todo lo que lo rodea** |
| **Repaint** | Cambia solo el **aspecto visual**, sin alterar el espacio físico | `x.style.color = "red"`, `backgroundColor` | No recalcula posiciones, **solo repinta los píxeles** afectados |

> ⚠️ **Lección para el programador:** los cambios que provocan reflow dentro de un bucle ralentizan la web. Agrupa las modificaciones visuales para evitar parpadeos y caídas de FPS.

---

## 1.3 Lenguajes de programación cliente

### La tríada fundamental

Tres lenguajes estándar, cada uno con una responsabilidad **independiente**:

| Lenguaje | Naturaleza | Responsabilidad |
|---|---|---|
| **HTML** | *No* es lenguaje de programación: lenguaje de marcado basado en etiquetas | Delimita la **semántica y estructura** del documento. Cualquier navegador compatible con los estándares del W3C lo interpreta de forma homogénea |
| **CSS** | Lenguaje declarativo de diseño gráfico y maquetación | Define el **aspecto**: estética, proporciones, márgenes y adaptabilidad a pantallas (*responsive*). No toca la lógica ni los datos |
| **JavaScript** | Auténtico lenguaje de programación: **dinámico, débilmente tipado y orientado a eventos** | Reacciona a acciones del usuario (teclas, clics, ratón), valida entradas y altera el documento **sin recargar la página** |

> 💡 **TypeScript:** por los riesgos del dinamismo extremo en apps complejas (sobre todo financieras), el estándar de la industria es usar TypeScript. **No es un lenguaje nuevo**: es una capa sobre JavaScript que añade **tipado estático**. Escribes con tipos que se comprueban al programar, pero al compilar se transforma en JavaScript estándar para el navegador.

### Evolución histórica de JavaScript

Uno de los casos más singulares de la informática: un lenguaje diseñado en **10 días** para validar formularios terminó siendo el motor de ejecución universal de la web, servidores, escritorio y dispositivos embebidos.

**Fase 1 — Nacimiento y estandarización (1995–1999)**

- **1995 (Mocha / LiveScript / JavaScript):** Brendan Eich crea el lenguaje en 10 días para **Netscape**, con el objetivo de dar interactividad básica a los documentos HTML.
- **1996 (JScript):** Microsoft lanza IE 3.0 con su propia versión hecha por ingeniería inversa → primera **"guerra de navegadores"** y graves problemas de compatibilidad.
- **1997 (ECMAScript 1 — ECMA-262):** Netscape entrega la especificación a Ecma International para fijar un estándar neutro.
- **1998–1999 (ES2 / ES3):** ES3 consolida el lenguaje con **expresiones regulares**, `try/catch`, formateo estricto y mejoras en cadenas y objetos.

**Fase 2 — Estancamiento y era AJAX (2000–2008)**

- **Fracaso de ES4:** se propuso una reescritura radical con tipado estático y clases complejas (influenciada por ActionScript 3). Se abandonó por excesiva complejidad y falta de consenso entre Microsoft y Netscape/Mozilla.
- **AJAX (2005):** **Jesse James Garrett** acuña el término. `XMLHttpRequest` permite actualizar páginas sin recargarlas por completo y transforma JS de un simple adorno en una herramienta para webs completas (Google Maps, Gmail).
- **Librerías de abstracción (2006):** la fragmentación entre navegadores impulsa **jQuery, Prototype y MooTools**, cuyo propósito era unificar las APIs del DOM.

**Fase 3 — Madurez: ES5 y salida del navegador (2009)**

- **ES5 (diciembre 2009):** modo estricto (`"use strict"`), métodos funcionales de arrays (`forEach`, `map`, `filter`, `reduce`, `some`, `every`), soporte nativo de JSON (`JSON.parse`, `JSON.stringify`) y getters/setters con control de descriptores (`Object.defineProperty`, `Object.freeze`).
- **V8 y Node.js (2008–2009):** Google lanza Chrome con el motor V8 (JIT directo a código máquina) multiplicando el rendimiento. **Ryan Dahl** crea Node.js sobre V8, llevando JavaScript al *back-end* y desencadenando el ecosistema npm.

**Fase 4 — Punto de inflexión: ES6 (2015)**

Publicada en **junio de 2015**, fue la mayor refundición de sintaxis y capacidades desde la creación del lenguaje, preparándolo para proyectos de gran escala.

**Fase 5 — Era moderna: lanzamientos anuales (ES2016+)**

A partir de ES6 el TC39 adoptó un proceso de aprobación por **etapas** (stage 0 → stage 4, siendo el 4 = *finished*) con publicaciones anuales, para evitar bloqueos e incorporar características a medida que maduran.

### El ecosistema de frameworks

Las apps profesionales **rara vez** se construyen solo con JavaScript nativo (*Vanilla JS*).

- **Origen:** nacieron como librerías para simplificar tareas repetitivas y **evitar** las diferencias entre navegadores.
- **Evolución:** hoy son plataformas completas con compilación previa y lenguajes tipados o extensiones de sintaxis (TypeScript, JSX).
- **Ventajas para el desarrollo empresarial:**
  - **Coste económico nulo:** la gran mayoría son *open-source* y gratuitos.
  - **Fiabilidad y seguridad:** probados por miles de programadores y grandes comunidades; minimizan fallos y fugas de memoria.
  - **Velocidad de entrega (*time to market*):** traen patrones de diseño, componentes prediseñados, gestión de rutas y estructuras ya resueltas.
  - **Estandarización de equipos:** un programador nuevo se incorpora rápido si conoce el framework estándar del proyecto.

### Los principales frameworks

**1. ReactJS** — Creado y mantenido por **Meta (Facebook)**.

- **Orientado a componentes:** la interfaz no es un bloque monolítico, se divide en piezas independientes y reutilizables (un botón, una tarjeta de producto, una barra de navegación). Cada componente gestiona su propio estado (`state`).
- **Virtual DOM:** manipular el DOM nativo es lento porque obliga al motor a recalcular geometrías y repintar píxeles. React mantiene en RAM una **copia ligera** del DOM; cuando cambian los datos, calcula las diferencias mínimas (**reconciliación**) y actualiza solo los nodos necesarios.
- **JSX:** extensión que permite escribir estructuras similares a etiquetas HTML dentro del código JS, combinando marcado y potencia del lenguaje.

**2. Angular** — Desarrollado y mantenido por **Google**.

- **Evolución:** la primera versión se llamó **AngularJS** (JavaScript clásico). Desde la versión 2 pasó a llamarse **Angular**, evolucionando hacia una solución integral más estructurada.
- **Lenguaje base:** **TypeScript**, superconjunto tipado mantenido por Microsoft.
- **Curva de aprendizaje:** pronunciada por su rigidez estructural; exige dominar inyección de dependencias, TypeScript y programación reactiva con **RxJS**.

**3. Vue.js** — Diseñado por **Evan You**.

- **Filosofía:** tomar las mejores características de React y Angular priorizando ligereza y velocidad.
- **Arquitectura:** también usa **DOM virtual**.
- **Curva de aprendizaje:** progresiva y mucho más accesible que la de Angular. Suele combinarse con *back-ends* como Laravel.

**4. Otras alternativas**

| Librería | Enfoque |
|---|---|
| **EmberJS** | Convención sobre configuración; grandes apps web empresariales |
| **BackboneJS** | Uno de los primeros intentos de estructurar apps con modelos y vistas ligeras |
| **MeteorJS** | Plataforma integral de tiempo real; unifica cliente y servidor en el mismo JS |
| **Aurelia, Polymer, Mithril** | Estándares de Web Components y motores de renderizado ultraligeros |

### Vocabulario

- **DOM Virtual:** copia del DOM en RAM que el framework mantiene para reducir renderizaciones e incrementar el rendimiento.
- **JSX:** extensión de JavaScript parecida a un lenguaje de plantillas, pero con toda la capacidad de ejecución de JS integrada.
- **TypeScript:** lenguaje *open-source* de Microsoft; superconjunto de JS con tipado estático para grandes proyectos, que se compila a JS ejecutable.
- **Patrón reactivo:** modelo basado en flujos de datos asíncronos que propaga automáticamente los cambios en la interfaz cuando varía el estado.

### Funciones en JavaScript

Bloque de código **reutilizable** para una tarea concreta: se define una vez y se invoca tantas veces como haga falta.

| Forma | Sintaxis | Particularidad |
|---|---|---|
| **Declaración** (Function Declaration) | `function saludar(nombre) { return \`Hola, ${nombre}\`; }` | Disfruta de **hoisting**: se puede invocar **antes** de la línea donde está escrita |
| **Expresión** (Function Expression) | `const duplicar = function(n) { return n * 2; };` | Se asigna a una variable. **No** se puede usar antes de definirla |
| **Flecha** (Arrow Function, ES6) | `const sumar = (a, b) => a + b;`<br>`const cuadrado = x => x * x;` | Sintaxis compacta. Con una sola línea el `return` y las llaves `{}` son **implícitos**; con un solo parámetro se pueden omitir los paréntesis |

Ejemplo aplicado a la página:

```html
<p id="prueba">Modificando el contenido.</p>
<button onclick="cambiarTexto()">¡Dale!</button>
<script>
  function cambiarTexto() {
    document.getElementById('prueba').textContent = 'CAMBIANDO el contenido!';
  }
</script>
```

---

## 1.4 Programación de guiones (scripts)

### Origen y naturaleza

- **Nacimiento:** surgieron como **secuencias de comandos** o pequeños fragmentos para **automatizar tareas rutinarias** en los sistemas operativos.
- **Dependencia del intérprete:** siempre los ejecuta un intérprete de comandos o motor de ejecución subyacente.
- **Hoy:** han superado su concepción de simples rutinas auxiliares; en la web actual son **programas completos** con arquitecturas complejas de miles de líneas, manejando estados, interfaces reactivas y comunicaciones de red.

### Diferencias con los lenguajes tradicionales

**1. Compilación frente a interpretación**

- **Tradicionales:** requieren un paso previo de **compilación** que traduce el código fuente a código máquina binario específico de una plataforma. Sin compilar, el programa no existe como ejecutable.
- **Script:** se **interpretan directamente**. El motor evalúa las instrucciones línea a línea en tiempo de ejecución, sin compilación previa ni archivo ejecutable intermedio.

**2. Independencia frente a integración en el sistema anfitrión (*host*)**

| Tipo | Ejemplos | Cómo se ejecutan |
|---|---|---|
| Compilados nativos | C++, Go, Rust | Binarios autónomos (`.exe`) directamente |
| Gestionados por máquina virtual | Java, C# | Se compilan a código intermedio y necesitan **JVM / .NET** |
| Interpretados / script | Python, JavaScript | Leen el código línea a línea; necesitan su entorno o un navegador (*host*) |

> 💡 Hoy en día los dos mundos se hanmezclado: aunque nacieron para depender de un anfitrión (JavaScript dentro de un HTML), ahora pueden ir **autónomos** — en consola (Python, o JavaScript con Node.js) o empaquetados como *standalone* (PyInstaller, Electron / pkg).

**3. Crear desde cero frente a reutilizar componentes preexistentes**

- **Tradicionales:** suelen construir sus propias estructuras, interfaces y librerías desde la base.
- **Script:** se diseñaron para **apoyarse y enlazar componentes que ya existen** en el anfitrión (los elementos del DOM, el motor gráfico, las llamadas de red del navegador…).

**4. Momento de detección de errores**

- **Tradicionales:** la fase de compilación actúa como **filtro estricto** de sintaxis y tipos; si hay un fallo estructural, el binario ni siquiera se genera.
- **Script:** al ejecutarse línea a línea en el equipo del cliente, los fallos **se descubren en tiempo de ejecución (*runtime*)**, lo que exige planes de prueba exhaustivos.

**5. Clasificación**

- **Tradicionales:** C, C++, Java, Swift, Pascal.
- **Scripting:** JavaScript, Shell script, Perl, PHP, Python, Ruby.

### Ventajas y desventajas

| ✅ Ventajas | ❌ Desventajas |
|---|---|
| **Sencillez y curva de aprendizaje rápida:** diseñados para ser fáciles de usar | **Más errores en runtime:** un fallo en una rama condicional poco transitada puede pasar desapercibido hasta que el usuario final interactúa con ella |
| **Agilidad en el ciclo de desarrollo:** sin esperar tiempos de compilación; cualquier cambio se comprueba recargando la página | **Rendimiento bruto inferior:** aunque los motores modernos aplican JIT, un lenguaje dinámico consume más memoria y CPU que un binario en C/C++ optimizado |
| **Integración natural:** fácil de incrustar en otros lenguajes o documentos (JS dentro de etiquetas HTML) | **Exposición del código fuente:** en JS, al transferirse al cliente como texto plano, el código queda **público** ante cualquier usuario |
| **Portabilidad mediante el anfitrión:** el mismo código funciona en ordenador, tableta o móvil si hay un navegador con estándares | |

### Casos singulares

- **Python:** destaca por su enorme proyección como lenguaje de referencia en **IA, computación científica y tratamiento masivo de datos**.
- **Java vs. JavaScript:** nombres parecidos por razones comerciales del origen, pero filosofías **opuestas**:

| | Java | JavaScript |
|---|---|---|
| Tipo | Tradicional | Script |
| Tipado | Fuerte | Débil |
| Ejecución | Compilado a *bytecode* en máquina virtual | Interpretado en el navegador |
| Paradigma | Orientado a objetos | Orientado a eventos |

### El objeto `Date`

**Naturaleza:** las fechas **no son un tipo primitivo**, sino instancias del objeto nativo `Date`.

- **Instantánea fija:** un objeto `Date` es un punto estático en el tiempo; no funciona como un reloj en tiempo real.
- **Época Unix (Epoch Time):** internamente se almacena como un **número entero de milisegundos desde el 1 de enero de 1970 a las 00:00:00 UTC**. Positivo = posterior a 1970; negativo = anterior.
- 1 día = 24 × 60 × 60 × 1000 = **86 400 000 ms**.

```js
Date.now();  // timestamp actual en ms, sin instanciar objeto
```

**Formas de instanciación (`new Date`)**

| Variante | Ejemplo | Notas |
|---|---|---|
| **Sin argumentos** | `new Date()` | Instante actual según el reloj del sistema local |
| **Cadena de texto** | `new Date("2026-09-28T12:30:00")` | Formatos **ISO 8601** (recomendado) o RFC 2822 |
| **Componentes numéricos** | `new Date(2026, 11, 25, 10, 30, 0, 0)` | De 2 a 7 parámetros: `año, mesIndex, día, hora, min, seg, ms` |
| **Milisegundos desde Unix** | `new Date(86400000)` | Un único entero = ms desde 1970 |

> ⚠️ **Reglas críticas del constructor numérico:**
>
> - **Meses de base cero:** `0` = Enero … `11` = Diciembre. Los **días sí van de 1 en adelante** (1 a 31).
> - **Desbordamiento automático:** si el valor excede el límite, el motor calcula el exceso y avanza de unidad.
>   ```js
>   new Date(2026, 15, 20);  // mes 15 → Abril de 2027
>   new Date(2026, 5, 35);   // día 35 en junio → 5 de julio
>   ```
> - **Años de 1 o 2 dígitos = siglo XX:** `new Date(95, 5, 15)` → **15 de junio de 1995**.
> - ⚠️ **Pasar un solo número NUNCA indica el año:** `new Date(2026)` interpreta 2026 **milisegundos** después de 1970.

**Métodos de conversión y salida**

| Método | Formato | Salida típica | Caso de uso |
|---|---|---|---|
| `toString()` | Texto completo con zona horaria local | `Mon Sep 28 2026 12:23:57 GMT+0200` | Depuración rápida / conversión por defecto |
| `toDateString()` | Solo fecha legible | `Mon Sep 28 2026` | Interfaces sin detalle de horas |
| `toTimeString()` | Solo hora con huso | `12:23:57 GMT+0200` | Registros de eventos horarios |
| `toISOString()` | **ISO 8601 en UTC** | `2026-09-28T10:23:57.000Z` | Intercambio de datos con APIs y BBDD |
| `toUTCString()` | **HTTP / RFC 7231** | `Mon, 28 Sep 2026 10:23:57 GMT` | Cabeceras HTTP o cookies |
| `toLocaleDateString()` | Según la localización del usuario | `28/9/2026` (en España: `es-ES`) | Interfaz de usuario final |

**Getters y setters**

```js
const f = new Date(2026, 8, 28, 14, 45, 10);  // 28 de septiembre de 2026

// LECTURA
f.getFullYear();  // 2026
f.getMonth();     // 8 (Septiembre, porque Enero es 0)
f.getDate();      // 28 (día del mes)
f.getDay();       // día de la semana (0 = Domingo, 1 = Lunes ... 6 = Sábado)
f.getHours();     // 14
f.getMinutes();   // 45
f.getSeconds();   // 10
f.getTime();      // timestamp en ms (equivalente a valueOf())

// ESCRITURA
f.setFullYear(2027);
f.setMonth(0);    // enero
f.setDate(15);
```

**Método auxiliar `padStart(length, string)`**

Rellena una cadena **desde el principio** (por la izquierda) hasta alcanzar la longitud indicada. Es la forma estándar de poner ceros a la izquierda.

```js
let text = "5";
text = text.padStart(4, "0");   // "0005"
```

---

## 1.5 Integración de JavaScript en HTML

JavaScript no actúa aislado: se combina con el HTML de la página. El estándar define **mecanismos precisos** que determinan **cómo, cuándo y en qué orden** se procesa la lógica respecto a la estructura del documento.

Hay **dos opciones**: **A) código embebido** (todo en el mismo archivo) o **B) ficheros separados** (recomendado en proyectos profesionales).

### La etiqueta `<script>`

Contenedor oficial definido por el W3C para insertar o enlazar código ejecutable.

- **Sintaxis actual (HTML5):** basta con `<script>…</script>`. Los navegadores modernos asumen por defecto que el lenguaje es JavaScript.
- **Compatibilidad histórica:** antes era obligatorio el atributo `type` → `<script type="text/javascript">`. Hoy los navegadores aún lo reconocen por compatibilidad hacia atrás, pero **ya no hace falta escribirlo**.
- ⚠️ **Cierre obligatorio:** una etiqueta `<script>` **jamás** puede cerrarse de forma abreviada (`<script src="script.js" />`). Siempre necesita su `</script>`.

### B) Ficheros externos separados

Estructura HTML en un `.html` y toda la lógica en archivos `.js` independientes.

```html
<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
  <title>Myfpschool</title>
  <!-- Enlace al fichero script.js en la misma carpeta -->
  <script src="script.js"></script>
</head>
<body></body>
</html>
```

```js
// script.js
function diAlgo() {
  alert("hola");
}

diAlgo();  // invocación directa al cargarse el fichero
```

**Ventajas técnicas:**

- **Velocidad de carga y caché:** el navegador descarga el `.js` **una sola vez** y lo guarda en su memoria caché. Si otras páginas del mismo sitio usan ese script, no hay que volver a descargarlo → menos ancho de banda y más velocidad.
- **Independencia de facetas (modularidad):** se separa la estructura del contenido (HTML) del comportamiento (JS), permitiendo que diseñadores y programadores trabajen a la vez sin pisarse.
- **Mantenimiento y reutilización:** para corregir una función se modifica **un solo `.js`** y el cambio se refleja en todas las páginas que lo referencian.
- **Buenas prácticas:** en proyectos profesionales los scripts se ordenan en un directorio dedicado, p. ej. `./js/logica.js`.

### A) Código embebido

Bloques `<script>` incrustados directamente entre las líneas de marcado.

```html
<!DOCTYPE html>
<html>
<head>
  <script>
    function diAlgo() { alert("Hola"); }
  </script>
</head>
<body>
  <script>
    diAlgo();  // se ejecuta desde el body
  </script>
</body>
</html>
```

**Características:**

- **Mismo resultado visual:** el enfoque embebido y el externo producen exactamente el mismo efecto para el usuario.
- **Dificultad de mantenimiento:** dispersar `<script>` desordenados por `<head>` y `<body>` convierte el código en algo difícil de depurar y mantener a largo plazo.
- **Criterio de uso excepcional:** solo se justifica cuando el código es **mínimo**, específico de **una sola página** y no se va a modificar nunca.

### ¿En `<head>` o en `<body>`?

| Ubicación | Qué ocurre |
|---|---|
| **En `<head>`** | El navegador lee el documento de arriba abajo y **se detiene** hasta que el script se descarga y se ejecuta. ⚠️ Si ese script busca un elemento del `<body>` con `getElementById('prueba')`, **fallará** porque ese elemento aún no se ha construido en el DOM |
| **Al final del `<body>`** (antes de `</body>`) | **Recomendación tradicional más eficaz:** garantiza que todo el marcado, los textos e imágenes ya están en el DOM antes de que empiece la lógica de interacción |

### Atributos `defer` y `async` (HTML5)

Permiten **evitar el bloqueo** del navegador con scripts externos en el `<head>`:

| Atributo | Descarga | Ejecución | ¿Cuándo usarla? |
|---|---|---|---|
| `defer` | En segundo plano mientras el navegador sigue construyendo el HTML | **Espera a que el documento HTML esté parseado por completo** | Scripts propios que dependen del DOM |
| `async` | En segundo plano | **Inmediata**, en cuanto termina la descarga, sin importar si el HTML terminó de leerse | Herramientas externas: analítica, contadores, píxeles |

```html
<script defer src="script.js"></script>
<script async src="script.js"></script>
```

---

## 1.6 Herramientas de programación y prueba

### Editores: de básicos a IDEs avanzados

Un editor de texto plano (Notepad, gedit) es **técnicamente suficiente**, pero inviable en desarrollo empresarial por falta de verificación de sintaxis y gestión de proyectos.

**Ranking de editores para JavaScript / TypeScript** (Stack Overflow Developer Survey):

| # | Editor | % uso | Rol en JS/TS |
|---|---|---|---|
| 1 | **Visual Studio Code** | 75,9 % | El **estándar absoluto** de la industria; >80 % de los front-end lo usan. Soporte nativo de TypeScript (el propio editor está escrito en TS) + extensiones como ESLint, Prettier y React/Vue Snippets |
| 2 | **Vim / Neovim** | 38,3 % (Vim 24,3 + Neovim 14) | Favorito de desarrolladores avanzados y administradores de servidores. Neovim da el mismo autocompletado y tipado de TS que VS Code, en la terminal y a máxima velocidad |
| 3 | **Notepad++** | 27,4 % | No sirve para apps modernas complejas, pero aparece muy alto porque miles de devs lo usan en Windows para editar scripts sueltos, manipular `.json` gigantes o automatizaciones ligeras |
| 4 | **Cursor** | 17,9 % | La IA que más rápido ha escalado. Clon exacto de VS Code: genera componentes interactivos completos o refactoriza TS con lenguaje natural |
| 5 | **IDEs de JetBrains** | 15,1 % (WebStorm 7,6) | **WebStorm** es el "Rolls-Royce" de los IDEs para JS: el motor de refactorización y detección de rutas rotas más seguro del mercado. Es de pago, aunque JetBrains liberó una versión gratuita para uso no comercial |

**VS Code vs. VSCodium** — se ven y se comportan de forma idéntica; la diferencia es la licencia y la privacidad:

| | Visual Studio Code | VSCodium |
|---|---|---|
| Propiedad | Microsoft (código base libre, instalador con licencia comercial) | Proyecto independiente 100 % libre |
| Telemetría | **Sí** (envía datos de uso a Microsoft) | **Cero** |
| Extensions | Algunas oficiales restringidas a Microsoft | Sin restricciones de licencia |

**Editores independientes con IA nativa:**

- **Windsurf** (de Codeium): competidor más directo de Cursor; también es un *fork* de VS Code. Destaca su modo agente **Cascade**, que analiza bases de código complejas, ejecuta comandos, lee errores y corrige bugs de forma autónoma. Plan gratuito muy generoso.
- **Void**: alternativa 100 % open source frente al modelo comercial de Cursor. Enfoque en privacidad total: conectas **tus propias claves de API** (OpenAI, Anthropic, Gemini) o usas modelos locales.
- **Zed**: editor de rendimiento extremo escrito en **Rust** (consume casi nada de RAM y usa la GPU). Gratuito y de código abierto, con IA integrada donde configuras tu propia API Key.

**Características técnicas clave para elegir un entorno profesional:**

- **Código abierto y gratuidad:** la comunidad audita, reporta fallos y publica mejoras más rápido que en software propietario cerrado.
- **Arquitectura modular:** activar, desactivar o reemplazar componentes internos según necesidades.
- **Gestor de paquetes integrado:** registrar, instalar, actualizar y eliminar librerías, extensiones y temas de forma desatendida.
- **Autocompletado predictivo:** analiza variables, funciones y métodos mientras escribes; minimiza erratas.
- **Paneles múltiples:** dividir el espacio para comparar y editar varios archivos (HTML, CSS, JS) a la vez.
- **Soporte comunitario:** foros y plataformas colaborativas como Slack.

### Control de versiones: Git y GitHub

- **Git:** sistema de control de versiones **distribuido** que rastrea cada modificación de los archivos a lo largo del tiempo.
- **GitHub:** plataforma en la nube para alojar repositorios Git, facilitar la revisión por pares (**pull requests**), el seguimiento de incidencias (**issues**) y la integración continua.
- **Integración en el IDE:** VS Code integra paneles nativos de Git para confirmar cambios (*commits*), cambiar de ramas y resolver conflictos sin salir del editor.

### Entornos online

Para probar código inmediato sin configurar un entorno local:

- **Coding Ground** (Tutorialspoint): editor con resaltado de sintaxis, vista previa (*Preview*) y consola simultánea. Permite varios ficheros por proyecto, descargar el código o importar archivos.
- **Otras:** CodeSandbox, StackBlitz o JSFiddle permiten evaluar librerías sin instalación y arrancar proyectos de React, Angular o Vue desde el navegador en segundos.

### DevTools del navegador (F12 o Ctrl+Shift+I)

| Panel | Para qué sirve |
|---|---|
| **Consola** | Interactuar con el motor de JS en tiempo real. Muestra lo que emite `console.log()` y resalta en **rojo** las excepciones y errores no capturados |
| **Fuentes / Debugger** | Examinar los ficheros `.js` descargados y poner **puntos de interrupción**. Al alcanzarlos, el navegador congela el script y puedes inspeccionar variables paso a paso y analizar la pila de llamadas (*Call Stack*) |
| **Red** | Supervisa todas las peticiones HTTP (HTML, CSS, `.js`, imágenes, *fetch*). Permite ver el **código de respuesta** (200 OK, 404 Not Found, 500 Server Error), el tiempo de transferencia y el tamaño de cada recurso |

### Criterios de selección

| Parámetro | Editor ligero / online | IDE completo / avanzado |
|---|---|---|
| **Escenario idóneo** | Pruebas de concepto rápidas, corregir un error puntual, equipos con hardware limitado | Proyectos profesionales medianos y grandes, apps con frameworks (React, Angular) |
| **Consumo de recursos** | Mínimo; funciona en cualquier navegador | Medio-alto; necesita RAM y almacenamiento para indexar el proyecto |
| **Control de versiones** | Limitado a exportar o descargar archivos sueltos | Integración profunda con Git, ramas, diff visual y GitHub |
| **Personalización** | Escasa o nula; depende de la plataforma web | Elevada, mediante gestores de paquetes y extensiones de la comunidad |

### Extensiones recomendadas para JavaScript puro

| Extensión | Qué hace |
|---|---|
| **Live Server** *(imprescindible)* | Crea un servidor web local con un clic. Cada vez que guardes, la página se **recarga automáticamente**: olvídate de abrir el archivo desde la carpeta y de pulsar F5 |
| **Quokka.js** | Tu bloc de notas interactivo: ejecuta el JS **en tiempo real mientras lo escribes** y muestra el resultado flotando junto a la línea. Ideal para probar lógica rápido sin abrir navegador ni terminal |
| **Error Lens** | Convierte la pequeña línea ondulada roja de error en el **mensaje completo con fondo rojo** al final de la línea, para ver al instante qué falla sin pasar el ratón por encima |

---

## Anexo — Actividades prácticas consolidadas

### 1.1 · Tiempos de ejecución en el navegador

Práctica guiada sobre un `catalogo.html` que genera **150 000 productos** en un array del cliente y permite ordenarlos y filtrarlos con medición de tiempos (`console.time()` / `console.timeEnd()`). Objetivos: demostrar que la CPU/RAM del navegador asume el procesamiento que antes hacía el servidor.

**Modificaciones guiadas:**

1. **Invertir la ordenación:** cambiar el predicado de `.sort()` a descendente (`b.precio - a.precio`) y ajustar el mensaje para mostrar primero el más caro.
2. **Cambiar la categoría del filtro:** en `.filter()`, seleccionar `"Telefonía"` en lugar de `"Informática"`.
3. **Prueba de estrés:** subir `TOTAL_REGISTROS` de 150 000 a **500 000**, repetir los botones y anotar los nuevos tiempos.

**Cuestionario de análisis técnico:**

1. **Auditoría de tiempos:** compara el tiempo de ordenación con 150 000 frente a 500 000 elementos. ¿Crece **linealmente** o en otra proporción?
2. **Ahorro en el servidor:** si 10 000 usuarios consultan y reordenan el catálogo a la vez, ¿qué tiempo total consumen sus navegadores? ¿Qué beneficio supone ejecutar el algoritmo en cada navegador en vez de lanzar `ORDER BY` continuos a la BBDD?
3. **Límite arquitectónico:** con 8 millones de registros, ¿sería viable descargarlos todos en un array para ordenarlos en el cliente? ¿Qué solución propondrías?

### 1.2 · Manipulación del DOM

1. Añadir un segundo botón que altere el `<p>` **y** el `<h1>` con `getElementById()` + `innerHTML`.
2. Capturar el clic de un botón para emitir una traza con `console.log()`.
3. Sustituir lo anterior por ventanas modales con `window.alert()`.
4. Web con tres botones ("Ruso", "Español", "Inglés") que cambien el texto de un `<p>` y su color con `.style.color`.
5. El mismo ejercicio, pero imprime solo por consola.
6. Transformar el código para generar los textos con `document.write()`.
7. Interfaz con `<h1>` + `<p id="estado">` y tres botones: **Consola** (`console.log()` con la hora), **Estilo** (`.style.backgroundColor` verde + `innerHTML` a "Sistema Activo") y **Alerta** (`window.alert()`).
8. Test interactivo de 7 preguntas con botones «Verdadero»/«Falso»: al responder, `.style.color = "green"` si acierta y `"red"` si falla.
9. Secuencia cíclica de 4 imágenes: al hacer clic, comprobar cuál se ve (condición o contador sobre un array) y reasignar `.src` a la siguiente.

### 1.3 · Funciones y frameworks

- Repetir los ejercicios de 1.2 **usando funciones**.
- **Actividad 1.1 (del libro):** investigar qué es la programación reactiva, comparándolo con una hoja de cálculo donde al cambiar una celda las dependientes se recalculan al instante.
- **Actividad comparativa:** justificar con una tabla qué framework elegirías para (1) una tienda de barrio con poco presupuesto y despliegue rápido, (2) un portal bancario con cientos de programadores y tipado estricto, (3) una app con renderizado ultra rápido de miles de productos con cambios constantes.

### 1.4 · Objetos `Date`

1. **Interpretar constructores** sin ejecutar: predice qué fecha representa cada uno.
   ```js
   const fechaA = new Date(2026, 0, 10);
   const fechaB = new Date(2026, 12, 1);
   const fechaC = new Date(2026);
   const fechaD = new Date("2026-02-28");
   const fechaE = new Date("2026/02/28");
   ```
2. **Diferencia temporal:** `calcularDiasDiferencia(fechaInicio, fechaFin)` que reciba dos cadenas `YYYY-MM-DD` y devuelva los días transcurridos, usando `.getTime()` y `Math.round()` / `Math.floor()` (para evitar inconsistencias con el horario de verano/invierno).
3. **Último día del mes:** `obtenerUltimoDiaMes(año, mes)` devolviendo 31, 30, 28 o 29. Pista: gracias al desbordamiento, **pasar el día 0** da el último día del mes anterior. El `mes` se pasa en formato humano (1 = enero).
4. **Formateador manual:** `formatearFechaEspanola(fecha)` → `"DD/MM/YYYY HH:mm"`, con ceros a la izquierda usando `.padStart(2, "0")`.
5. **Teórico (Ej. 9 del libro):** ¿en qué se diferencia técnicamente JavaScript de Java?
6. **Síntesis (Ej. 10 del libro):** describe las ventajas más importantes de usar JavaScript en el desarrollo web moderno.
7. **Laboratorio:** en `calculo.js`, intenta una operación matemática con una variable **no declarada**. Observa que las líneas anteriores se ejecutan con normalidad y el intérprete **solo se detiene** al alcanzar el fallo en runtime; comprueba el error en consola.

### 1.5 · Integración de ficheros

1. Crear `index.html` y `script.js` en la misma carpeta con el código de ficheros separados. Abrirlo y comprobar que aparece la alerta `"hola"` al cargar.
2. Crear el `index.html` con el código embebido y observa cómo **se interrumpe la carga** para mostrar el mensaje.
3. **Reorganización de proyecto:** montar la estructura profesional y comprobar el estado `200 OK` del `.js` en la pestaña **Network**.

```
mi_proyecto/
├── css/
│   └── estilos.css
├── js/
│   └── logica.js
└── index.html
```

4. Rehacer los ejercicios de 1.2 y 1.4 con esta estructura.

---

## Glosario exprés

| Término | Significado |
|---|---|
| **DOM** | Representación en árbol de los elementos de una página web, en memoria RAM |
| **CSSOM** | Árbol con todas las reglas de estilo CSS |
| **Render Tree** | Unión de DOM + CSSOM; solo contiene lo visible |
| **BOM** | Jerarquía de objetos del navegador, con `window` como raíz global |
| **JIT** | Compilación *Just-In-Time*: traduce a código máquina lo que se repite mucho |
| **Reflow** | Recálculo de posiciones y geometría tras un cambio |
| **Repaint** | Redibujado de píxeles sin recalcular posiciones |
| **Reconciliación** | Cálculo de diferencias entre DOM virtual y real para actualizar lo mínimo |
| **Hoisting** | Poder invocar una función declarada antes de su línea de definición |
| **camelCase** | Convención en JS: sin guiones, con mayúscula tras cada palabra |
| **XSS** | Inyección de código malicioso mediante `innerHTML` con datos de usuario |
| **SPA** | *Single Page Application*: carga la plantilla una vez y no recarga al interactuar |
| **Defer / async** | Atributos que evitan el bloqueo del parser al cargar scripts externos |
| **Epoch time** | Milisegundos transcurridos desde 1/1/1970 00:00:00 UTC |

## Cómo estudiar este tema

1. **Empieza por 1.1** (cliente vs. servidor) — es la base conceptual y lo más probable que te pregunten.
2. **Memoriza las tablas**: los 7 módulos del navegador, los motores, los métodos de `Date` y el `defer`/`async`.
3. **Las tres comparaciones clave** que más se repiten: cliente/servidor, compilación/interpretación, y reflow/repaint.
4. **Los errores que más se repiten en exámenes** (marcas de trampa):
   - `new Date(2026)` **no** es el año 2026, son milisegundos desde 1970.
   - Los meses van de **0 a 11**; los días de 1 a 31.
   - `document.write()` **borra la página** si se usa tras la carga.
   - `alert()` **bloquea** el hilo de ejecución.
   - Cambiar `font-size` provoca **reflow**; cambiar solo `color`, **repaint**.
   - El código del cliente es **público**: nada de claves ni seguridad en el front-end.
   - En `<head>`, un script que busca elementos del `<body>` falla: el DOM aún no está construido.